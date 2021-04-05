<?php

namespace Block\Core\Layout;

class Content extends \Block\Core\Template{
    public function __construct(){
        $this->setTemplate('./View/core/layout/content.php');
    }
}

?>