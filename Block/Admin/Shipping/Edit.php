<?php
namespace Block\Admin\Shipping;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $shipping = null;

    public function __construct(){
        $this->setTemplate('./View/admin/shipping/edit.php');
    }
    public function setShipping($shipping = NULL){
        if(!$shipping){
            $shipping = \Mage::getModel('Model\Shipping');
            if($id = $this->getController()->getRequest()->getGet('methodId')){
                $shipping = $shipping->load($id);
            }
        }
        $this->shipping = $shipping;
        return $this;
    }
    public function getShipping(){
        if(!$this->shipping){
            $this->setShipping();
        }
        return $this->shipping;
    }
    
    public function getTabContent(){
        $tabBlock = \Mage::getBlock('Block\Admin\Shipping\Edit\Tabs');
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