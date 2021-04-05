<?php
namespace Controller\Admin;
class Admin extends \Controller\Core\Admin
{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function saveAction(){
        try{
            $admin = \Mage::getModel('Model\Admin');
            if($id = $this->getRequest()->getGet('adminId')){
                $admin = $admin->load($id);
                if(!$admin){
                    throw new \Exception("Record Not Found.");
                }
            }
            $admin = $admin->setData($this->getRequest()->getPost('admin'));
            if($admin->save()){
                $this->getMessage()->setSuccess("Successfully Update/Insert");
            }else{
                $this->getMessage()->setSuccess("Unable to Update/Insert");
            }

            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }
    
    public function deleteAction(){
        try{
            $id = (int)$this->getRequest()->getGet('adminId');
            $admin = \Mage::getModel("Model\Admin");
            $admin->load($id);
            if($admin->adminId != $id){
                throw new \Exception('Id is Invalid');
            }
            if($admin->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function editFormAction(){
        try{
            $admin = \Mage::getModel('Model\Admin');
            $id = (int)$this->getrequest()->getGet('adminId');
            if($id){
                $admin = $admin->load($id);
                if(!$admin){
                    throw new \Exception('No Record Found!!');
                }
            }

            $leftBlock = \Mage::getBlock('Block\Admin\Admin\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Admin\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($admin)->toHtml();
            $this->makeResponse($editBlock);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}

?>
