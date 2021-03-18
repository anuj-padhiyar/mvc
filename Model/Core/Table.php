<?php
namespace Model\Core;
class Table{

    protected $primaryKey = null;
    protected $tableName = null;
    protected $data = [];
    protected $adapter = null;

    public function __construct(){
    }

    public function getPrimaryKey(){
        return $this->primaryKey;
    }
    public function setPrimaryKey($p){
        $this->primaryKey = $p;
    }

    public function getTableName(){
        if(!$this->tableName){
            $this->setTableName();
        }
        return $this->tableName;
    }
    public function setTableName($t){
        $this->tableName = $t;
        return $this;
    }

    public function getData(){
        return $this->data;
    }
    public function setData($data){
        $this->data = $data;
        return $this;
    }
    
    public function __get($key){
        if(!array_key_exists($key, $this->data)){
            return null;
        }
        return $this->data[$key];
    }
    public function __set($key, $value){
        $this->data[$key] = $value;
        return $this;
    }
    
    public function getAdapter(){
        if(!$this->adapter){
            $this->setAdapter();
        }
        return $this->adapter;
    }
    public function setAdapter($adapter = null){
        if(!$adapter){
            $this->adapter = \Mage::getModel('Model\Core\Adapter');
        }
        return $this->adapter;
    }

    public function load($value){
        $value = (int)$value;
        $query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}`={$value}";
        return $this->fetchRow($query);
    }
    public function fetchRow($query){
        $row = $this->getAdapter()->fetchRow($query);
        if(!$row){
            return false;
        }
        $this->data = $row;
        return $this;
    }

    public function fetchAll($query = null){
        if(!$query){
            $query = "SELECT * FROM `{$this->getTableName()}`";
        }
        $rows = $this->getAdapter()->fetchAll($query);
        if(!$rows){
            return false;
        }
        foreach($rows as $key => $value){
            $key = new $this;
            $key->setData($value);
            $newRows[] = $key;
        }
        $collection = \Mage::getModel('Model\Core\Table\Collection')->setData($newRows);
        unset($key);
        return $collection;
    }

    public function save($query = null){
        if(!$query){
            $data = $this->getData();
            if(array_key_exists($this->getPrimaryKey(), $data)){
                $query = "UPDATE `{$this->getTableName()}` SET ";            
                foreach ($data as $key => $value) {
                    if($key == $this->getPrimaryKey()){
                        continue;
                    }
                    $query.= $key.'='."'$value'" .',';
                }
                $query = substr($query, 0, -1);
                $query .= " WHERE `{$this->getPrimaryKey()}` = '{$data[$this->getPrimaryKey()]}'";
            }else{
                $query = "INSERT INTO `{$this->getTableName()}` (".implode(",", array_keys($data)) . ") VALUES ('" . implode("','", array_values($data)) . "')"; 
            }
        }
        return $this->getAdapter()->insert($query);
    }

    public function addresssave(){
        $data = $this->getData();
        if(array_key_exists($this->getPrimaryKey(), $data)){
            $query = "UPDATE `{$this->getTableName()}` SET ";            
            foreach ($data as $key => $value) {
                if($key == $this->getPrimaryKey()){
                    continue;
                }
                $query.= $key.'='."'$value'" .',';
            }
            $query = substr($query, 0, -1);
            $query .= " WHERE `{$this->getPrimaryKey()}` = '{$data[$this->getPrimaryKey()]}'";
            $query .= "&& `addressType` = '{$data['addressType']}'";
        }
        $rows = $this->getAdapter()->fetchAll("SELECT `customerId` FROM `customer_address`");
        $arr = [];
        foreach($rows as $key=>$value){
            $arr[] = $value['customerId'];
        }
        if(count(array_keys($arr,$data['customerId'])) != 2 || !$arr){
            $query = "INSERT INTO `{$this->getTableName()}` (".implode(",", array_keys($data)) . ") VALUES ('" . implode("','", array_values($data)) . "')"; 
        }
        return $this->getAdapter()->insert($query);
    }
   
    public function delete($deletequery = null){
        if(!$deletequery){
            $deletequery = "DELETE FROM `{$this->getTableName()}` WHERE `{$this->getPrimaryKey()}` = {$this->data[$this->getPrimaryKey()]}";
        }
        $this->getAdapter()->delete($deletequery);
        return true;
    }
}


?>