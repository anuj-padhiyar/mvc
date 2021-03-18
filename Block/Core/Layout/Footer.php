<?php
namespace Block\Core\Layout;
//\Mage::loadFileByClassName("Block\Core\Layout");
//\Mage::loadFileByClassName("Block\Core\Template");

class Footer extends \Block\Core\Template{
    public function __construct(){
        $this->setTemplate('./View/core/layout/footer.php');
    }
}


?>