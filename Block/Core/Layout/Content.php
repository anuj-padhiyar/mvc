<?php
namespace Block\Core\Layout;
//\Mage::loadFileByClassName("Block\Core\Layout");
//\Mage::loadFileByClassName("Block\Core\Template");

class Content extends \Block\Core\Template{
    public function __construct(){
        $this->setTemplate('./View/core/layout/content.php');
    }
}


?>