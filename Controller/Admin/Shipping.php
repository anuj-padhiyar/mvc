<?php
namespace Controller\Admin;
\Mage::loadFileByClassName("Controller\Core\Admin");
\Mage::loadFileByClassName("Model\Core\Adapter");
\Mage::loadFileByClassName("Model\Payment");

class Shipping extends \Controller\Core\Admin
{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
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
            $shipping = \Mage::getModel("Model\Shipping");
            $db = \Mage::getModel("Model\Shipping");
            $shipping->setData($this->getRequest()->getPost('shipping'));
            if($id = $this->getRequest()->getGet('methodId')){
                $Pid = $shipping->getPrimaryKey();
                $shipping->$Pid = $id;
                $db->load($shipping->$Pid);
                if($db->$Pid != $shipping->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($shipping->save()){
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
            $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
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
            $shipping = \Mage::getModel("Model\Shipping");
            $shipping->load($id);
            if($shipping->methodId != $id){
                throw new \Exception('Id is Invalid');
            }
            if($shipping->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Grid')->toHtml();
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
            $tabs = \Mage::getBlock('Block\Admin\Shipping\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }
        $grid = \Mage::getBlock('Block\Admin\Shipping\Edit')->toHtml();
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
