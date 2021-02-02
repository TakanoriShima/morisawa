<?php
    session_start();
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;

    include_once 'views/signup_view.php';