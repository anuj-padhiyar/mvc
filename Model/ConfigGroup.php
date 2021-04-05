<?php

namespace Model;
class ConfigGroup extends \Model\Core\Table{
    public function __construct(){
        parent::__construct();
        $this->setTableName("config_group");
        $this->setPrimaryKey("groupId");
    }

    public function getConfig(){
        if(!$this->groupId){
            return false;
        }
        $query = "SELECT * FROM `config` WHERE `groupId`= '{$this->groupId}'";
        if($config = \Mage::getModel('Model\ConfigGroup')->fetchAll($query)){
            $config = $config->getData();
        }
        return $config;
    }
}

?>