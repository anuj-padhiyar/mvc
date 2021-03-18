<?php
namespace Model;
\Mage::loadFileByClassName("Model\Core\Table");

class Category extends \Model\Core\Table{

    const STATUS_ENABLED = 1;
    const  STATUS_DISABLED = 0;

    public function __construct(){
        parent::__construct();
        $this->setTableName("category");
        $this->setPrimaryKey("categoryId");
    }

    public function getStatusOption(){
        return [
            self::STATUS_ENABLED => "Enabled",
            self::STATUS_DISABLED => "Disabled",
        ];
    }

    public function makeChange(){
        $data = $this->fetchAll()->getData();
        $categoryId = $this->getData()[$this->getPrimaryKey()];
        $parentId = $this->getData()['parentId'];
        if(!$parentId){
            $parentId = 0;
        }
        foreach($data as $key=>$value){
            if($value->parentId == $categoryId){
                $query = "UPDATE `category` SET `parentId`={$parentId} WHERE `categoryId` = {$value->categoryId}";
                $value->saveAction2($query);
            }
        }
    }

}


?>