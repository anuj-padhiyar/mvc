<?php

namespace Controller\Admin;
class Product extends \Controller\Core\Admin
{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
    public function saveAction(){
        try{
            $product = \Mage::getModel('Model\Product');
            if($id = $this->getRequest()->getGet('productId')){
                $product = $product->load($id);
                if(!$product){
                    throw new \Exception("Record Not Found.");
                }
            }
            $product = $product->setData($this->getRequest()->getPost('product'));
            if($product->save()){
                $this->getMessage()->setSuccess("Successfully Update/Insert");
            }else{
                $this->getMessage()->setSuccess("Unable to Update/Insert");
            }

            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $id = $this->getRequest()->getGet('productId');
            $product = \Mage::getModel("Model\Product");
            $product->load($id);
            if($id != $product->productId){
                throw new \Exception('Id is Invalid');
            }
            if($product->delete()){
                $this->getMessage()->setSuccess("Delete Successfully");
            }
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function editFormAction(){
        try{
            $product = \Mage::getModel('Model\Product');
            $id = (int)$this->getrequest()->getGet('productId');
            if($id){
                $product = $product->load($id);
                if(!$product){
                    throw new \Exception('No Record Found!!');
                }
            }

            $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
            $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
            $editBlock = $editBlock->setTab($leftBlock)->setTableRow($product)->toHtml();
            $this->makeResponse($editBlock);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
   }

    public function addImageAction(){
        $media = \Mage::getModel('Model\Product');
        $media->setTableName('product_media');
        $Pid = $media->getPrimaryKey();
        $id = $this->getRequest()->getGet($Pid);

        $name = $_FILES['image']['name'];
        $extension = strtolower(substr($name, strpos($name,'.')+1));
        $type = $_FILES['image']['type'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $location = 'Upload/';

        if($extension == 'jpeg' && $type == 'image/jpeg'){
            if(move_uploaded_file($tmp_name,$location.$name)){
                $media->image = $location.$name;
                $media->label = $name;
                $media->$Pid = $id;
                $data = $media->getData();
                $query = "INSERT INTO `{$media->getTableName()}` (".implode(",", array_keys($data)) . ") VALUES ('" . implode("','", array_values($data)) . "')"; 
                $media->save($query);
            }
        }else{ echo 'File Must be Jpeg'; }

        $product = \Mage::getModel('Model\Product');
        $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($product)->toHtml();
        $this->makeResponse($editBlock);
    }

    public function removeImageAction(){
        $media = \Mage::getModel('Model\Product');
        $media->setTableName('product_media');
        $Pid = $media->getPrimaryKey();
        $id = $this->getRequest()->getGet($Pid);

        $ids = $this->getRequest()->getPost('delete');
        if($ids){
            $media->setPrimaryKey('mediaId');
            foreach($ids as $key=>$value){
                $media->load($key);
                if(unlink($media->image)){
                    $media->delete();
                }
            }
        }

        $product = \Mage::getModel('Model\Product');
        $leftBlock = \Mage::getBlock('Block\Admin\Product\Edit\Tabs');
        $editBlock = \Mage::getBlock('Block\Admin\Product\Edit');
        $editBlock = $editBlock->setTab($leftBlock)->setTableRow($product)->toHtml();
        $this->makeResponse($editBlock);
    }
    public function updateMediaAction(){
        $media = \Mage::getModel('Model\Product');
        $media->setTableName('product_media');
        $Pid = $media->getPrimaryKey();
        $id = $this->getRequest()->getGet($Pid);

        $data = $this->getRequest()->getPost();
        $radio['small'] = $data['small'];
        $radio['thumb'] = $data['thumb'];
        $radio['base'] = $data['base'];
        foreach($data['label'] as $key=>$value){
            $query = "UPDATE `{$media->getTableName()}` SET `label` = '{$data['label'][$key]}',";
            foreach($radio as $key2=>$value2){
                if($value2 == $key){
                    $query .= "`{$key2}` = 1,";
                }else{
                    $query .= "`{$key2}` = 0,";
                }
            }

            $query .= "`gallery` = ";
            if(array_key_exists('gallery',$data) && array_key_exists($key,$data['gallery'])){
                $query .= "1";
            }else{
                $query .= "0";
            }
            $query .= " WHERE `mediaId` = {$key}";
            $media->save($query);
        }

        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }
    
    public function groupPriceAction(){
        $product = \Mage::getModel('Model\Product');
        $data = $this->getRequest()->getPost();
        if(array_key_exists('old',$data['price'])){
            $old = $data['price']['old'];
            foreach($old as $key=>$value){
                $query = "UPDATE `product_group_price` 
                    SET `groupPrice`='{$value}' 
                    WHERE `productId` = '{$this->getRequest()->getGet('productId')}' && `groupId`='{$key}'";
                $product->save($query);
            }
        }
        if(array_key_exists('new',$data['price'])){
            $new = $data['price']['new'];
            foreach($new as $key=>$value){
                if(!$value){ continue; }
                $query = "INSERT INTO `product_group_price` (`productId`, `groupId`, `groupPrice`)
                    VALUES({$this->getRequest()->getGet('productId')}, {$key}, '{$value}')";
                $product->save($query);
            }
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function filterAction(){
        $this->getFilter()->setFilters($this->getRequest()->getPost('field'));
        $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
        $this->makeResponse($grid);
    }

    public function updateAttributeAction(){
        echo "<pre>";
        print_r($_POST);
    }
}

?>