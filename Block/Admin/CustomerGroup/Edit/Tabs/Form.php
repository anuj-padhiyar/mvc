<?php
namespace Block\Admin\CustomerGroup\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{
    protected $customerGroup = null;

    function __construct(){   
       $this->setTemplate('./View/admin/customerGroup/edit/tabs/form.php'); 
    }

    public function setCustomerGroup($customerGroup = NULL){
        if (!$customerGroup){
            $customerGroup = \Mage::getModel('Model\CustomerGroup');
            if ($id = $this->getRequest()->getGet('groupId')){ 
                $customerGroup = $customerGroup->load($id);
            }
        }
        $this->customerGroup = $customerGroup;
        return $this;
    }
    public function getCustomerGroup(){
        if (!$this->customerGroup){
            $this->setCustomerGroup();
        }
        return $this->customerGroup;
    }
    
}

?>