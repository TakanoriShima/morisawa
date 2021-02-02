<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿一覧</title>
</head>
<body>
    <?php if($flash_message !== null): ?>
    <p><?= $flash_message ?></p>
    <?php endif; ?>
    
    <?php if($error_message !== null): ?>
    <p><?= $error_message ?></p>
    <?php endif; ?>
    
    <h1>投稿一覧</h1>
    <a href="new.php">新規投稿</a><br/>
    <br/>
    <?php foreach($messages as $message): ?>
    <a href='show.php?id=<?= $message->id ?>'><?= $message->id ?></a>　<?= $message->get_user()->name ?>　<?= $message->title ?><br/>
    <br/>
    <?= $message->content ?><br/>
    <img src='upload/<?= $message->image ?>' style="width: 200px;"><br/>
    <?= $message->created_at ?><br/>
    <hr/>
    <?php endforeach; ?>

    <br/>
    <br/>
    <br/>
    <a href="logout.php">ログアウト</a>
</body>
</html>