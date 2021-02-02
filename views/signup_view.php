<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>新規会員登録</title>
    </head>
    <body>
        <h1>新規会員登録</h1>
        <?php if(count($errors) !== 0): ?>
        <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <form action="insert.php" method="POST">
            名前：　<input type="text" name="name"><br>
            メールアドレス：　<input type="text" name="email"><br>
            パスワード：　<input type="password" name="password"><br>
            <input type="submit" value="登録"><br>
        </form>
    </body>
</html>