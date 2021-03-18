<?php
namespace Block\Admin\Payment;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $payment = null;
    
    public function __construct(){
        $this->setTemplate('./View/admin/payment/edit.php');
    }
    public function setPayment($payment = NULL){
        if($payment != NULL){
            $payment = \Mage::getModel('Model\Payment');
            if($id = $this->getController()->getRequest()->getGet('methodId')){
                $payment = $payment->load($id);
            }
            $this->payment = $payment;
            return $this;
        }
    }
    public function getPayment(){
        if(!$this->payment){
            $this->setPayment();
        }
        return $this->payment;
    }

    public function getTabContent(){
        $tabBlock = \Mage::getBlock('Block\Admin\Payment\Edit\Tabs');
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
?>