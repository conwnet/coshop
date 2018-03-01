<?php
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($username == 'kf_01' && $password == 'pass_01') {
        $_SESSION['kf_id'] = 'kf_01';
    } else if ($username == 'kf_02' && $password == 'pass_02') {
        $_SESSION['kf_id'] = 'kf_02';
    } else if ($username == 'kf_03' && $password == 'pass_03') {
        $_SESSION['kf_id'] = 'kf_03';
    } else {
        $_SESSION['error'] = true;
        header('Location: http://www.shop.conw.net/kefu/index.php');
        exit;
    }

    header('Location: http://www.shop.conw.net/kefu/chat.php');

