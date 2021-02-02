<?php
    
    class Human{
        
        public $name; 
        public $title;
        public $message;
        public $image;

        public function __construct($name="", $title="",$message="",$image=""){
            $this->name = $name;
            $this->title = $title;
            $this->message = $message;
            $this->image = $image;
        }
        
        public function validate(){
            $errors = array();
             if($this->name === ''){
                $errors[] = "お名前を入力してください";
             }
    
             if($this->title === ''){
                $errors[] = "タイトルを入力してください";
             }
             
             if($this->message === ''){
                 $errors[] = "内容を入力してください";
             }
             
             if($this->image === ''){
                 $errors[] = "画像を選択してください";
        
             }
            return $errors;
        }
    }
?>