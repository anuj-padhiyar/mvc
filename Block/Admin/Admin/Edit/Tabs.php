<?php
namespace Block\Admin\Admin\Edit;

class Tabs extends \Block\Core\Edit\Tabs{

    public function __construct(){
        parent::__construct();
    }

    public function prepareTabs(){
        $this->addTab('form',['key' => 'form',
                                'label'=>'Form Information',
                                'block'=>'Block\Admin\Admin\Edit\Tabs\Form']);  
        $this->setDefaultTab('form');
        return $this;
    }
}

?>