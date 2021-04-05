<?php

namespace Block\Admin\ConfigGroup;
class Grid extends \Block\Core\Grid{
    public function __construct(){
        parent::__construct();
        $this->setCollection('Model\ConfigGroup');
    }

    public function prepareColumn(){
        $this->addColumn('groupId',[
            'field'=>'groupId',
            'label'=>'Group Id',
            'type'=>'number'
        ]);
        $this->addColumn('name',[
            'field'=>'name',
            'label'=>'Name',
            'type'=>'text'
        ]);
        $this->addColumn('createdDate',[
            'field'=>'createdDate',
            'label'=>'Created Date',
            'type'=>'text'
        ]);
    }

    public function getTitle(){
        return "Manage Config Group";
    }
}

?>