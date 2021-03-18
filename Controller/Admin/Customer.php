<?php
namespace Controller\Admin;
\Mage::loadFileByClassName("Controller\Core\Admin");
\Mage::loadFileByClassName("Model\Core\Adapter");
\Mage::loadFileByClassName("Model\Customer");

class Customer extends \Controller\Core\Admin
{
    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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
            $customer = \Mage::getModel("Model\Customer");
            $db = \Mage::getModel("Model\Customer");
            $customer->setData($this->getrequest()->getPost('customer'));
            if($id = $this->getRequest()->getGet('customerId')){
                $customer->updatedDate = date("Y-m-d H:i:s");
                $Pid = $customer->getPrimaryKey();
                $customer->$Pid = $id;
                $db->load($customer->$Pid);
                if($db->$Pid != $customer->$Pid){
                    throw new \Exception("Record Not Found.");
                }
            }
            if($customer->save()){
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
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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
            $id = $this->getRequest()->getGet('customerId');
            $customer = \Mage::getModel('Model\Customer');
            $customer->load($id);
            if($id != $customer->customerId){
                throw new \Exception('Id is Invalid');
            }
            $query = "DELETE FROM `customer_address` WHERE `{$customer->getPrimaryKey()}` = {$customer->customerId}";
            if($customer->delete() && $customer->delete($query)){
                $this->getMessage()->setSuccess("Delete Succcessfuly");
            }
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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
        if($this->getRequest()->getGet('customerId')){
            $tabs = \Mage::getBlock('Block\Admin\Customer\Edit\Tabs')->toHtml();
        }else{
            $tabs = null;
        }
        $grid = \Mage::getBlock('Block\Admin\Customer\Edit')->toHtml();
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

    public function addressSaveAction(){
        try{
            $customerBilling = \Mage::getModel("Model\Customer");
            $customerShipping = \Mage::getModel("Model\Customer");
            $customerBilling->setTableName('customer_address');
            $customerShipping->setTableName('customer_address');
            $customerBilling->setPrimaryKey('customerId');
            $customerShipping->setPrimaryKey('customerId');
            $customerShipping->addressType = 'Shipping';
            $customerBilling->addressType = 'Billing';

            $customer = \Mage::getModel("Model\Customer");
            $customer->setData($this->getRequest()->getPost());
           
            foreach($customer->getData() as $key=>$value){
                if(strpos($key,'shipping') !== false){
                    $key = substr($key,8);
                    $customerShipping->$key = $value;
                }else{
                    $customerBilling->$key = $value;
                }
            }
            if($id = $this->getRequest()->getGet('customerId')){
                $Pid = $customer->getPrimaryKey();
                $customerBilling->$Pid = $id;
                $customerShipping->$Pid = $id;
            }
            if($id && $customerBilling->addresssave() && $customerShipping->addresssave()){
                $this->getMessage()->setSuccess("Update Successfully");
            }else{
                throw new \Exception("Unable To Update");
            }
            $grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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
}

?>