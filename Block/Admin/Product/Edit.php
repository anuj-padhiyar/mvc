<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $product = null;

    public function __construct(){
        $this->setTemplate('./View/admin/product/edit.php');
    }

    public function setProduct($product = NULL){
        if($product != NULL){
            $product = \Mage::getModel('Model\Product');
            if($id = $this->getController()->getRequest()->getGet('productId')){
                $product = $product->load($id);
            }
            $this->product = $product;
            return $this;
        }
    }
    public function getProduct(){
        if(!$this->product){
            $this->setProduct();
        }
        return $this->product;
    }
    
    public function getTabContent(){
        $tabBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab',$tabBlock->getDefaultTab());
        if(!array_key_exists($tab, $tabs)){
            return null;
        }
        $blockClassName = $tabs[$tab]['block'];
        $block = \Mage::getBlock($blockClassName);
        echo $block->toHtml();
    
    }
    public function getUrl($actionName = NULL, $controllerName = NULL, $params =[], $resetParam = false){
        return $this->getController()->getUrl($actionName, $controllerName, $params, $resetParam);
    }
    
}
?>