<?php
namespace Block\Admin\Category;
\Mage::loadFileByClassName('Block\Core\Template');
class Edit extends \Block\Core\Template{
    protected $category = null;
    protected $controller = null;

    public function __construct(){
       $this->setTemplate('./View/admin/category/edit.php'); 
    }
    
    public function setCategory($category = NULL){
        if($category != NULL){
            $category = \Mage::getModel('Model\Category');
            if($id = $this->getController()->getRequest()->getGet('categoryId')){
                $category = $category->load($id);
            }
            $this->category = $category;
            return $this;
        }
    }
    public function getCategory(){
        if(!$this->category){
            $this->setCategory();
        }
        return $this->category;
    }

    public function getTabContent(){
        $tabBlock = \Mage::getBlock('Block\Admin\Category\Edit\Tabs');
        $tabs = $tabBlock->getTabs();
        $tab = $this->getRequest()->getGet('tab',$tabBlock->getDefaultTab());
        if(!array_key_exists($tab, $tabs)){
            return null;
        }
        $blockClassName = $tabs[$tab]['block'];
        $block = \Mage::getBlock($blockClassName);
        echo $block->toHtml();
    }

    // public function getFormUrl(){
    //     return $this->getUrl()->getUrl('save',null,['id'=>$category->categoryId]);
    // }
    // public function getTitle(){
    //     return 'Category Add/Edit';
    // }

}
?>