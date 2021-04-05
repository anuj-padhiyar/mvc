<?php
namespace Block\Admin\Customer;
class Grid extends \Block\Core\Grid{

    public function __construct(){
        parent::__construct();
        $this->setCollection('Model\Customer');
    }

    public function setCollection($collection){
        $collection = \Mage::getModel($collection);
        $query = "SELECT c.`customerId`,
            c.`firstName`, 
            c.`lastName`,
            c.`email`, 
            c.`password`,
            c.`status`,
            a.`address`,
            a.`city`,
            a.`state`,
            a.`zipcode`,
            a.`country`
        FROM `customer` as c
        LEFT JOIN `customer_address` as a
        ON c.`customerId` = a.`customerId`
        AND a.`addressType` = 'shipping'";
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


    public function prepareColumn(){
        $this->addColumn('customerId',[
            'field'=>'customerId',
            'label'=>'Customer Id',
            'type'=>'number'
        ]);
        $this->addColumn('firstName',[
            'field'=>'firstName',
            'label'=>'First Name',
            'type'=>'text'
        ]);
        $this->addColumn('lastName',[
            'field'=>'lastName',
            'label'=>'Last Name',
            'type'=>'text'
        ]);
        $this->addColumn('email',[
            'field'=>'email',
            'label'=>'Email',
            'type'=>'text'
        ]);
        $this->addColumn('password',[
            'field'=>'password',
            'label'=>'Password',
            'type'=>'text'
        ]);
        $this->addColumn('status',[
            'field'=>'status',
            'label'=>'Status',
            'type'=>'tinyint'
        ]);
        $this->addColumn('address',[
            'field'=>'address',
            'label'=>'Address',
            'type'=>'text'
        ]);
        $this->addColumn('city',[
            'field'=>'city',
            'label'=>'City',
            'type'=>'text'
        ]);
        $this->addColumn('state',[
            'field'=>'state',
            'label'=>'State',
            'type'=>'text'
        ]);
        $this->addColumn('zipcode',[
            'field'=>'zipcode',
            'label'=>'Zipcode',
            'type'=>'text'
        ]);
        $this->addColumn('country',[
            'field'=>'country',
            'label'=>'Country',
            'type'=>'text'
        ]);
    }

    public function getTitle(){
        return "Manage Customer";
    }

}