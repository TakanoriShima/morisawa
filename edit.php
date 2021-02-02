<?php
    
    require_once "daos/MessageDAO.php";
    
    $id = $_GET['id'];
    $message = MessageDAO::get_message_by_id($id);
    
    include_once 'views/edit_view.php';
    
?>

