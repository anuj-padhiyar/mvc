<?php
namespace Block\Admin\Customer\Edit\Tabs;
class Form extends \Block\Core\Template{

    protected $customer = null;
    protected $group = null;

    function __construct(){   
       $this->setTemplate('./View/admin/customer/edit/tabs/form.php'); 
    }

    public function setCustomer($customer = NULL){
        if ($customer){
            $this->customer = $customer;
            return $this;
        }
        $customer = \Mage::getModel('Model\Customer');

        if ($id = $this->getRequest()->getGet('customerId')){ 
            $customer = $customer->load($id);
        }
        $this->customer = $customer;
        return $this;
    }
    public function getCustomer(){
        if (!$this->customer){
            $this->setCustomer();
        }
        return $this->customer;
    }
    
    public function getGroup(){
        if(!$this->group){
            $this->setGroup();
        }
        return $this->group;
    }
    public function setGroup($group = null){
        if($group == null){
            $group = $this->getCustomer()->getAdapter()->fetchAll("SELECT `name`, `groupId` FROM `customer_group`");
        }
        $this->group = $group;
        return $this;
    }
}

?>