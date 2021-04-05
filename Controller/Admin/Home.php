<?php

namespace Controller\Admin;
class Home extends \Controller\Core\Admin{
    public function pageAction(){
        $pager = \Mage::getController('Controller\Core\Pager');
        
        $query = "SELECT * FROM `product`";
        $product = \Mage::getModel('Model\Product');
        $productCount = $product->getAdapter()->fetchOne($query);

        // $pager->setTotalRecords($productCount);
        $pager->setTotalRecords(1000);
        $pager->setRecordsPerPages(24);
        $pager->setCurrentPage($_GET['p']);
        $pager->calculate();
        echo "<pre>";
        print_r($pager);

        
    }
}



?>