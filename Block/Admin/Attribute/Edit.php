<?php
namespace Block\Admin\Attribute;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $attribute = null;

    public function __construct(){
        $this->setTemplate('View/admin/attribute/edit.php');
    }
    public function setAttribute($attribute = NULL){
        if(!$attribute){
            $attribute = \Mage::getModel('Model\Attribute');
            if($id = $this->getRequest()->getGet('attributeId')){
                $attribute = $attribute->load($id);
            }
        }
        $this->attribute = $attribute;
        return $this;
    }
    public function getAttribute(){
        if(!$this->attribute){
            $this->setAttribute();
        }
        return $this->attribute;
    }

    
    public function getTabContent(){
        $tabBlock = \Mage::getBlock('Block\Admin\Attribute\Edit\Tabs');
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