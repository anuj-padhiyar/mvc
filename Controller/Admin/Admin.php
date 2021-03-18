<?php
namespace Controller\Admin;
\Mage::loadFileByClassName("Controller\Core\Admin");

class Admin extends \Controller\Core\Admin
{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
            $admin = \Mage::getModel("Model\Admin");
            $db = \Mage::getModel("Model\Admin");
            $admin->setData($this->getRequest()->getPost('admin'));
            if($id = $this->getRequest()->getGet('adminId')){
                $Pid = $admin->getPrimaryKey();
                $admin->$Pid = $id;
                $db->load($admin->$Pid);
                if($db->$Pid != $admin->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($admin->save()){
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
            $grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
            $response = [
                'status' => 'success',
                'message' =>'Delete Successfully',
                'element' =>[
                    'selector' =>'#contentHtml',
                    'html' =>$grid
                ]
            ];
            header("Content-Type: application/json");
            echo json_encode($response);
    }

    public function editFormAction(){
        try{
            $admin = \Mage::getModel('Model\Admin');

            $id = (int)$this->getrequest()->getGet('id');
            if($id){
                $admin = $admin->load($id);
                if(!$admin){
                    throw new \Exception('No Record Found!!');
                }
            }

            $leftBlock = \Mage::getBlock('Block\Admin\Admin\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Admin\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($admin)->toHtml();
            
            $response = [
                'status' => 'success',
                'message' =>'this is edit action.',
                'element' =>[
                        'selector' =>'#contentHtml',
                        'html' => $editBlock
                ]
            ];
            header("Content-Type: application/json");
            echo json_encode($response);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
   }

}

?>
