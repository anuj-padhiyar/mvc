<?php
namespace Block\Admin\Payment\Edit\Tabs;
class Form extends \Block\Core\Template{
    protected $payment = null;

    function __construct(){   
       $this->setTemplate('./View/admin/payment/edit/tabs/form.php'); 
    }

    public function setPayment($payment = NULL){
        if (!$payment){
            $payment = \Mage::getModel('Model\Payment');
            if ($id = $this->getRequest()->getGet('methodId')){ 
                $payment = $payment->load($id);
            }
        }
        $this->payment = $payment;
        return $this;
    }
    public function getPayment(){
        if (!$this->payment){
            $this->setPayment();
        }
        return $this->payment;
    }
    
}

?>