<?php 

namespace Model\Cart;
class Address extends \Model\Core\Table {
    const ADDRESS_TYPE_BILLING = "billing";
    const ADDRESS_TYPE_SHIPPING = "shipping";
    protected $cart = null;
    protected $shippingAddress = null;
    protected $billingAddress = null;

    public function __construct(){
        $this->setTableName('cart_address');
        $this->setPrimaryKey('cartAddressId');
    }

    public function setCart(\Model\Cart $cart){
        $this->cart = $cart;
        return $this;
    }
    public function getCart(){
        if (!$this->cartId){
            return false;
        }
        $cart = \Mage::getModel('Model\Cart')->load($this->cartId);
        $this->setCart($cart);
        return $this->cart;
    }

}

?>