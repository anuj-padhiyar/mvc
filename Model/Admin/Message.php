<?php

namespace Model\Admin;
class Message extends \Model\Admin\Session{
    //use Model\Core\Message\Trait;

    public function __construct(){
        parent::__construct();
    }
    
    public function setSuccess($message){
        $this->success = $message;
        return $this;
    }
    public function getSuccess(){
        if(empty($_SESSION)){
            return null;
        }
        return $this->success;
    }

    public function setFailure($message){
        $this->failure = $message;
        return $this;
    }
    public function getFailure(){
        if(empty($_SESSION)){
            return null;
        }
        return $this->failure;
    }
    
    public function clearSuccess(){
        unset($this->success);
        return $this;
    }
    public function clearFailure(){
        unset($this->failure);
        return $this;
    }
}


?>