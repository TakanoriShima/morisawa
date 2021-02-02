<?php
    
    require_once 'UserDAO.php';
    
    class Message{
        
        public $id;
        public $usre_id;
        public $title;
        public $content;
        public $image;
        public $created_at;

        public function __construct($user_id="", $title="",$content="",$image=""){
            $this->user_id = $user_id;
            $this->title = $title;
            $this->content = $content;
            $this->image = $image;
        }
        
        public function validate(){
            $errors = array();
    
             if($this->title === ''){
                $errors[] = "タイトルを入力してください";
             }
             
             if($this->content === ''){
                 $errors[] = "内容を入力してください";
             }
             
             if($this->image === ''){
                 $errors[] = "画像を選択してください";
        
             }
            return $errors;
        }
        
        // 投稿したユーザ情報を取得するメソッド
        public function get_user(){
            $user = UserDAO::get_user_by_id($this->user_id);
            return $user;
        }
    }
?>