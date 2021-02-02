<?php
    require_once "MessageDAO.php";
    require_once "CommentDAO.php";
    session_start();
    
    $login_user = $_SESSION['login_user'];
    
    if($login_user === null){
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: login.php');
        exit;
    }

    
    $id = $_GET['id'];
    
    $message = MessageDAO::get_message_by_id($id);
    
    $comments = CommentDAO::get_all_comments($id);
    // var_dump($comments);
    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    
    include_once 'show_view.php';
 

