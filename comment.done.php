<?php
    require_once "daos/CommentDAO.php";
    require_once "daos/UserDAO.php";
    session_start();
    
    $login_user = $_SESSION['login_user'];
    
    if($login_user === null){
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: login.php');
        exit;
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        header('Location: index.php');
        exit;
    }
    
    $content = $_POST['content'];
    $message_id = $_POST['id'];
    
    $comment = new Comment($login_user->id, $message_id, $content);
    
    // var_dump($comment);
    
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
        // var_dump($errors);
    }
    
?>

        
           
         