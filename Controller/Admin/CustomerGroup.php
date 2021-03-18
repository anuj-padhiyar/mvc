<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class CustomerGroup extends \Controller\Core\Admin{

    public function gridAction(){
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
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

    public function saveAction(){
        try{
            $group = \Mage::getModel("Model\CustomerGroup");
            $db = \Mage::getModel("Model\CustomerGroup");
            $group->setData($this->getRequest()->getPost('customerGroup'));
            if($id = $this->getRequest()->getGet('groupId')){
                $Pid = $group->getPrimaryKey();
                $group->$Pid = $id;
                $db->load($group->$Pid);
                if($db->$Pid != $group->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($group->save()){
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
            $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Grid')->toHtml();
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
        if($this->getRequest()->getGet('groupId')){
            $tabs = \Mage::getBlock('Block\Admin\CustomerGroup\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }
        $grid = \Mage::getBlock('Block\Admin\CustomerGroup\Edit')->toHtml();
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