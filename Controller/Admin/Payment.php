<?php

namespace Controller\Admin;
class Payment extends \Controller\Core\Admin{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
    public function saveAction(){
        try{
            $payment = \Mage::getModel('Model\Payment');
            if($id = $this->getRequest()->getGet('methodId')){
                $payment = $payment->load($id);
                if(!$payment){
                    throw new \Exception("Record Not Found.");
                }
            }
            $payment = $payment->setData($this->getRequest()->getPost('payment'));
            if($payment->save()){
                $this->getMessage()->setSuccess("Successfully Update/Insert");
            }else{
                $this->getMessage()->setSuccess("Unable to Update/Insert");
            }

            $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $id = (int)$this->getRequest()->getGet('methodId');
            $payment = \Mage::getModel("Model\Payment");
            $payment->load($id);
            if($payment->methodId != $id){
                throw new \Exception('Id is Invalid');
            }
            if($payment->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function editFormAction(){
        try{
            $payment = \Mage::getModel('Model\Payment');
            $id = (int)$this->getrequest()->getGet('methodId');
            if($id){
                $payment = $payment->load($id);
                if(!$payment){
                    throw new \Exception('No Record Found!!');
                }
            }

            $leftBlock = \Mage::getBlock('Block\Admin\Payment\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Payment\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($payment)->toHtml();
            $this->makeResponse($editBlock);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}

?>
