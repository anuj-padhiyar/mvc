<?php
namespace Model\Core;
class Message extends \Model\Core\Session{
    //use Model\Core\Message\Trait;

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

    public function setFailuer($message){
        $this->failuer = $message;
        return $this;
    }
    public function getFailure(){
        if(empty($_SESSION)){
            return null;
        }
        return $this->failuer;
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