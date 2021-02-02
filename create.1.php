<?php

    require_once 'filters/login_filter.php';
    require_once 'filters/post_filter.php';

    require_once 'daos/MessageDAO.php';
    session_start();

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
        $_SESSION['flash_message'] = '投稿が完了しました';
        header('Location: index.php');
        exit;
    }