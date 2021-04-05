<?php

namespace Controller\Admin;
class ConfigGroup extends \Controller\Core\Admin{
    public function gridAction(){
        $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function editFormAction(){
        $configGroup = \Mage::getModel('Model\ConfigGroup');
        $id = (int)$this->getRequest()->getGet('groupId');
        if($id){
            $configGroup = $configGroup->load($id);
            if(!$configGroup){
                throw new \Exception('No Record Found!!');
            }
        }

        $edit = \Mage::getBlock('Block\Admin\ConfigGroup\Edit');
        $left = \Mage::getBlock('Block\Admin\ConfigGroup\Edit\Tabs');
        $edit = $edit->setTab($left)->setTableRow($configGroup)->toHtml();
        $this->makeResponse($edit);
    }

    public function saveAction(){
        try{
            $configGroup = \Mage::getModel('Model\ConfigGroup');
            if($id = $this->getRequest()->getGet('groupId')){
                $configGroup = $configGroup->load($id);
                if(!$configGroup){
                    throw new \Exception("Record Not Found.");
                }
            }
            $configGroup = $configGroup->setData($this->getRequest()->getPost('configGroup'));
            if($configGroup->save()){
                $this->getMessage()->setSuccess("Successfully Update/Insert");
            }else{
                $this->getMessage()->setSuccess("Unable to Update/Insert");
            }

            $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $id = (int)$this->getRequest()->getGet('groupId');
            $configGroup = \Mage::getModel('Model\ConfigGroup')->load($id);
            if(!$configGroup){
                throw new \Exception("Invalid Id");
            }
            if($configGroup->delete()){
                $this->getMessage()->setSuccess('Delete Successfully');
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function updateAction(){
        $configGroup = \Mage::getModel('Model\ConfigGroup');
        $config = \Mage::getModel('Model\ConfigGroup\Config');
        $id = $this->getRequest()->getGet('groupId');

        $query =  "SELECT `configId` FROM `config` WHERE `groupId`={$id}";
        $data = $config->fetchAll($query);
        if($data){
            foreach($data->getData() as $key=>$value){
                $ids[] = $value->configId;
            }
        }

        if($exist = $this->getRequest()->getPost('exist')){
            foreach ($exist as $key => $value) {
                unset($ids[array_search($key,$ids)]);
                $query = "UPDATE `config` 
                    SET `title`='{$value['title']}',`code`={$value['code']},`value`='{$value['value']}'
                    WHERE `configId` = {$key}";
                $config->save($query);
            }
        }
        
        if(isset($ids) && $ids){
            $query = "DELETE FROM `config` WHERE `configId` IN (".implode(",",$ids).")";
            $config->delete($query);
        }

        if($new = $this->getRequest()->getPost('new')){
            foreach ($new as $key => $value) {
                foreach($value as $key2=>$value2){
                    $newArray[$key2][$key] = $value2;
                }
            }
            foreach($newArray as $key=>$value){
                $query = "INSERT INTO `config`(`groupId`, `title`, `code`, `value`) 
                    VALUES ($id,'{$value['title']}',{$value['code']},'{$value['value']}')";
                $config->save($query);
            }
        }
        
        $grid = \Mage::getBlock('Block\Admin\ConfigGroup\Grid')->toHtml();
        $this->makeResponse($grid);

    }
}

?>