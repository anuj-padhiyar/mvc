<?php
namespace Block\Admin\Category\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template{

    protected $category = null;
    protected $categories = [];
    protected STATIC $var2 = [];
    protected STATIC $temp = [];

    public function __construct(){
        $this->setTemplate('./View/admin/category/edit/tabs/form.php');
    }
    public static function find($arr,$var){
        foreach($arr as $key=>$value){
            if($var->parentId == $value->categoryId){
                if($value->parentId != null){
                    self::find($arr, $value);
                }
                array_push(self::$var2,$value->name);
            }
        }
    }
    public static function childRemove($category,$arr){
        if($category->getData()['categoryId']){
            $name = $category->getData()['name'];
                foreach($arr as $key=>$value){
                    if($name && strpos($value,$name) !== false){
                        return false;
                    }
            }
            return true;
        }
    }
    public function setCategory($category = NULL){
        if ($category){
            $this->category = $category;
            return $this;
        }
        $category = \Mage::getModel('Model\Category');
        if ($id = $this->getRequest()->getGet('categoryId')){ 
            $category = $category->load($id);
        }
        $this->category = $category;

        $categories = \Mage::getModel("Model\Category");
        $categories = $categories->fetchAll()->getData();
        $this->categories =$categories;

        foreach($this->categories as $key=>$value){
            if($value->parentId != null){
                self::find($this->categories, $value);
            }
            array_push(self::$var2,$value->name);
            if($id){
                if(self::childRemove($this->category,self::$var2)){
                    self::$temp[$value->categoryId] =  implode('=>',self::$var2);
                }
            }else{
                self::$temp[$value->categoryId] =  implode('=>',self::$var2);
            }
            self::$var2 = [];
        }
        return $this;
    }
    public function getCategory(){
        if (!$this->category){
            $this->setCategory();
        }
        return $this->category;
    }
    public function getTemp(){
        return self::$temp;
    }
    
}
?>