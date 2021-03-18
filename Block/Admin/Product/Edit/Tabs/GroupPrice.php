<?php
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class GroupPrice extends \Block\Core\Template{
    protected $groupPrice = [];

    public function __construct(){
        $this->setTemplate('./View/admin/product/edit/tabs/groupPrice.php');
    }

    public function setGroupPrice($groupPrice = null){
        if(!$groupPrice){
            $product = \Mage::getModel('Model\Product');
            if($id = $this->getRequest()->getGet('productId')){
                $query = " SELECT cg.`groupId` , cg.`name` AS `groupName`, pgp.`groupPriceId` , pgp.`groupPrice`
                    FROM `customer_group` AS `cg` 
                    LEFT JOIN `product_group_price` AS `pgp` 
                        ON cg.`groupId` = pgp.`groupId` 
                        AND pgp.`productId` = {$id}
                    LEFT JOIN `product` AS `p` 
                        ON pgp.`productId` = p.`productId`";
                $groupPrice = $product->fetchAll($query)->getData();
            }
        }
        $this->groupPrice = $groupPrice;
        return $this;
    }

    public function getGroupPrice(){
        if(!$this->groupPrice){
            $this->setGroupPrice();
        }
        return $this->groupPrice;
    }

}


?>