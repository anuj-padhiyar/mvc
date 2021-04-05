<?php
namespace Block\Admin\Product;
class Grid extends \Block\Core\Grid{
    public function __construct(){
        parent::__construct();
        $this->setCollection('Model\Product');
    }

    public function prepareColumn(){
        $this->addColumn('productId',[
            'field'=>'productId',
            'label'=>'Product Id',
            'type'=>'number'
        ]);
        // $this->addColumn('sku',[
        //     'field'=>'sku',
        //     'label'=>'Sku',
        //     'type'=>'text'
        // ]);
        $this->addColumn('name',[
            'field'=>'name',
            'label'=>'Name',
            'type'=>'text'
        ]);
        $this->addColumn('price',[
            'field'=>'price',
            'label'=>'Price',
            'type'=>'number'
        ]);
        // $this->addColumn('discount',[
        //     'field'=>'discount',
        //     'label'=>'Discount',
        //     'type'=>'number'
        // ]);
        // $this->addColumn('status',[
        //     'field'=>'status',
        //     'label'=>'Status',
        //     'type'=>'tinyint'
        // ]);
        // $this->addColumn('createdDate',[
        //     'field'=>'createdDate',
        //     'label'=>'Created Date',
        //     'type'=>'datetime'
        // ]);
        // $this->addColumn('updatedDate',[
        //     'field'=>'updatedDate',
        //     'label'=>'Updated Date',
        //     'type'=>'datetime'
        // ]);
    }

    public function getTitle(){
        return "Manage Product";
    }
}