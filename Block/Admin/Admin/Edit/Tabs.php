<?php
namespace Block\Admin\Admin\Edit;
\Mage::loadFileByClassName('Block\Core\Template');
class Tabs extends \Block\Core\Template{
    protected $tabs = [];
    protected $defaultTab = null;

    function __construct(){
        $this->setTemplate('View/admin/admin/edit/tabs.php');
        $this->preparetab();
    }

    public function prepareTab(){
        $this->addTab('form',['key' => 'form',
                                'label'=>'Form Information',
                                'block'=>'Block\Admin\Admin\Edit\Tabs\Form']);
        if($this->getRequest()->getGet('adminId')){
            $this->addTab('option',['key' => 'option',
                                    'label'=>'Option Information',
                                    'block'=>'Block\Admin\Admin\Edit\Tabs\Option']);
        }
        $this->setDefaultTab('form');
        return $this;
    }
}


?>