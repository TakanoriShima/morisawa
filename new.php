<?php

    require_once 'filters/login_filter.php';
    
    session_start();

    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;

    include_once 'views/new_view.php';

