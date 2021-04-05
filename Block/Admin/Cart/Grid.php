<?php

namespace Block\Admin\Cart;
class Grid extends \Block\Core\Template{
    protected $cart = null;

    public function __construct(){
        $this->setTemplate('./View/admin/cart/grid.php');
    }

    public function setCart(\Model\Cart $cart = null){
        $this->cart = $cart;
        return $this;
    }
    public function getCart(){
        if(!$this->cart){
            throw new \Exception("Cart Is Not Set");
        }
        return $this->cart;
    }
}


?>