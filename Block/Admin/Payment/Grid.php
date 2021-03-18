<?php
namespace Block\Admin\Payment;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template{
    protected $payments = [];

    public function __construct(){
        $this->setTemplate('./View/admin/payment/grid.php');
    }
    public function setPayment($payments = null){
        if(!$payments){
            $payments = \Mage::getModel('Model\Payment');
            $payments = $payments->fetchAll()->getData();
        }
        $this->payments =$payments;
        return $this;
    }
    public function getPayment(){
        if(!$this->payments){
            $this->setPayment();
        }
        return $this->payments;
    }
}

?>