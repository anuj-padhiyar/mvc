<?php
namespace Block\Admin\CustomerGroup;
\Mage::loadFileByClassName('Block\Core\Template');

class Edit extends \Block\Core\Template{
    protected $customerGroup = null;

    function __construct(){   
        $this->setTemplate('./View/admin/customerGroup/edit.php'); 
    }

    public function setCustomerGroup($customerGroup = null){
        if(!$customerGroup){
            $customerGroup = \Mage::getModel('Model\CustomerGroup');
            if($id = $this->getRequest()->getGet('groupId')){
                $customerGroup->load($id);
            }
            $this->customerGroup = $customerGroup;
            return $this;
        }
    }
    public function getCustomerGroup(){
        if(!$this->customerGroup){
            $this->setCustomerGroup();
        }
        return $this->customerGroup;
    }

    public function getTabContent(){
        $tabBlock = \Mage::getBlock('Block\Admin\CustomerGroup\Edit\Tabs');
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab',$tabBlock->getDefaultTab());
        if(!array_key_exists($tab, $tabs)){
            return null;
        }
        $blockClassName = $tabs[$tab]['block'];
        $block = \Mage::getBlock($blockClassName);
        echo $block->toHtml();
    }
}