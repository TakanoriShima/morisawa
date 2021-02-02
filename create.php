<?php

    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        header('Location: index.php');
        exit;
    }
    
    require_once 'daos/MessageDAO.php';
    session_start();
    
    $login_user = $_SESSION['login_user'];
    
    if($login_user === null){
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: login.php');
        exit;
    }
    
    $errors = array();
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $image = MessageDAO::upload();

    $message = new Message($login_user->id, $title, $content, $image);
    $errors = $message->validate();
    
    if(count($errors) !== 0){
        $_SESSION['errors'] = $errors;
        header('Location: new.php');
        exit();
    }else{ 
        MessageDAO::insert($message);
        $_SESSION['flash_message'] = $flash_message;
        header('Location: index.php');
        exit;
    }