<?php

namespace Block\Core\Layout;
// \Mage::loadFileByClassName('Controller\Core\Admin');
\Mage::loadFileByClassName('Block\Core\Template');

class Message extends \Block\Core\Template{
    public function __construct() {
        $this->setTemplate('./View/core/layout/message.php');
    }
}

?>