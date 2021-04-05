<?php 

namespace Model\PlaceOrder;
class Item extends \Model\Core\Table{
    public function __construct(){
        parent::__construct();
        $this->setTableName("placeOrder_item");
        $this->setPrimaryKey("orderItemId");
    }
}


?>