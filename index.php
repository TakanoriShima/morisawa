<?php
    require_once "HumanDAO.php";
    session_start();
        
    $humans = HumanDAO::get_all_humans();
    
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

    

