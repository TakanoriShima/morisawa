<?php
    class User{
        // プロパティ
        public $id;
        public $name;
        public $email;
        public $password;
        public $created_at;
        
        // コンストラクタ
        public function __construct($name="", $email="", $password=""){
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
        }
        
        // 入力チェック
        public function validate(){
            $errors = array();
            if($this->name === ''){
                $errors[] = '名前を入力してください';
            }
            if($this->email === ''){
                $errors[] = 'メールアドレスを入力してください';
            }else if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $this->email)){
                $errors[] = 'メールアドレスではありません。正しく入力してください';
            }
            if($this->password === ''){
                $errors[] = 'パスワードを入力してください';
            }
            
            return $errors;
        }
    }