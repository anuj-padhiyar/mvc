<?php
namespace Block\Admin\CmsPages;
class Grid extends \Block\Core\Grid{
    public function __construct(){
        parent::__construct();
        $this->setCollection('Model\CmsPages');
    }

    public function prepareColumn(){
        $this->addColumn('pageId',[
            'field'=>'pageId',
            'label'=>'Page Id',
            'type'=>'number'
        ]);
        $this->addColumn('title',[
            'field'=>'title',
            'label'=>'Title',
            'type'=>'text'
        ]);
        $this->addColumn('identifier',[
            'field'=>'identifier',
            'label'=>'Identifier',
            'type'=>'number'
        ]);
        $this->addColumn('content',[
            'field'=>'content',
            'label'=>'Content',
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
        return "Manage Cms Pages";
    }
}