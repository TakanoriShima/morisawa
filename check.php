<?php
    require_once 'HumanDAO.php';
    session_start();
    
    $errors = array();
    
    $name = $_POST['name'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    
    $image_name = HumanDAO::upload();
    // var_dump($image_name);
    $human = new Human($name, $title,$message,$image_name);
    $errors = $human->validate();
    

    
    if(count($errors) !== 0){
        $_SESSION['errors'] = $errors;
        header('Location: new.php');
        exit();
    }else{ 
        $_SESSION['human'] = $human;
        header('Location: new.done.php');
        exit;
    }