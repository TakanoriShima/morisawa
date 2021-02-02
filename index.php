<?php
    require_once "HumanDAO.php";
    session_start();
        
    $humans = HumanDAO::get_all_humans();
    
    include_once "index_view.php";
?>

    

