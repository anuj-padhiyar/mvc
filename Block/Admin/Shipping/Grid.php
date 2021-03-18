<?php
namespace Block\Admin\Shipping;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template{
    protected $shippings = [];

    public function __construct(){
        $this->setTemplate('./View/admin/shipping/grid.php');
    }
    public function setShipping($shippings = null){
        if(!$shippings){
            $shippings = \Mage::getModel('Model\Shipping');
            $shippings = $shippings->fetchAll()->getData();
        }
        $this->shippings = $shippings;
        return $this;
    }
    public function getShipping(){
        if(!$this->shippings){
            $this->setShipping();
        }
        return $this->shippings;
    }

}