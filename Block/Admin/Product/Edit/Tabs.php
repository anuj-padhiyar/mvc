<?php
namespace Block\Admin\Product\Edit;
class Tabs extends \Block\Core\Edit\Tabs{

    function __construct(){
        parent::__construct();
    }

    public function prepareTabs(){
        $this->addTab('form',['key' => 'form',
                                'label'=>'Form Information',
                                'block'=>'Block\Admin\Product\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('productId')){
            $this->addTab('media',['key' => 'media',
                                    'label'=>'Media Information',
                                    'block'=>'Block\Admin\Product\Edit\Tabs\Media']);
            $this->addTab('group price',['key' => 'price',
                                        'label'=>'Group Price Information',
                                        'block'=>'Block\Admin\Product\Edit\Tabs\GroupPrice']);
            $this->addTab('attribute',['key' => 'attribute',
                                        'label'=>'Attribute',
                                        'block'=>'Block\Admin\Product\Edit\Tabs\Attribute']);
        }
        $this->setDefaultTab('form');
        return $this;
    }
}


?>