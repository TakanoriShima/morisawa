<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>詳細表示</title>
</head>
<body>
    <h1>詳細</h1>
    <ul>
        <li>名前：<?= $message->get_user()->name ?></li>
        <li>投稿日時：<?= $message->created_at ?></li>
        <li>タイトル：<?= $message->title ?></li>
        <li>内容：<?= $message->content ?></li>
        <li>画像：</li>
        <img src='upload/<?= $message->image ?>'>
    </ul>
    <?php if($message->user_id === $login_user->id): ?>
    <a href='edit.php?id=<?= $message->id ?>'>編集</a> <a href='delete.php?id=<?= $message->id ?>'>削除</a>
    <br/>
    <br/>
    <?php endif; ?>
    
    <?php if($flash_message !== null): ?>
    <p><?= $flash_message ?></p>
    <?php endif; ?>
    
    <?php if(count($errors) !== 0): ?>
    <?php foreach($errors as $error): ?>
    <?= $error ?><br/>
    <?php endforeach; ?>
    <?php endif; ?>
    
    
    <h1>コメント一覧</h1>

    <?php if(count($comments) !== 0): ?>

    <?php foreach($comments as $comment): ?>
    <?= $comment->id ?>　<?= $comment->get_user()->name ?><br/>
    <br/>
    <?= $comment->content ?><br/><br/>
    <?= $comment->created_at ?><br/>
    <hr/>
    <?php endforeach; ?>

    <?php endif; ?>
    
    <br/>
    <br/>
    <form action="comment.done.php" method="post">
        コメント：<input type="text" name="content"><br/>
        <br/>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit" value="コメントを投稿">
    </form>
    <br/>
    <br/>
    <a href="index.php">投稿一覧へ</a>
</body>
</html>

