<?php
    
    class Comment{
        
        public $id;
        public $message_id;
        public $name; 
        public $message;
        public $created_at;
        

        public function __construct($message_id="", $name="", $message=""){
            $this->message_id = $message_id;
            $this->name = $name;
            $this->message = $message;
        }
        
        public function validate(){
            $errors = array();
             if($this->name === ''){
                $errors[] = "お名前を入力してください";
             }

             
             if($this->message === ''){
                 $errors[] = "内容を入力してください";
             }
            
            return $errors;
        }
    }
?>