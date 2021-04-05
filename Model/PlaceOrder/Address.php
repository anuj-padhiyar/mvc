<?php 

namespace Model\PlaceOrder;
class Address extends \Model\Core\Table{
    public function __construct(){
        parent::__construct();
        $this->setTableName("placeOrder_address");
        $this->setPrimaryKey("orderAddressId");
    }
}

?>