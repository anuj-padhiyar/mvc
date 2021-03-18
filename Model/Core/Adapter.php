<?php

namespace Model\Core;
class Adapter{
    private $config=[
        'host'=>'localhost',
        'username'=>'ubuntu',
        'password'=>'',
        'database'=>'Session3'
    ];
    private $connect = null;

    public function connection(){
        $connect = new \mysqli($this->config['host'],
            $this->config['username'],
            $this->config['password'],
            $this->config['database']);

        $this->setConnect($connect);
        if(!$connect){
            return false;
        }
        return true;
    }

    public function setConnect(\mysqli $connect){
        $this->connect = $connect;
        return $this;
        
    }
    public function getConnect(){
        return $this->connect;
    }
    public function isConnected(){
        if(!$this->getConnect()){
            return false;
        }
        return true;
    }
    public function insert($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        if(!$result){
            return false;
        }
        return true;
    }
    public function update($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }
    public function fetchOne($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        return $result->num_rows;
    }
    public function fetchRow($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        $row = $result->fetch_assoc();
        if(!$row){
            return false;
        }
        return $row;
    }
    public function fetchAll($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if(!$rows){
            return false;
        }
        return $rows;
    }
    public function delete($query){
        if(!$this->isConnected()){
            $this->connection();
        }
        $result = $this->getConnect()->query($query);
        return $result;
    }
}


?>