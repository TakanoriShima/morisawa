<?php
    require_once 'filters/login_filter.php';
    require_once "daos/MessageDAO.php";
    
    session_start();
        
    $messages = MessageDAO::get_all_messages();
    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    $error_message = $_SESSION['error_message'];
    $_SESSION['error_message'] = null;
    
    include_once "views/index_view.php";


    

