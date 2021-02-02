<?php
    require_once "MessageDAO.php";
    session_start();
        
    $messages = MessageDAO::get_all_messages();
    
    $login_user = $_SESSION['login_user'];
    
    if($login_user !== null){
        $flash_message = $_SESSION['flash_message'];
        $_SESSION['flash_message'] = null;
        include_once "index_view.php";
    }else{
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: login.php');
        exit;
    }
    
   
?>

    

