<?php
    require_once 'daos/UserDAO.php';
    session_start();
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $errors = UserDAO::check_new_user($name, $email, $password);
    
    if(count($errors) === 0){
        $user = new User($name, $email, $password);
        UserDAO::insert($user);
        $_SESSION['flash_message'] = '新規登録が完了しました';
        header('Location: login.php');
        exit;
    }else{
        $_SESSION['errors'] = $errors;
        header('Location: signup.php');
        exit;
    }
    