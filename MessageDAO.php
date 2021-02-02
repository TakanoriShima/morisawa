<?php
    require_once "Message.php";
    require_once "User.php";
    
    //dao
    class MessageDAO {
        //データーベースへ接続メソッド
        public static function get_connection(){
            $dsn = 'mysql:host=localhost;dbname=sns';
            $username = 'root';
            $password = '';
            $options = array(
                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
                 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',  
            );
            $dbh = new PDO($dsn, $username, $password, $options);
            return $dbh;
        }
        //データーベースから切断するメソッド
        public static function close_connection($dbh, $stmt){
            $dbh = null;
            $stmt = null;
            
        }
        //データーベースから全投稿情報を取得するメソッド
        public static function get_all_messages(){
            try {
                $dbh = self::get_connection();
                $stmt = $dbh->query('select * from sns.messages order by id desc');
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Message');
                $humans = $stmt->fetchAll();
                
            } catch(PDOException $e) {
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
            return $humans;
         }
        //データーベースに新規投稿を登録するメソッド
        public static function insert($message){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('insert into messages (user_id, title, content, image) values (:user_id, :title, :content, :image)');
                $stmt->bindParam(':user_id', $message->user_id, PDO::PARAM_STR);
                $stmt->bindValue(':title',$message->title,PDO::PARAM_STR);
                $stmt->bindValue(':content',$message->content,PDO::PARAM_STR);
                $stmt->bindValue(':image',$message->image);
                // $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Human');
                $stmt->execute();
                
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
        
        //IDを指定して投稿を削除するメソッド
        public static function delete($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('delete from sns.messages where id = :id');
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
        //IDを指定して一人の投稿を抜き出すメソッド
        public static function get_message_by_id($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('select * from sns.messages where id = :id');
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Message');
                $message = $stmt->fetch();
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
            return $message;
        }
        //IDを指定して投稿情報を変更するメソッド
        public static function update($id, $title, $content, $image){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('update sns.messages set title= :title, content= :content, image= :image where id= :id');
                $stmt->bindValue(':title',$title,PDO::PARAM_STR);
                $stmt->bindValue(':content',$content,PDO::PARAM_STR);
                $stmt->bindValue(':image',$image);
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
    
             // ファイルをアップロードするメソッド
    public function upload(){
        // ファイルを選択していれば
        if (!empty($_FILES['image']['name'])) {
            // ファイル名をユニーク化
            $image = uniqid(mt_rand(), true); 
            // アップロードされたファイルの拡張子を取得
            $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
            $file = 'upload/'. $image;
        
            // uploadディレクトリにファイル保存
            move_uploaded_file($_FILES['image']['tmp_name'], $file);
            
            return $image;
        }else{
            return '';
        }
    }

}