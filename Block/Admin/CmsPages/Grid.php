<?php
namespace Block\Admin\CmsPages;
\Mage::loadFileByClassName('Block\Core\Template');
class Grid extends \Block\Core\Template{
    protected $cmsPages = [];

    public function __construct(){
        $this->setTemplate('./View/admin/cmsPages/grid.php');
    }
    public function setCmsPages($cmsPages = null){
        if(!$cmsPages){
            $cmsPages = \Mage::getModel('Model\CmsPages');
            $cmsPages = $cmsPages->fetchAll()->getData();
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

}