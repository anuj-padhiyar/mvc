<?php
namespace Block\Admin\Category;
class Grid extends \Block\Core\Grid{
    protected STATIC $temp = [];
    protected STATIC $names = [];
    
    public function __construct(){
        parent::__construct();
        $this->setCollection('Model\Category');
        $this->setValue();
    }

    public function prepareColumn(){
        $this->addColumn('categoryId',[
            'field'=>'categoryId',
            'label'=>'Category Id',
            'type'=>'number'
        ]);
        $this->addColumn('parentId',[
            'field'=>'parentId',
            'label'=>'Parent Id',
            'type'=>'number'
        ]);
        $this->addColumn('name',[
            'field'=>'name',
            'label'=>'Name',
            'type'=>'text'
        ]);
        $this->addColumn('status',[
            'field'=>'status',
            'label'=>'Status',
            'type'=>'tinyint'
        ]);
        $this->addColumn('description',[
            'field'=>'description',
            'label'=>'Description',
            'type'=>'text'
        ]);
    }

    public function getTitle(){
        return "Manage Category";
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
    public function setValue(){
        if($this->collection){
            foreach($this->collection as $key=>$value){
                if($value->parentId != null){
                    self::find($this->collection, $value);
                }
                array_push(self::$temp,$value->name);
                self::$names[] =  implode('=>',self::$temp);
                self::$temp = [];
            }
            $i = 0 ;
            foreach($this->collection as $key=>$value){
                $value->name = self::$names[$i++];
            }
        }
    }
}


?>