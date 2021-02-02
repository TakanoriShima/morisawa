<?php
    require_once 'config.php';
    require_once 'User.php';
    
    // DAO
    class UserDAO{
        // データベースと接続
        private static function get_connection(){
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
        
        // データベースとの切断
        private static function close_connection($pdo, $stmt){
            $pdo = null;
            $stmt = null;
        }
        
        // 全会員情報を取得
        public static function get_all_users(){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行
                $stmt = $pdo->query('SELECT * FROM users');
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                // 会員一覧を取得
                $users = $stmt->fetchAll();

            }catch(PDOException $e){
                $users =  null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // 全会員データを返す
            return $users;  
        }
        
        // 会員番号から会員情報を取得
        public static function get_user_by_id($id){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行準備
                $stmt = $pdo->prepare('SELECT * FROM users WHERE id=:id');
                // バインド処理
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                // 会員を取得
                $user = $stmt->fetch();

            }catch(PDOException $e){
                $users =  null;
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
            // 会員データを返す
            return $user;  
        }
        
        // usersテーブルに新規にデータを追加
        public static function insert($user){
            
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // INSERT文準備
                $stmt = $pdo->prepare('INSERT INTO users(name, email, password) VALUES(:name, :email, :password)');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':name', $user->name, PDO::PARAM_STR);
                $stmt->bindParam(':email', $user->email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $user->password, PDO::PARAM_STR);
                // INSERT本番実行
                $stmt->execute();
                
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // 会員登録入力チェック
        public static function check_new_user($name, $email, $password){
            $errors = array();
            
            if($name == ''){
                $errors[] = '名前を入力してください';
            }
            if($email === ''){
                $errors[] = 'メールアドレスを入力してください';
            }else if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email)){
                $errors[] = 'メールアドレスではありません';
            }else if(self::check_duplicate_email($email) === true){
                $errors[] = 'そのメールはすでに登録されています';
            }
            if($password === ''){
                $errors[] = 'パスワードを入力してください';
            }
            
            return $errors;
            
        }
        
        // ログイン入力チェック
        public static function check_login_input($email, $password){
            $errors = array();
            
            if($email === ''){
                $errors[] = 'メールアドレスを入力してください';
            }else if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email)){
                $errors[] = 'メールアドレスではありません';
            }
            
            if(strlen($password) < 5){
                $errors[] = 'パスワードは5文字以上にしてください';
            }
            
            return $errors;
            
        }
        
        // メールアドレス重複チェック
        public static function check_duplicate_email($email){
            try{
                // データベース接続
                $pdo = self::get_connection();
                // SELECT文実行
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                
                // 会員を取得
                $user = $stmt->fetch();
                
                // 重複あり
                if($user){
                    return true;
                }else{ // 重複なし
                    return false;
                }

            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // ログイン処理
        public static function login($email, $password){
            
            try{
                // データベースに接続
                $pdo = self::get_connection();
                
                // SELECT文実行
                $stmt = $pdo->prepare('SELECT * FROM users WHERE email=:email AND password=:password');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                // SELECT文本番実行
                $stmt->execute();
                // フェッチの結果を、Userクラスのインスタンスにマッピングする
                $stmt->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, 'User');
                
                // 会員を取得
                $user = $stmt->fetch();
                
                return $user;
                
                
            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        // ログアウト（ログインフラッグをOFFにセット）
        public static function logout($user_id){
            
            try{
                // データベースに接続
                $pdo = self::get_connection();
                // UPDATE 文実行準備
                $stmt = $pdo->prepare('UPDATE users SET login_flag=0 WHERE id=:id');
                // バインド処理（上のあやふやな部分は実はこれでした）
                $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
                // UPDATE文本番実行
                $stmt->execute();

            }catch(PDOException $e){
            }finally{
                // データベース切断
                self::close_connection($pdo, $stmt);
            }
        }
        
        
    }