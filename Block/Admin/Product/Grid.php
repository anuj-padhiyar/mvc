<?php
namespace Block\Admin\Product;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template{
    protected $products = [];

    public function __construct(){
        $this->setTemplate('./View/admin/product/grid.php');
    }
    public function setProduct($products = null){
        if(!$products){
            $products = \Mage::getModel('Model\Product');
            $products = $products->fetchAll()->getData();
        }
        $this->products =$products;
        return $this;
    }
    public function getProduct(){
        if(!$this->products){
            $this->setProduct();
        }
        return $this->products;
    }
}

?>