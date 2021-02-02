<?php

    require_once 'filters/login_filter.php';
    require_once 'filters/post_filter.php';
    
    require_once "daos/MessageDAO.php";
    session_start();
    
    $id = $_POST['id'];
    
    $message = MessageDAO::get_message_by_id($id);
    
    // 削除しようとしている投稿が自分が投稿したものでなければ
    if($message->get_user()->id !== $login_user->id){
        $_SESSION['error_message'] = '他人の投稿を操作できません';
        header('Location: index.php');
        exit;
    }
    
    MessageDAO::delete($id);
    
    $_SESSION['flash_message'] = '投稿を削除しました';
    header('Location: index.php');
    exit;
    