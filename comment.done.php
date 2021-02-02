<?php

    require_once 'filters/login_filter.php';
    require_once 'filters/post_filter.php';
    
    require_once "daos/CommentDAO.php";
    require_once "daos/UserDAO.php";
    
    session_start();
    
    $content = $_POST['content'];
    $message_id = $_POST['id'];
    
    $comment = new Comment($login_user->id, $message_id, $content);

    $errors = $comment->validate();
    
    if(count($errors) === 0){
        CommentDAO::insert_comment($comment);
        $_SESSION['flash_message'] = 'コメントを投稿しました';
        header('Location: show.php?id=' . $message_id);
        exit;
        
    }else {
        $_SESSION['errors'] = $errors;
        header('Location: show.php?id=' . $message_id);
        exit;
    }
    
?>

        
           
         