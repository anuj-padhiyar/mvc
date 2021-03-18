<?php
namespace Controller\Admin;
\Mage::loadFileByClassName("Controller\Core\Admin");
\Mage::loadFileByClassName("Model\Core\Adapter");
\Mage::loadFileByClassName("Model\Payment");

class Payment extends \Controller\Core\Admin{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
            $response = [
                'status' => 'success',
                'message' =>'this is grid action.',
                'element' =>[
                    'selector' =>'#contentHtml',
                    'html' =>$grid
                ]
            ];
            header("Content-Type: application/json");
            echo json_encode($response);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
    public function saveAction(){
        try{
            $payment = \Mage::getModel("Model\Payment");
            $db = \Mage::getModel("Model\Payment");
            $payment->setData($this->getRequest()->getPost('payment'));
            if($id = $this->getRequest()->getGet('methodId')){
                $Pid = $payment->getPrimaryKey();
                $payment->$Pid = $id;
                $db->load($payment->$Pid);
                if($db->$Pid != $payment->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($payment->save()){
                if($db->getData()){
                    $this->getMessage()->setSuccess("Update Successfully");
                }else{
                    $this->getMessage()->setSuccess("Insert Successfully");
                }    
            }else{
                if($db->getData()){
                    throw new \Exception("Unable To Update");
                }else{
                    throw new \Exception("Unable To Insert");
                }  
            } 
            $grid = \Mage::getBlock('Block\Admin\Payment\Grid')->toHtml();
            $response = [
                'status' => 'success',
                'message' =>'this is grid action.',
                'element' =>[
                    'selector' =>'#contentHtml',
                    'html' =>$grid
                ]
            ];
            header("Content-Type: application/json");
            echo json_encode($response);
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
        $response = [
            'status' => 'success',
            'message' =>'this is grid action.',
            'element' =>[
                'selector' =>'#contentHtml',
                'html' =>$grid
            ]
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
    }

    public function editFormAction(){
        if($this->getRequest()->getGet('methodId')){
            $tabs = \Mage::getBlock('Block\Admin\Payment\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }
        $grid = \Mage::getBlock('Block\Admin\Payment\Edit')->toHtml();
        $response = [
            'status' => 'success',
            'message' =>'this is edit action.',
            'element' =>[
                [
                    'selector' =>'#leftHtml',
                    'html' =>$tabs
                ],
                [
                    'selector' =>'#contentHtml',
                    'html' => $grid
                ]
            ]
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
    }

}

?>
