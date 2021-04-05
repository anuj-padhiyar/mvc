<?php

namespace Block\Admin\Product\Edit\Tabs;
class Attribute extends \Block\Core\Template{
    protected $attributes = [];

    public function __construct(){
        $this->setTemplate('./View/admin/product/edit/tabs/attribute.php');
    }

    public function setAttributes($attributes = null){
        if(!$attributes){
            $attribute = \Mage::getModel('Model\Attribute');
            if($id = $this->getRequest()->getGet('productId')){
                // echo $query = "SELECT * 
                //     FROM `attribute` a 
                //     JOIN `attribute_option` o 
                //     ON a.`attributeId` = o.`attributeId`
                //     WHERE a.`entityTypeId` = 'product'";
                //     die;
                $query = "SELECT * 
                            FROM `attribute` 
                            WHERE `entityTypeId` = 'product'";
                $attributes = $attribute->fetchAll($query)->getData();
            }
        }
        $this->attributes = $attributes;
        return $this;
    }
    public function getAttributes(){
        if(!$this->attributes){
            $this->setAttributes();
        }
        return $this->attributes;
    }
}


?>