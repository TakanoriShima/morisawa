<?php
    
    require_once 'filters/login_filter.php';
    require_once 'filters/post_filter.php';

    require_once 'daos/MessageDAO.php';
    session_start();
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $id = $_POST['id'];
    
    $image = MessageDAO::upload();
    
    MessageDAO::update($id, $title, $content, $image);

    $_SESSION['flash_message'] = '投稿を編集しました';
    header('Location: show.php?id=' . $id);
    exit;

