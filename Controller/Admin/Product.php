<?php
namespace Controller\Admin;
\Mage::loadFileByClassName("Controller\Core\Admin");

class Product extends \Controller\Core\Admin
{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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
            $product = \Mage::getModel("Model\Product");
            $db = \Mage::getModel("Model\Product");
            $product->setData($this->getRequest()->getPost('product'));
            if($id = $this->getRequest()->getGet('product_Id')){
                $Pid = $product->getPrimaryKey();
                $product->$Pid = $id;
                $db->load($product->$Pid);
                if($db->$Pid != $product->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($product->save()){
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
            $grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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
        if($this->getRequest()->getGet('productId')){
            $tabs = \Mage::getBlock('Block\Admin\Product\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }
        $grid = \Mage::getBlock('Block\Admin\Product\Edit')->toHtml();
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

    public function addImage(){
        echo "right";
        die;
    }

    public function mediaAction(){
        $media = \Mage::getModel('Model\Product');
        $media->setTableName('product_media');
        $Pid = $media->getPrimaryKey();
        $id = $this->getRequest()->getGet($Pid);
        echo "<pre>";
        print_r($_POST);
        print_r($_FILES);
        die();
        
        if($this->getRequest()->getPost('image')){
            echo "hi";
            die();
            $name = $_FILES['imagefile']['name'];
            $extension = strtolower(substr($name, strpos($name,'.')+1));
            $type = $_FILES['imagefile']['type'];
            $tmp_name = $_FILES['imagefile']['tmp_name'];
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
            $block = \Mage::getBlock('Block\Admin\Product\Edit')->toHtml();
            $response = [
                'status' => 'success',
                'message' =>'this is grid action.',
                'element' =>[
                    'selector' =>'#contentHtml',
                    'html' =>$block
                ]
            ];
            header("Content-Type: application/json");
            echo json_encode($response);
            // header("location:".$this->getUrl('editForm'));
        }
        
        if($this->getRequest()->getPost('remove')){
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
            //header("location:".$this->getUrl('editForm'));
        }

        if($this->getRequest()->getPost('update')){
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
            $this->redirect('grid','product');
        }
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