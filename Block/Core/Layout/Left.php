<?php
namespace Block\Core\Layout;
\Mage::loadFileByClassName("Block\Core\Template");

class Left extends \Block\Core\Template{
    public function __construct(){
        $this->setTemplate('./View/core/layout/left.php');
    }
}


?>