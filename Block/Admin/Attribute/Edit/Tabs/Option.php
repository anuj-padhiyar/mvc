<?php
namespace Block\Admin\Attribute\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class Option extends \Block\Core\Template{
    protected $attribute = null;

    public function __construct(){
        $this->setTemplate('View/admin/attribute/edit/tabs/option.php');
    }
    
    public function setAttribute($attribute = null){
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
}


?>