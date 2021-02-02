<?php
    
    require_once "MessageDAO.php";
    
    $id = $_GET['id'];
    $message = MessageDAO::get_message_by_id($id);
    
    include_once 'edit_view.php';
    
?>

