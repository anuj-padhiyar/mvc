<?php
namespace Block\Admin\CmsPages;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $cmsPages = null;

    function __construct(){   
        $this->setTemplate('./View/admin/cmsPages/edit.php'); 
     }
    public function setCmsPages($cmsPages = NULL){
        if(!$cmsPages){
            $cmsPages = \Mage::getModel('Model\CmsPages');
            if($id = $this->getController()->getRequest()->getGet('pageId')){
                $cmsPages = $cmsPages->load($id);
            }
        }
        $this->cmsPages = $cmsPages;
        return $this;
    }
    public function getCmsPages(){
        if(!$this->cmsPages){
            $this->setCmsPages();
        }
        return $this->cmsPages;
    }
    
    public function getTabContent(){
        $tabBlock = \Mage::getBlock('Block\Admin\CmsPages\Edit\Tabs');
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab',$tabBlock->getDefaultTab());
        if(!array_key_exists($tab, $tabs)){
            return null;
        }
        $blockClassName = $tabs[$tab]['block'];
        $block = \Mage::getBlock($blockClassName);
        echo $block->toHtml();
    }
}
?>