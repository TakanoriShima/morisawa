<?php
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        header('Location: index.php');
        // header("location:javascript://history.go(-1)");
        exit;
    }