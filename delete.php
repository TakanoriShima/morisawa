<?php
    require_once "MessageDAO.php";
    session_start();
    
    $id = $_GET['id'];
        
    MessageDAO::delete($id);
    
    $_SESSION['flash_message'] = '投稿を削除しました';
    header('Location: index.php');
    exit;
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>削除</title>
    <p>削除しました</p>
    
    <a href="index.php">投稿一覧へ</a>
</head>
<body>
    
</body>
</html>