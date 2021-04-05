<?php
namespace Block\Admin\Customer\Edit;
class Tabs extends \Block\Core\Edit\Tabs{

    function __construct(){
        parent::__construct();
    }

    public function prepareTabs(){
        $this->addTab('form',['key' => 'form',
                                'label'=>'Form Information',
                                'block'=>'Block\Admin\Customer\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('customerId')){
            $this->addTab('address',['key' => 'address',
                                    'label'=>'Customer Address',
                                    'block'=>'Block\Admin\Customer\Edit\Tabs\Address']);
        }
        $this->setDefaultTab('form');
        return $this;
    }
}


?>