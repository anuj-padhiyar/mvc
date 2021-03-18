<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class CmsPages extends \Controller\Core\Admin{

    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
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

    public function saveAction(){
        try{
            $cmsPages = \Mage::getModel("Model\CmsPages");
            $db = \Mage::getModel("Model\CmsPages");
            $cmsPages->setData($this->getRequest()->getPost('cmsPages'));
            if($id = $this->getRequest()->getGet('pageId')){
                $Pid = $cmsPages->getPrimaryKey();
                $cmsPages->$Pid = $id;
                $db->load($cmsPages->$Pid);
                if($db->$Pid != $cmsPages->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($cmsPages->save()){
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
            $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
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
            $id = (int)$this->getRequest()->getGet('pageId');
            $cmsPages = \Mage::getModel("Model\CmsPages");
            $cmsPages->load($id);
            if($cmsPages->pageId != $id){
                throw new \Exception('Id is Invalid');
            }
            if($cmsPages->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\CmsPages\Grid')->toHtml();
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
        if($this->getRequest()->getGet('pageId')){
            $tabs = \Mage::getBlock('Block\Admin\CmsPages\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }
        $grid = \Mage::getBlock('Block\Admin\CmsPages\Edit')->toHtml();
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