<?php 

namespace Model;
class PlaceOrder extends \Model\Core\Table{
    protected $items = null;

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
        if (!$this->cartId){
            return false;
        }
        $query = "SELECT * FROM `palceOrder_item` WHERE `place  ` = '{$this->cartId}'";
        $items = \Mage::getModel('Model\Cart\Item')->fetchAll($query);
        if(!$items){
            return false;
        }
        $this->setItems($items);
        return $items;
    }
}


?>