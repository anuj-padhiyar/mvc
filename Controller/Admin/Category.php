<?php

namespace Controller\Admin;
class Category extends \Controller\Core\Admin{

    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception('Invalid Request');
            }
            $category = \Mage::getModel('Model\Category');
            if($id = $this->getRequest()->getGet('categoryId')){
                $category = $category->load($id);
                if(!$category){
                    throw new \Exception("Record Not Found.");
                }
            }
            $category = $category->setData($this->getRequest()->getPost('category'));
            if($category->save()){
                $this->getMessage()->setSuccess("Successfully Update/Insert");
            }else{
                $this->getMessage()->setSuccess("Unable to Update/Insert");
            }

            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $id = (int)$this->getRequest()->getGet('categoryId');
            $category = \Mage::getModel("Model\Category");
            $category->load($id);
            if($id != $category->categoryId){
                throw new \Exception('Id is Invalid');
            }
            $category->makeChange();
            if($category->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }

            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

	public function editFormAction(){
        try{
            $category = \Mage::getModel('Model\Category');
            $id = (int)$this->getrequest()->getGet('categoryId');
            if($id){
                $category = $category->load($id);
                if(!$category){
                    throw new \Exception('No Record Found!!');
                }
            }

            $leftBlock = \Mage::getBlock('Block\Admin\Category\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Category\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($category)->toHtml();
            $this->makeResponse($editBlock);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}

?>