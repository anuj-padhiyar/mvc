<?php
namespace Block\Core;
class Grid extends \Block\Core\Template{
    protected $columns = [];
    protected $actions = [];
    protected $buttons = [];
    protected $collection = [];

    public function __construct(){
        // parent::__construct();
        $this->setTemplate('./View/core/grid.php');
        $this->prepareColumn();
        $this->prepareActions();
        $this->prepareButtons();
    }
    
    public function setCollection($collection){
        $collection = \Mage::getModel($collection);
        $query = "SELECT * FROM `{$collection->getTableName()}`";
        if($this->getFilter()->hasFilters()){
            $query .= " WHERE ";
            foreach($this->getFilter()->getFilters() as $type=>$filter){
                if($type == 'text'){
                    foreach($filter as $key=>$value){
                        $query .= "{$key} LIKE '%{$value}%' && ";
                    }
                }
                if($type == 'number'){
                    foreach($filter as $key=>$value){
                        $query .= "{$key} LIKE '%{$value}%' && ";
                    }
                }
                if($type == 'tinyint'){
                    foreach($filter as $key=>$value){
                        $query .= "{$key} LIKE '%{$value}%' && ";
                    }
                }
            }
            $query = substr($query, 0, -4);
        }
        $collection =  $collection->fetchAll($query);
        if($collection){
            $this->collection = $collection->getData();
        }
        return $this;
    }
    public function getCollection(){
        return $this->collection;
    }

    public function getColumns(){
        return $this->columns;
    }
    public function addColumn($key,$value){
        $this->columns[$key] = $value;
        return $this;
    }
    public function prepareColumn(){
        return $this;
    }
    public function getFieldValue($row,$field){
        return $row->$field;
    }

    public function getActions(){
        return $this->actions;
    }
    public function addAction($key,$value){
        $this->actions[$key] = $value;
        return $this;
    }
    public function prepareActions(){
        $this->addAction('update',[
            'label'=>'Edit',
            'method'=>'getEditUrl',
            'ajax'=>true
        ]);
        $this->addAction('delete',[
            'label'=>'Delete',
            'method'=>'getDeleteUrl',
            'ajax'=>true
        ]);
        if($this->getRequest()->getGet('c') == 'product'){
            $this->addAction('addToCart',[
                'label'=>'Add To Cart',
                'method'=>'addToCartUrl',
                'ajax'=>true
            ]);
        }
    }

    public function getMethodUrl($row,$methodName){
        return $this->$methodName($row);
    }
    public function getEditUrl($row){
        $url = $this->getUrl()->getUrl('editForm',null,[$row->getPrimaryKey()=>$this->getKey($row)],true);
        return "mage.setUrl('{$url}').load()";
    }
    public function getDeleteUrl($row){
        $url = $this->getUrl()->getUrl('delete',null,[$row->getPrimaryKey()=>$this->getKey($row)],true);
        return "mage.setUrl('{$url}').load()";
    }
    public function addToCartUrl($row){
        $url = $this->getUrl()->getUrl('addItemToCart','cart',[$row->getPrimaryKey()=>$this->getKey($row)],true);
        return "mage.setUrl('{$url}').load()";
    }

    public function getKey($row){
        $key = $row->getPrimaryKey();
        return $row->$key;
    }
    public function getButtons(){
        return $this->buttons;
    }
    public function addButton($key,$value){
        $this->buttons[$key] = $value;
        return $this;
    }
    public function prepareButtons(){
        $this->addButton('add',[
            'label'=>'Add Data',
            'method'=>'getAddDataUrl',
            'ajax'=>true
        ]);
        $this->addButton('applyFilter',[
            'label'=>'Apply Filter',
            'method'=>'getFilterUrl',
            'ajax'=>true
        ]);
    }
    public function getButtonUrl($methodName){
        return $this->$methodName();
    }    
    public function getAddDataUrl(){
        $url = $this->getUrl()->getUrl('editForm',null,[],true);
        return "mage.setUrl('{$url}').load()";
    }
    public function getFilterUrl(){
        return "mage.setForm()";
    }

    public function getFormUrl($value){
        return $this->getUrl()->getUrl($value);
    }

}