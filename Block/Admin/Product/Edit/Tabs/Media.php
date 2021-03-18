<?php
namespace Block\Admin\Product\Edit\Tabs;
\Mage::getBlock("Block\Core\Template");
class Media extends \Block\Core\Template{
    protected $media = [];

    function __construct(){   
       $this->setTemplate('./View/admin/product/edit/tabs/media.php'); 
    }

    public function setMedia($media = null){
        if($media){
           $this->media = $media;
           return $this; 
        }
        $product = \Mage::getModel('Model\Product');
        if($id = $this->getRequest()->getGet('productId')){
            $query = "SELECT * FROM `product_media` WHERE `productId`={$id}";
            $array = $product->fetchAll($query)->getData();
            if($array){
                foreach($array as $key=>$value){
                    $this->media[] = $value->getData();
                }
            }
        }
        return $this;
    }
    public function getMedia(){
        if(!$this->media){
            $this->setMedia();
        }
        return $this->media;
    }
}
?>