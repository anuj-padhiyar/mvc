<?php
namespace Block\Admin\Product\Edit;
\Mage::loadFileByClassName('Block\Core\Template');
class Tabs extends \Block\Core\Template{
    protected $tabs = [];
    protected $defaultTab = null;

    function __construct(){
        $this->setTemplate('View/admin/product/edit/tabs.php');
        $this->preparetab();
    }

    public function prepareTab(){
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
        }
        $this->setDefaultTab('form');
        return $this;
    }
    public function setDefaultTab($defaultTab){
        $this->defaultTab = $defaultTab;
        return $this;
    }
    public function getDefaultTab(){
        if(!$this->defaultTab){
            $this->setDefaultTab();
        }
        return $this->defaultTab;
    }
    public function setTabs(array $tabs= []){
        $this->tabs = $tabs;
        return $this;
    }
    public function getTabs(){
        return $this->tabs;
    }
    public function addTab($key, $tab = []){
        $this->tabs[$key] = $tab;
        return $this;
    }
    public function getTab($key){
        if(!array_key_exists($key, $this->tabs)){
            return null;
        }
        return $this->tabs[$key];
    }
    public function removeTab($key){
        if(array_key_exists($key, $this->tabs)){
            unset($tabs[$key]);
        }
    }
}


?>