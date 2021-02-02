<?php
    session_start();
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;

    include_once 'signup_view.php';