<?php

    require_once "daos/MessageDAO.php";
    session_start();
    
    $login_user = $_SESSION['login_user'];
    
    if($login_user === null){
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: login.php');
        exit;
    }
    
    $message = $_SESSION['message'];
    $_SESSION['message'] = null;

    if($message !== null){
        MessageDAO::insert($message);
        $_SESSION['flash_message'] = '投稿が完了しました';
        header('Location: index.php');
        exit;
    }    

?>


