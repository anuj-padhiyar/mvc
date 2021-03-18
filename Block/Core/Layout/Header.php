<?php
namespace Block\Core\Layout;
//\Mage::loadFileByClassName("Block\Core\Layout");
// \Mage::loadFileByClassName("Block\Core\Template");

class Header extends \Block\Core\Template{
    public function __construct(){
        $this->setTemplate('./View/core/layout/header.php');
    }
}


?>