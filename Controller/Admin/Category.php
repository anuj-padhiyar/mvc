<?php
namespace Controller\Admin;
\Mage::loadFileByClassName("Controller\Core\Admin");

class Category extends \Controller\Core\Admin{

    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $tabs = null;
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
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function saveAction(){
        try{
            if(!$this->getRequest()->isPost()){
                throw new \Exception('Invalid Request');
            }
            $category = \Mage::getModel("Model\Category");
            $db = \Mage::getModel("Model\Category");
            $category->setData($this->getRequest()->getPost('category'));
            if($id = $this->getRequest()->getGet('categoryId')){
                $Pid = $category->getPrimaryKey();
                $category->$Pid = $id;
                $db->load($category->$Pid);
                if($db->$Pid != $category->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($category->save()){
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
            $grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
            $tabs = null;
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
            $tabs = null;
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
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

	public function editFormAction(){  
        if($this->getRequest()->getGet('categoryId')){
            $tabs = \Mage::getBlock('Block\Admin\Category\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }

        $grid = \Mage::getBlock('Block\Admin\Category\Edit')->toHtml();
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