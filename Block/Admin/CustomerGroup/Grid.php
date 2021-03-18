<?php
namespace Block\Admin\CustomerGroup;
\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends  \Block\Core\Template{
    protected $customerGroups = [];

    public function __construct(){
        $this->setTemplate('./View/admin/customerGroup/grid.php');
    }

    public function setCustomerGroup($customerGroups = null){   
        if(!$customerGroups){
            $customerGroups = \Mage::getModel('Model\CustomerGroup')->fetchAll()->getData();
        }
        $this->customerGroups = $customerGroups;
        return $this;
    }
    public function getCustomerGroup(){
        if(!$this->customerGroups){
            $this->setCustomerGroup();
        }
        return $this->customerGroups;
    }
}

?>