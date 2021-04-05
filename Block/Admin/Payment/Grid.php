<?php
namespace Block\Admin\Payment;
class Grid extends \Block\Core\Grid{
    
    public function __construct(){
        parent::__construct();
        $this->setCollection('Model\Payment');
    }

    public function prepareColumn(){
        $this->addColumn('methodId',[
            'field'=>'methodId',
            'label'=>'Method Id',
            'type'=>'int'
        ]);
        $this->addColumn('name',[
            'field'=>'name',
            'label'=>'Name',
            'type'=>'text'
        ]);
        $this->addColumn('description',[
            'field'=>'description',
            'label'=>'Description',
            'type'=>'text'
        ]);
        $this->addColumn('status',[
            'field'=>'status',
            'label'=>'Status',
            'type'=>'tinyint'
        ]);
        $this->addColumn('createdDate',[
            'field'=>'createdDate',
            'label'=>'Created Date',
            'type'=>'datetime'
        ]);
    }

    public function getTitle(){
        return "Manage Payment";
    }
}