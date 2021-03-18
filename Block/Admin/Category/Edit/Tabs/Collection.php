<?php

namespace Block\Admin\Category\Edit\Tabs;
\Mage::getBlock("Block\Core\Template");
class Collection extends \Block\Core\Template{
    function __construct(){   
       $this->setTemplate('./View/admin/category/edit/tabs/collection.php'); 
    }
}

?>