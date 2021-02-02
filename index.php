<?php
    require_once "daos/MessageDAO.php";
    session_start();
        
    $messages = MessageDAO::get_all_messages();
    
    $login_user = $_SESSION['login_user'];
    
    if($login_user !== null){
        $flash_message = $_SESSION['flash_message'];
        var_dump($flash_message);
        $_SESSION['flash_message'] = null;
        include_once "views/index_view.php";
    }else{
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: login.php');
        exit;
    }
    
   
?>

    

