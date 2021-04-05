<?php

namespace Model;
class Cart extends \Model\Core\Table{
    protected $customer = null;
    protected $allCustomer = null;
    protected $items = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;
    protected $cartShipping = null;
    protected $cartBilling = null;
    protected $shippingMethod = null;
    protected $paymentMethod = null;

    public function __construct(){
        $this->setTableName('cart');
        $this->setPrimaryKey('cartId');
    }

    public function setShippingMethod(\Model\Core\Table\Collection $shippingMethod){
        $this->shippingMethod = $shippingMethod;
        return $this;

    }
    public function getShippingMethod(){
        $shippingMethod = \Mage::getModel('Model\Shipping')->fetchAll();
        if($shippingMethod){
            $this->setShippingMethod($shippingMethod);
            return $this->shippingMethod;
        }
        return null;
    }

    public function setPaymentMethod(\Model\Core\Table\Collection $paymentMethod){
        $this->paymentMethod = $paymentMethod;
        return $this;
    }
    public function getPaymentMethod(){
        $paymentMethod = \Mage::getModel('Model\Payment')->fetchAll();
        if($paymentMethod){
            $this->setPaymentMethod($paymentMethod);
            return $this->paymentMethod;
        }
        return null;
    }
    public function setCustomer(\Model\Customer $customer){
        $this->customer = $customer;
        return $this;
    }
    public function getCustomer(){
        if ($this->customer){
            return $this->customer;
        }
        if (!$this->customerId){
            return false;
        }
        $customer = \Mage::getModel('Model\Customer')->load($this->customerId);
        $this->setCustomer($customer);
        return $this->customer;
    }

    public function setAllCustomer(\Model\Core\Table\Collection $allCustomer){
        $this->allCustomer = $allCustomer;
        return $this;
    }
    public function getAllCustomer(){
        $allCustomer = \Mage::getModel('Model\Customer')->fetchAll();
        $this->setAllCustomer($allCustomer);
        return $this->allCustomer;
    }

    public function setItems(\Model\Core\Table\Collection $items){
        $this->items = $items;
        return $this;
    }
    public function getItems(){
        if (!$this->cartId){
            return false;
        }
        $query = "SELECT * FROM `cart_item` WHERE `cartId` = '{$this->cartId}'";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        if(!$items){
            return false;
        }
        $this->setItems($items);
        return $items;
    }

    public function setCartBillingAddress(\Model\Cart\Address $cartBilling){
        $this->cartBilling = $cartBilling;
        return $this;
    }
    public function getCartBillingAddress(){
        $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$this->cartId}' AND `addressType` = '".\Model\Cart\Address::ADDRESS_TYPE_BILLING."'";
        $cartBilling = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if($cartBilling){
            $this->setCartBillingAddress($cartBilling);
            return $this->cartBilling;
        }
        return null;
    }

    public function setCartShippingAddress(\Model\Cart\Address $cartShipping){
        $this->cartShipping = $cartShipping;
        return $this;
    }
    public function getCartShippingAddress(){
        $query = "SELECT * FROM `cart_address` WHERE `cartId` = '{$this->cartId}' AND `addressType` = '".\Model\Cart\Address::ADDRESS_TYPE_SHIPPING."'";
        $cartShipping = \Mage::getModel('Model\Cart\Address')->fetchRow($query);
        if($cartShipping){
            $this->setCartShippingAddress($cartShipping);
            return $this->cartShipping;
        }
        return null;
    }
    public function setBillingAddress($address){
        $this->billingAddress = $address;
        return $this;
    }
    public function getBillingAddress(){
        if (!$this->cartId){
            return false;
        }
        if($billingAddress = $this->getCartBillingAddress()){
            $this->setBillingAddress($billingAddress);
            return $this->billingAddress;
        }
        if($address = $this->getCustomer()->getBillingAddress()){
            $this->setBillingAddress($address);
            return $this->billingAddress;
        }
        return null;
    }

    public function setShippingAddress($address){
        $this->shippingAddress = $address;
        return $this;
    }
    public function getShippingAddress(){
        if (!$this->cartId){
            return false;
        }
        if($shippingAddress = $this->getCartShippingAddress()){
            $this->setShippingAddress($shippingAddress);
            return $this->shippingAddress;
        }
        if($address = $this->getCustomer()->getShippingAddress()){
            $this->setShippingAddress($shippingAddress);
            return $this->shippingAddress;
        }
        return null;
    }

    public function addItemToCart($product, $quantity = 1, $addMode = false){
        if(!$this->cartId){
            return false;
        }
        $query = "SELECT * FROM `cart_item` WHERE `cartId`='{$this->cartId}' AND `productId`='{$product->productId}'";
        $cartItem = \Mage::getModel('Model\Cart\Item')->fetchRow($query);
        if($cartItem){
            $cartItem->quantity += $quantity;
            $cartItem->price = $cartItem->getRowTotal();
            $cartItem->save();
            return true;
        }
        
        $cartItem = \Mage::getModel('Model\Cart\Item');
        $cartItem->cartId = $this->cartId;
        $cartItem->productId = $product->productId;
        $cartItem->basePrice = $product->price;
        $cartItem->price = $cartItem->getRowTotal();
        $cartItem->quantity = $quantity;
        $cartItem->discount = $product->discount;
        $cartItem->createdDate = Date("Y-m-d H:i:s");
        $cartItem->save();
        return true;
    }

    public function getTotal($items){
        $final = 0;
        if($items){
            foreach($items->getData() as $key=>$item){
                $final += $item->getRowTotal();
            }
        }
        return $final;
    }
    public function getTotalDiscount($items){
        $discount = 0;
        if($items){
            foreach($items->getData() as $key=>$item){
                $discount += $item->getDiscount();
            }
        }
        return $discount;
    }
    public function getShippingAmount(){
        if(!$this->shippingMethodId){
            return false;
        }
        foreach($this->getShippingMethod()->getData() as $key=>$value){
            if($value->methodId == $this->shippingMethodId){
                return $value->amount;
            }
        }
    }
    public function getFinalPrice($items){
        return $this->getTotal($items) - $this->getTotalDiscount($items) + $this->getShippingAmount();
    }

    public function getAddressValue($address,$value){
        $address .= 'Address';
        if($this->$address && array_key_exists($value,$this->$address->getOriginalData())){
            return $this->$address->$value;
        }
        return null;
    }
}

?>