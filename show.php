<?php

    require_once 'filters/login_filter.php';
    
    require_once "daos/MessageDAO.php";
    require_once "daos/CommentDAO.php";
    session_start();
    
    $id = $_GET['id'];
    
    $message = MessageDAO::get_message_by_id($id);
    
    $comments = CommentDAO::get_all_comments($id);
    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    
    include_once 'views/show_view.php';
 

