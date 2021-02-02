<?php

    require_once "MessageDAO.php";
    session_start();
    
    $login_user = $_SESSION['login_user'];
    
    if($login_user === null){
        $_SESSION['error_message'] = 'ログインしてください';
        header('Location: login.php');
        exit;
    }
    
    $message = $_SESSION['message'];
    $_SESSION['message'] = null;

    if($message !== null){
        MessageDAO::insert($message);
    }    

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>完了</title>
</head>
<body>
    <h1>投稿しました</h1>
    
    <a href="index.php">投稿一覧へ</a>
    
</body>
</html>

