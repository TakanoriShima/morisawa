<?php
    session_start();
    $_SESSION['login_user'] = null;
    $_SESSION['flash_message'] = 'ログアウトしました';
    header('Location: login.php');
    exit;