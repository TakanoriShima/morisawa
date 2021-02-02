<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>個別編集</title>
</head>
<body>
    <h1>投稿の編集</h1>
    
    
    <form action="edit.done.php" method="post" enctype="multipart/form-data">
        <div>タイトル</div>
        <div><input type="text" name="title" value="<?= $message->title ?>"></div><br/>
        <div>メッセージ</div>
        <div><input type="text" name="content" value="<?= $message->content ?>"></div><br/>
        <div>現在の画像</div>
        <img src='upload/<?= $message->image ?>'>
        <input type="hidden" name="id" value="<?= $message->id ?>">
        <div><input type="file" name="image"></div><br/>
        
        <input type="button" onclick="history.back()" value="戻る"> 
        <input type="submit" value="更新">   
    </form>
    
</body>
</html>