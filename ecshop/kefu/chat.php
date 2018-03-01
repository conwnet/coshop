<?php
    session_start();
    if (!$_SESSION['kf_id']) {
        header('Location: http://www.shop.conw.net/kefu/index.php');
        return ;
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="referrer" content="never">
    <title>在线客服</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        .m-button{
            width: 100%;
            height: 40px;
            line-height: 40px;
            text-align: center;
            font-size: 12px;
            border-top:1px solid #fff;
            background-color: #2e3238;
            color: white;
            user-select: none;
        }

        .m-button:hover{
            background-color: #42464c;
            cursor:pointer;
        }

        .modal-mask {
            position: fixed;
            z-index: 9998;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, .5);
            display: table;
            transition: opacity .3s ease;
        }

        .modal-wrapper {
            display: table-cell;
            vertical-align: middle;
        }

        .modal-container {
            background-color: #2e3238;
            width: 300px;
            height: 480px;
            margin: 0 auto;
            position: relative;
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
            transition: all .3s ease;
            font-family: Helvetica, Arial, sans-serif;
        }

        .modal-header h3 {
            margin-top: 0;
            color: #42b983;
        }

        .modal-enter .modal-container .modal-leave .modal-container {
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }

        .friend-add{
            background-color: rgba(0, 0, 0, 0);
            color: #33FF99;
            border: 1px solid #33FF99;
            float: right;
            height: 30px;
            outline: none;
        }

        .friend-add:hover{
            background-color: #66CC99;
            cursor:pointer;
            color: #fff;
        }
    </style>
</head>
<body>

<div id="chat">
    <div class="sidebar" style="position: relative">
        <div class="m-card">
            <header>
                <img class="avatar" width="40" height="40" alt="Coffce" v-bind:src="user.avatar">
                <p class="name">{{ user.id }}</p>
            </header>
            <footer>
                <input class="search" placeholder="search user..." v-model="searchInput">
            </footer>
        </div>
        <div class="m-list" style="overflow-y: scroll; height: 455px;">
            <!-- 好友列表 -->
            <ul id="user-list">
                <li v-bind:class="friend.userId == currentFriendId ? 'active' : ''" v-for="friend in friends" v-on:click="changeFriend(friend.userId)" v-show="searchInput === '' || friend.userId.indexOf(searchInput) >= 0">
                    <img class="avatar" width="30" height="30" v-bind:src="friend.avatar"/>
                    <p class="name">{{ friend.userId }}</p>
                    <p class="username" hidden>{{ friend.userId }}</p>
                    <span v-show="friend.unread" style="float: right; color: #f00; font-size: 16px; vertical-align: middle;">●</span>
                </li>
            </ul>
        </div>
        <div class="m-button">
            {{ getStatus }}
        </div>
    </div>
    <div class="main">
        <div class="m-message">
            <!-- 聊天记录 -->
            <ul>
                <li v-for="message in currentMessages">
                    <p class="time"><span class="messageTime">{{ getDate(message.time) }}</span></p>
                    <div v-bind:class="message.me ? 'messageContent self' : 'messageContent'">
                        <img class="avatar" width="30" height="30" v-bind:src="message.avatar">
                        <div class="text">
                            {{ message.content }}
                        </div>
                        
                    </div>
                </li>
            </ul>
            <div id="message_end" style="height:0px; overflow:hidden"></div>
        </div>
        <!-- 输入框 -->
        <div class="m-text">
            <button class="send-btn" :disabled="!canSend" @click="sendMessage">发送</button>
            <textarea placeholder="请输入消息" v-model="messageInput"> </textarea>
        </div>
    </div>
</div>

<script src="js/vue.min.js"></script>
<script src="js/socket.io.js"></script>

<script>

    const socket = io.connect('http://www.shop.conw.net:3000');

    function randomAvatar () {
        avatars = [
            './image/1.jpg',
            './image/2.jpg',
            './image/3.jpg',
            './image/4.jpg',
            './image/5.jpg',
        ];
        return avatars[Math.floor(Math.random() * avatars.length)];
    }

    var app = new Vue({
        el: '#chat',
        data: {
            user: {
                id: '<?php echo $_SESSION['kf_id']; ?>',
                avatar: "./image/self.png",
                joinTime: Date.now()
              },               //当前用户信息
            status: 0,
            currentFriendId: 0,    //当前会话ID，对应好友列表顺序
            messageInput: "",       //输入框的内容 - 消息
            searchInput: "",        //输入框内容 - 好友搜索
            friends: []             //所有会话信息
        },
        methods: {
            //切换会话对象
            changeFriend: function (userId) {
                this.currentFriendId = userId;
                this.getFriendById(this.currentFriendId).unread = false;
            },
            getFriendById: function (userId) {
                for (let i = 0, l = this.friends.length; i < l; i++) {
                    if (this.friends[i].userId === userId) {
                        return this.friends[i];
                    }
                }
            },
            sendMessage: function () {
                socket.emit('client', {
                    userId: this.user.id,
                    status: 2,
                    message: {
                        senderId: this.user.id,
                        receiverId: this.currentFriendId,
                        content: this.messageInput
                    }
                });
                this.getFriendById(this.currentFriendId).messages.push({
                    time: Date.now(),
                    content: this.messageInput,
                    avatar: this.user.avatar,
                    me: true
                });
                this.messageInput = '';
            },
            getDate: function (time) {
                var date = new Date(time);
                return (
                    ('00' + (date.getMonth() + 1)).slice(-2) + '-' +
                    ('00' + (date.getDate() + 1)).slice(-2) + ' ' +
                    ('00' + date.getHours()).slice(-2) + ':' + 
                    ('00' + date.getMinutes()).slice(-2)
                );
            }
        },
        computed: {
            currentMessages: function () {
                let currentUser = this.getFriendById(this.currentFriendId);
                return currentUser ? currentUser.messages : [];
            },
            canSend: function () {
                return this.currentFriendId !== 0 && this.messageInput !== '';
            },
            getStatus: function () {
                return this.status == 0 ? '正在连接...' : '已连接';
            }
        },
        watch: {
            currentMessages: function () {
                this.$nextTick(function () {
                    document.getElementById('message_end').scrollIntoView();
                });
            }
        },
        mounted: function () {
            // 读取本地存储
            // let data = JSON.parse(localStorage.getItem('data') || '{}');
            // this.friends = data.friends || [];
            // 发送登录验证
            socket.emit('client', { userId: this.user.id, status: 1 });
            socket.on('server', data => {
                if (data.status === 1) {
                    this.status = 1;
                } else if (data.status === 2) {
                    let friend = null;
                    if (!(friend = this.getFriendById(data.userId))) {
                        this.friends.push(friend = {
                            userId: data.userId,
                            messages: [],
                            unread: true,
                            avatar: randomAvatar()
                        });
                    }
                    data.message.avatar = friend.avatar;
                    friend.messages.push(data.message);
                    // localStorage.setItem('data', JSON.stringify({ friends: this.friends }));
                }
            });
        }
    });

    

</script>


</body>
</html>
