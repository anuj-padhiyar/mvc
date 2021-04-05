<?php

namespace Controller\Admin;
class CustomerGroup extends \Controller\Core\Admin{

    public function gridAction(){
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function saveAction(){
        try{
            $customerGroup = \Mage::getModel('Model\CustomerGroup');
            if($id = $this->getRequest()->getGet('customerGroupId')){
                $customerGroup = $customerGroup->load($id);
                if(!$customerGroup){
                    throw new \Exception("Record Not Found.");
                }
            }
            $customerGroup = $customerGroup->setData($this->getRequest()->getPost('customerGroup'));
            if($customerGroup->save()){
                $this->getMessage()->setSuccess("Successfully Update/Insert");
            }else{
                $this->getMessage()->setSuccess("Unable to Update/Insert");
            }

            $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $id = (int)$this->getRequest()->getGet('groupId');
            $group = \Mage::getModel('Model\CustomerGroup');
            $group->load($id);
            if($group->groupId != $id){
                throw new \Exception('Id is Invalid!');
            }
            if($group->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function editFormAction(){
        try{
            $group = \Mage::getModel('Model\CustomerGroup');
            $id = (int)$this->getrequest()->getGet('categoryId');
            if($id){
                $group = $group->load($id);
                if(!$group){
                    throw new \Exception('No Record Found!!');
                }
            }

            $leftBlock = \Mage::getBlock('Block\Admin\CustomerGroup\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\CustomerGroup\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($group)->toHtml();
            $this->makeResponse($editBlock);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}



?>