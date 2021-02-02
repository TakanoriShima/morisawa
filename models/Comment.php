<?php
    
    require_once 'daos/UserDAO.php';
    
    class Comment{
        
        public $id;
        public $user_id;
        public $message_id;
        public $content;
        public $created_at;
        
        public function __construct($user_id="", $message_id="", $content=""){
            $this->user_id = $user_id;
            $this->message_id = $message_id;
            $this->content = $content;
        }
        
        public function validate(){
            $errors = array();

             if($this->content === ''){
                 $errors[] = "内容を入力してください";
             }
            
            return $errors;
        }
        
        public function get_user(){
            $user = UserDAO::get_user_by_id($this->user_id);
            return $user;
        }
    }
?>