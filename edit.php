<?php
    
    require_once 'filters/login_filter.php';
    
    require_once "daos/UserDAO.php";
    require_once "daos/MessageDAO.php";
    
    $id = $_GET['id'];
    $message = MessageDAO::get_message_by_id($id);
    
    // 編集しようとしている投稿が自分が投稿したものでなければ
    if($message->get_user()->id !== $login_user->id){
        $_SESSION['error_message'] = '他人の投稿を操作できません';
        header('Location: index.php');
        exit;
    }
    
    include_once 'views/edit_view.php';
    
?>

