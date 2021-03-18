<?php
namespace Block\Core;
\Mage::loadFileByClassName("Block\Core\Template");
\Mage::loadFileByClassName("Block\Core\Layout\Left");
\Mage::loadFileByClassName("Block\Core\Layout\Right");
\Mage::loadFileByClassName("Block\Core\Layout\Header");
\Mage::loadFileByClassName("Block\Core\Layout\Footer");
\Mage::loadFileByClassName("Block\Core\Layout\Content");

class Layout extends Template{
	public function __construct(){
        $this->setTemplate('./View/core/layout/one_column.php');
    	$this->prepareChildren();
	}

    public function prepareChildren(){
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Header'),'header');
	    $this->addChild(\Mage::getBlock('Block\Core\Layout\Content'),'content');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Left'),'left');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Right'),'right');
        $this->addChild(\Mage::getBlock('Block\Core\Layout\Footer'),'footer');
    }

    public function getHeader(){
        return $this->getChild('header');
    }
    public function getContent(){
        return $this->getChild('content');
    }
    public function getLeft(){
        return $this->getChild('left');
    }
    public function getRight(){
        return $this->getChild('right');
    }
    public function getFooter(){
        return $this->getChild('footer');
    }
}

?>