<?php
namespace Block\Admin\Attribute\Edit;

class Tabs extends \Block\Core\Edit\Tabs{

    

    public function prepareTabs(){
        $this->addTab('form',['key' => 'form',
                                'label'=>'Form Information',
                                'block'=>'Block\Admin\Attribute\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('attributeId')){
            $this->addTab('option',['key' => 'option',
                                    'label'=>'Option Information',
                                    'block'=>'Block\Admin\Attribute\Edit\Tabs\Option']);
        }
        $this->setDefaultTab('form');
        return $this;
    }
}


?>