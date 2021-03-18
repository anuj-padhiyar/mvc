<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Attribute extends \Controller\Core\Admin{
    
    public function gridAction(){
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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
            $attribute = \Mage::getModel("Model\Attribute");
            $db = \Mage::getModel("Model\Attribute");
            $attribute->setData($this->getRequest()->getPost('attribute'));
            if($id = $this->getRequest()->getGet('attributeId')){
                $Pid = $attribute->getPrimaryKey();
                $attribute->$Pid = $id;
                $db->load($attribute->$Pid);
                if($db->$Pid != $attribute->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            
            if($attribute->save()){
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

            $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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
            $id = $this->getRequest()->getGet('attributeId');
            $attribute = \Mage::getModel("Model\Attribute");
            $attribute->load($id);
            if($id != $attribute->attributeId){
                throw new \Exception('Id is Invalid');
            }
            if($attribute->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }
            $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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

    public function editFormAction(){
        if($this->getRequest()->getGet('attributeId')){
            $tabs = \Mage::getBlock('Block\Admin\Attribute\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }
        $edit = \Mage::getBlock('Block\Admin\Attribute\Edit')->toHtml();
        $response = [
            'status' => 'success',
            'message' =>'this is edit action.',
            'element' =>[
                'selector' =>'#contentHtml',
                'html' => $edit
            ]
        ];
        header("Content-Type: application/json");
        echo json_encode($response);
    }

    public function optionsAction(){
        $attribute = \Mage::getModel('Model\Attribute');
        $id = $this->getRequest()->getGet('attributeId');
        $attribute->load($id);

        $optionBlock = \Mage::getBlock('Block\Admin\Attribute\Edit\Tabs\Option');
        $optionBlock->setAttribute( $attribute);

        $layout = $this->getLayout();
        $layout->getContent()->addChild($optionBlock);
        echo $layout->toHtml();
    }

    public function updateAction(){
        $attribute = \Mage::getModel('Model\Attribute');
        $attributeId = $this->getRequest()->getGet('attributeId');

        $query =  "SELECT `optionId` FROM `attribute_option` WHERE `attributeId`={$attributeId}";
        foreach($attribute->fetchAll($query)->getData() as $key=>$value){
            $ids[] = $value->optionId;
        }

        if($exist = $this->getRequest()->getPost('exist')){
            foreach ($exist as $key => $value) {
                unset($ids[array_search($key,$ids)]);
                $query = "UPDATE `attribute_option` 
                    SET `name`='{$value['name']}',`attributeId`={$attributeId},`sortOrder`={$value['sortOrder']} 
                    WHERE `optionId` = {$key}";
                $attribute->save($query);
            }
        }
        
        if($ids){
            $query = "DELETE FROM `attribute_option` WHERE `optionId` IN (".implode(",",$ids).")";
            $attribute->save($query);
        }

        if($new = $this->getRequest()->getPost('new')){
            foreach ($new as $key => $value) {
                foreach($value as $key2=>$value2){
                    $newArray[$key2][$key] = $value2;
                }
            }
            foreach($newArray as $key=>$value){
                $query = "INSERT INTO `attribute_option`(`name`, `attributeId`, `sortOrder`) 
                    VALUES ('{$value['name']}',{$attributeId},{$value['sortOrder']})";
                $attribute->save($query);
            }
        }
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
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
}

?>