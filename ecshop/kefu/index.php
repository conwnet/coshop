<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>云博畜牧商城 - 客服登录</title>
<style>
body {
    background-image: url('image/bg.jpg');
}
.login {
    width: 400px;
    margin: 80px auto;
}

.login div {
    display: block;
}

.login h1 {
    text-align: center;
    color: #222;
    font-weight: normal;
    font-size: 30px;
}

.login input[name] {
    margin: 20px auto;
    padding: 3px 10px;
    font-size: 14px;
    display: block;
    width: 80%;
    height: 30px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 3px;
    border: 0;
}

.login input[type="submit"] {
    background: #0af;
    color: #fff;
    width: 300px;
    margin: 0 auto;
    display: block;
    border: 0px;
    border-radius: 3px;
    font-size: 16px;
    padding: 10px;
}

.login .error {
    text-align: center;
    color: #c11;
}

</style>
</head>
<body>
    <div class="login">
        <h1>在线客服登录</h1>
        <form action="check.php" method="post">
            <input type="text" name="username" placeholder="请输入用户名">
            <input type="password" name="password" placeholder="请输入密码">
            <input type="submit" value="登 录">
        </form>
        <?php if (isset($_SESSION['error']) && $_SESSION['error']) { ?>
        <p class="error">密码错误，请重试！</p>
        <?php $_SESSION['error'] = false; } ?>
    </div>
</body>
</html>

