<?php 

namespace Model;
class PlaceOrder extends \Model\Core\Table{
    protected $items = null;
    protected $billing = null;
    protected $shipping = null;

    public function __construct(){
        parent::__construct();
        $this->setTableName("placeOrder");
        $this->setPrimaryKey("orderId");
    }

    public function setItems(\Model\Core\Table\Collection $items){
        $this->items = $items;
        return $this;
    }
    public function getItems(){
        if (!$this->orderId){
            return false;
        }
        $query = "SELECT * FROM `placeOrder_item` WHERE `orderId` = '{$this->orderId}'";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        if(!$items){
            return false;
        }
        $this->setItems($items);
        return $items;
    }

    public function getBillingAddress(){
        if(!$this->orderId){
            return null;
        }
        $query = "SELECT * FROM `placeOrder_address` WHERE `orderId` = {$this->orderId} AND `addressType` = 'billing'";
        $address = \Mage::getModel('Model\PlaceOrder\Address')->fetchRow($query);
        $this->billing = $address;
        return $this->billing;
    }
    public function getShippingAddress(){
        if(!$this->orderId){
            return null;
        }
        $query = "SELECT * FROM `placeOrder_address` WHERE `orderId` = {$this->orderId} AND `addressType` = 'shipping'";
        $address = \Mage::getModel('Model\PlaceOrder\Address')->fetchRow($query);
        $this->shipping = $address;
        return $this->shipping;
    }
    public function getAddressValue($address,$value){
        if($this->$address && array_key_exists($value,$this->$address->getOriginalData())){
            return $this->$address->$value;
        }
        return null;
    }

    public function getPaymentName(){
        if(!$this->paymentMethodId){
            return null;
        }
        return \Mage::getModel('Model\Payment')->load($this->paymentMethodId)->name;
    }
    public function getShippingName(){
        if(!$this->shippingMethodId){
            return null;
        }
        return \Mage::getModel('Model\Shipping')->load($this->shippingMethodId)->name;
    }

    public function getFinalTotal(){
        return $this->total + $this->shippingAmount - $this->discount;
    }
}


?>