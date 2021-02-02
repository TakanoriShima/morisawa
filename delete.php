<?php
    require_once "daos/MessageDAO.php";
    session_start();
    
    $id = $_GET['id'];
        
    MessageDAO::delete($id);
    
    $_SESSION['flash_message'] = '投稿を削除しました';
    header('Location: index.php');
    exit;
    