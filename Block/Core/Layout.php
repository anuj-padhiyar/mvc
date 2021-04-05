<?php
namespace Block\Core;
class Layout extends Template{
	public function __construct(){
        $this->setTemplate('./View/core/layout/one_column.php');
    	$this->prepareChildren();
	}

    public function prepareChildren(){
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Header'),'header');
	    $this->addChild(\Mage::getBlock('Block\Core\Layout\Content'),'content');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Footer'),'footer');
    }

    public function getHeader(){
        return $this->getChild('header');
    }
    public function getContent(){
        return $this->getChild('content');
    }
    public function getFooter(){
        return $this->getChild('footer');
    }
}

?>