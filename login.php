<?php
    session_start();
    
    $flash_message = $_SESSION['flash_message'];
    $_SESSION['flash_message'] = null;
    
    $error_message = $_SESSION['error_message'];
    $_SESSION['error_message'] = null;
    
    include_once 'login_view.php';