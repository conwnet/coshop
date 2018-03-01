const io = require('socket.io')();

class User {
    constructor (id, socket) {
        this.id = id;
        this.socket = socket;
    }
}

class Message {
    constructor (senderId, receiverId, content) {
        this.senderId = senderId;
        this.receiverId = receiverId;
        this.content = content;
        this.time = Date.now();
    }
}

// 在线用户列表
let users = [];
// 未处理消息列表
const messages = [];

let getUserById = id => {
    for (let i = 0, l = users.length; i < l; i++) {
        if (users[i].id === id)
            return users[i];
    }
}

io.on('connection', socket => {
    socket.on('client', data => {
        let { userId, status } = data;
        let user = null;
        let flag = false; // users 在线列表中是否存在
        if (user = getUserById(userId)) {
            let idx = users.indexOf(user);
            users.splice(idx, 1);
        } else flag = true;
        user = new User(userId, socket);
        users.push(user);
        // 用户上线
        if (status === 1 || flag) {
            // 上线确认
            socket.emit('server', { status: 1 });
            // 如果是客服登录的话，设置未处理用户消息接收者为该客服
            if (userId.startsWith('kf_')) {
                messages.forEach(message => {
                    if (!message.receiverId)
                        message.receiverId = userId;
                });
            }
            // 发送未处理消息
            for (let i = 0; i < messages.length; ) {
                if (messages[i].receiverId === userId) {
                    socket.emit('server', {
                        userId: messages[i].senderId,
                        status: 2,
                        message: messages[i]
                    });
                    // 删除该消息
                    messages.splice(i, 1);
                } else i++;
            }
        // 正常发送消息
        } else if (status === 2) {
            let { receiverId, content } = data.message;
            let receiver = getUserById(receiverId);
            // 如果没有指定接收者，则随机选择一个在线的客服
            if (!receiverId) {
                kfs = users.filter(user => user.id.startsWith('kf_'));
                if (kfs.length)
                    receiver = kfs[Math.floor(Math.random() * kfs.length)];
            }
            // 如果存在接收者在线，则发送消息
            if (receiver) {
                let message = new Message(userId, receiverId, content);
                receiver.socket.emit('server', {
                    userId, status: 2, message
                });
            // 如果接收者不在线，缓存到 messages 队列中
            } else {
                if (receiverId && receiverId.startsWith('kf_')) receiverId = '';
                let message = new Message(userId, receiverId, content);
                // 总缓存 messages 队列不超过一万条
                if (messages.length === 10000) messages.shift();
                messages.push(message);
            }            
        }
        // socket.manager.transports[socket.id].socket.setTimeout(1000);
    });
    socket.on('disconnect', reason => {
        for (let i = 0, l = users.length; i < l; i++) {
            if (users[i].socket === socket) {
                users.splice(i, 1);
                break;
            }
        }
    });
});

io.listen(3000);
console.log('server starts at port 3000');

