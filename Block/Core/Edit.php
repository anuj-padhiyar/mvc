<?php
namespace Block\Core;
class Edit extends Template{
    protected $tab = null;
    protected $tableRow = null;

    public function __construct(){
        parent::__construct();
        $this->setTemplate('./View/core/edit.php');
    }

    public function getTabContent(){
        $tabBlock = $this->getTab();
        $tabs = $tabBlock->getTabs();

        $key = $this->getRequest()->getGet('tab',$tabBlock->getDefaultTab());
        if(!array_key_exists($key, $tabs)){
            return false;
        }

        $blockClassName = $tabs[$key]['block'];
        $block = \Mage::getBlock($blockClassName);
        $this->setTableRow($this->getTableRow());
        return $block->toHtml();
    }

    public function setTab($tab = null){
        $this->tab = $tab;
        return $this;
    }
    public function getTab(){
        if(!$this->tab){
            $this->setTab();
        }
        return $this->tab;
    }

    public function setTableRow(\Model\Core\Table $tableRow){
        $this->tableRow = $tableRow;
        return $this;
    }
    public function getTableRow(){
        return $this->tableRow;
    }
    
    public function getTabHtml(){
        return $this->getTab()->toHtml();
    } 
}

?>