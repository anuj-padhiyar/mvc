<?php
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template{
    protected $categories = [];
    protected STATIC $temp = [];
    protected STATIC $names = [];

    public function __construct(){
        $this->setTemplate('./View/admin/category/grid.php');
    }
    public static function find($arr,$obj){
        foreach($arr as $key=>$value){
            if($obj->parentId == $value->categoryId){
                if($value->parentId != null){
                    self::find($arr, $value);
                }
                array_push(self::$temp,$value->name);
            }
        }
    }
    public function setCategory($categories = null){
        if(!$categories){
            $categories = \Mage::getModel("Model\Category");
            $categories = $categories->fetchAll()->getData();
        }
        $this->categories = $categories;
        foreach($this->categories as $key=>$value){
            if($value->parentId != null){
                self::find($this->categories, $value);
            }
            array_push(self::$temp,$value->name);
            self::$names[] =  implode('=>',self::$temp);
            self::$temp = [];
        }
        $i = 0 ;
        foreach($this->categories as $key=>$value){
            $value->name = self::$names[$i++];
        }
        return $this;
    }
    public function getCategory(){
        if(!$this->categories){
            $this->setCategory();
        }
        return $this->categories;
    }
    // public function getUrl($actionName = NULL, $controllerName = NULL, $params =[], $resetParam = false){
    //     return $this->getController()->getUrl($actionName, $controllerName, $params, $resetParam);
    // }

}