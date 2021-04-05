<?php
namespace Block\Admin\Customer\Edit\Tabs;
class Address extends \Block\Core\Template{
    protected $customer = null;

    function __construct(){   
       $this->setTemplate('./View/admin/customer/edit/tabs/address.php'); 
    }

    public function getCustomer(){
        if(!$this->customer){
            $this->setCustomer();
        }
        return $this->customer;
    }

    public function setCustomer($customer = null){
        if(!$customer){
            $id = $this->getRequest()->getGet('customerId');
            $customer = \Mage::getModel('Model\Customer');
            $customer->customerId = $id;
        }
        $this->customer =  $customer;
        return $this;
    }
}

?>