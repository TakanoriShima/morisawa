<?php
    require_once "HumanDAO.php";
    require_once "CommentDAO.php";
    session_start();
    
    $errors = $_SESSION['errors'];
    $_SESSION['errors'] = null;
    
    $code = $_GET['id'];
    $human = HumanDAO::get_human_by_id($code);
    
    $comments = CommentDAO::get_all_comments($code);
    // var_dump($comments);
    
?>    

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>詳細表示</title>
</head>
<body>
    <h1>詳細</h1>
    <ul>
        <li>名前：<?= $human->name ?></li>
        <li>投稿日時：<?= $human->created_at ?></li>
        <li>タイトル：<?= $human->title ?></li>
        <li>内容：<?= $human->message ?></li>
        <li>画像：</li>
        <img src='upload/<?= $human->image ?>'>
    </ul>
    <a href='edit.php?id=<?= $human->id ?>'>編集</a> <a href='delete.php?id=<?= $human->id ?>'>削除</a>
    <br/>
    <br/>
    
    <?php if(count($errors) !== 0): ?>
    <h1>コメント一覧</h1>
    <?php foreach($errors as $error): ?>
    <?= $error ?><br/>
    <?php endforeach; ?>
    <?php endif; ?>
    
    <?php if(count($comments) !== 0): ?>
    <?php foreach($comments as $comment): ?>
    <?= $comment['id']; ?>　<?= $comment['name']; ?><br/>
    <br/>
    <?= $comment['message']; ?><br/><br/>
    <?= $comment['created_at']; ?><br/>
    <hr/>
    <?php endforeach; ?>
    <?php endif; ?>
    
    <br/>
    <br/>
    <form action="comment.done.php" method="post">
        名前：<input type="text" name="name">  コメント：<input type="text" name="message"><br/>
        <br/>
        <input type="hidden" name="id" value="<?= $code ?>">
        <input type="submit" value="コメントを投稿">
    </form>
    <br/>
    <br/>
    <a href="index.php">投稿一覧へ</a>
    
    

</body>
</html>

