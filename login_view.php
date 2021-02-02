<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン</title>
    </head>
    <body>
        <h1>ログイン</h1>
        <?php if($flash_message !== null): ?>
        <p><?= $flash_message ?></p>
        <?php endif; ?>
        <?php if($error_message !== null): ?>
        <p><?= $error_message ?></p>
        <?php endif; ?>
        <form action="login_check.php" method="POST">
            メールアドレス：　<input type="text" name="email"><br>
            パスワード：　<input type="password" name="password"><br>
            <input type="submit" value="ログイン"><br>
        </form>
        
        <p><a href="signup.php">新規会員登録</a></p>
    </body>
</html>