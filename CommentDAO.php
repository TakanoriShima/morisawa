<?php
    require_once 'config.php';
    require_once "Comment.php";
    //dao
    class CommentDAO {
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
            $dbh = new PDO(DSN, DB_USERNAME, DB_PASSWORD, $options);
            return $dbh;
        }
        //データーベースから切断するメソッド
        public static function close_connection($dbh, $stmt){
            $dbh = null;
            $stmt = null;
            
        }
        
        
        //データベースにコメントを登録するメソッド
        public static function insert_comment($comment){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('insert into comments (user_id, message_id, content) values (:user_id, :message_id, :content)');
                $stmt->bindValue(':user_id', $comment->user_id, PDO::PARAM_INT);
                $stmt->bindValue(':message_id',$comment->message_id,PDO::PARAM_INT);
                $stmt->bindValue(':content',$comment->content,PDO::PARAM_STR);
                
                $stmt->execute();
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
        //データーベースから注目する投稿に対する全コメントを取得するメソッド
        public static function get_all_comments($id){
            try {
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('select * from comments where message_id = :message_id order by id desc');
                $stmt->bindValue(':message_id',$id,PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Comment');
                
                $comments = $stmt->fetchAll();
                
            } catch(PDOException $e) {
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
            return $comments;
         }
        //IDを指定して会員を削除するメソッド
        public static function delete($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('delete from sample where id = :id');
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
        //IDを指定して一人の会員を抜き出すメソッド
        public static function get_human_by_id($id){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('select * from sample where id = :id');
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'Human');
                $human = $stmt->fetch();
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
            return $human;
        }
        //IDを指定して会員情報を変更するメソッド
        public static function update($id, $name, $title, $mes, $image_name){
            try{
                $dbh = self::get_connection();
                $stmt = $dbh->prepare('update sample set name= :name,title= :title, message= :message, image= :image where id= :id');
                $stmt->bindValue(':name',$name,PDO::PARAM_STR);
                $stmt->bindValue(':title',$title,PDO::PARAM_STR);
                $stmt->bindValue(':message',$mes,PDO::PARAM_STR);
                $stmt->bindValue(':image',$image_name);
                $stmt->bindValue(':id',$id,PDO::PARAM_INT);
                $stmt->execute();
            }catch(PDOException $e){
                
            }finally{
                self::close_connection($dbh, $stmt);
            }
        }
}