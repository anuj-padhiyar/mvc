<?php

namespace Block\Admin\Cart;
class PlaceOrder extends \Block\Core\Template{
    protected $placeOrder = null;

    public function __construct(){
        $this->setTemplate('./View/admin/cart/placeOrder.php');
    }

    public function setPlaceOrder(){
        $placeOrder = \Mage::getModel('Model\PlaceOrder');
        $this->placeOrder = $placeOrder;
        return $this;
    }
    public function getPlaceOrder(){
        if(!$this->placeOrder){
            $this->setPlaceOrder();
        }
        return $this->placeOrder;
    }
}


?>