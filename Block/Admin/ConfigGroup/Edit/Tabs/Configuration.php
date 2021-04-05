<?php

namespace Block\Admin\ConfigGroup\Edit\Tabs;

class Configuration extends \Block\Core\Template{
    protected $configGroup = null;
    public function __construct(){
        $this->setTemplate('./View/admin/configGroup/edit/tabs/configuration.php');
    }

    public function setConfigGroup($configGroup = null){
        if(!$configGroup){
            $configGroup = \Mage::getModel('Model\ConfigGroup');
            if($id = $this->getRequest()->getGet('groupId')){
                $configGroup = $configGroup->load($id);
            }
        }
        $this->configGroup = $configGroup;
        return $this;
    }
    public function getConfigGroup(){
        if(!$this->configGroup){
            $this->setConfigGroup();
        }
        return $this->configGroup;
    }
}


?>