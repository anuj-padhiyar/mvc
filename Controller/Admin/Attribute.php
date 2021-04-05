<?php

namespace Controller\Admin;
class Attribute extends \Controller\Core\Admin{
    
    public function gridAction(){
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function saveAction(){
        try{
            $attribute = \Mage::getModel('Model\Attribute');
            if($id = $this->getRequest()->getGet('attributeId')){
                $attribute = $attribute->load($id);
                if(!$attribute){
                    throw new \Exception("Record Not Found.");
                }
            }
            $attribute = $attribute->setData($this->getRequest()->getPost('attribute'));
            if($attribute->save()){
                $this->getMessage()->setSuccess("Successfully Update/Insert");
            }else{
                $this->getMessage()->setSuccess("Unable to Update/Insert");
            }

            $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
            $this->makeResponse($grid);
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
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function editFormAction(){
        $attribute = \Mage::getModel('Model\Attribute');
        $id = (int)$this->getrequest()->getGet('attributeId');
        if($id){
            $attribute = $attribute->load($id);
            if(!$attribute){
                throw new \Exception('No Record Found!!');
            }
        }

        $leftBlock = \Mage::getBlock('Block\Admin\Attribute\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Attribute\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($attribute)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function optionsAction(){
        $attribute = \Mage::getModel('Model\Attribute');
        $id = $this->getRequest()->getGet('attributeId');
        $attribute->load($id);

        $optionBlock = \Mage::getBlock('Block\Admin\Attribute\Edit\Tabs\Option');
        $optionBlock->setAttribute($attribute);

        $layout = $this->getLayout();
        $layout->getContent()->addChild($optionBlock);
        echo $layout->toHtml();
    }

    public function updateAction(){
        $attribute = \Mage::getModel('Model\Attribute');
        $attributeId = $this->getRequest()->getGet('attributeId');

        $query =  "SELECT `optionId` FROM `attribute_option` WHERE `attributeId`={$attributeId}";
        $data = $attribute->fetchAll($query);
        if($data){
            foreach($data->getData() as $key=>$value){
                $ids[] = $value->optionId;
            }
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
        
        if(isset($ids) && $ids){
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
        $this->makeResponse($grid);
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\Attribute\Grid')->toHtml();
        $this->makeResponse($grid);
    }
}

?>