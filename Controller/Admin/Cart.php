<?php

namespace Controller\Admin;
class Cart extends \Controller\Core\Admin{

    public function addItemToCartAction(){
        try{
            if($customerId = $this->getRequest()->getGet('customerId')){
                $cart = $this->getCart($customerId);
            }else{
                $cart = $this->getCart();
            }
            if($productId = (int)$this->getRequest()->getGet('productId')){
                $product = \Mage::getModel('Model\Product')->load($productId);
                if(!$product){
                    throw new \Exception("Product is not valid");
                }
                $cart = $cart->addItemToCart($product,1,true);
                if(!$cart){
                    $this->redirect('grid','cart');
                }
            }
            $this->redirect('grid','cart',[],true);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    protected function getCart($customerId = null){
        try{
            $session = \Mage::getModel('Model\Admin\Session');
            $cart = \Mage::getModel('Model\Cart');
            if(!$customerId && !$session->customerId){
                return $cart;
            }
            if($customerId){   
                $session->customerId = $customerId;
            }
            
            $query = "SELECT * FROM `cart` WHERE `customerId` = '{$session->customerId}'";
            $cart = $cart->fetchRow($query);
            if($cart){
                return $cart;
            }
            $cart = \Mage::getModel('Model\Cart');
            $cart->customerId = $customerId;
            $cart->createdDate = date("Y-m-d H:i:s");
            $cart->save();

            return $cart;
        }catch (\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function gridAction(){
        try{
            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout();
            $layout->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        }catch (\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deleteAction(){
        try{
            $id = $this->getRequest()->getGet('cartItemId');
            $cartItem = \Mage::getModel("Model\Cart\Item")->load($id);
            $cartItem->delete();

            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout();
            $layout->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid); 
        }catch (\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function updateAction(){
        try{
            $quantities = $this->getRequest()->getPost('quantity');
            $cartItem = \Mage::getModel('Model\Cart\Item');
    
            foreach($quantities as $cartItemId=>$quantity){
                $cartItem = $cartItem->load($cartItemId);
                if(!$cartItem){
                    throw new \Exception('Item With This Cart Is Not Found');
                }
                $cartItem->quantity = $quantity;
                $cartItem->price = $cartItem->getRowTotal();
                $cartItem->save();
            }
    
            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout();
            $layout->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function deliveryAction(){
        try{
            $cart = \Mage::getModel('Model\Cart');
            $option = $this->getRequest()->getPost('delivery');
            if($option){
                foreach($option as $key=>$value){
                    $cart = $cart->load($key);
                    $cart->shippingMethodId = $value;
                    $cart->shippingAmount = $cart->getShippingAmount();
                    $cart->save();
                }
            }

            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout();
            $layout->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function paymentAction(){
        try{
            $cart = \Mage::getModel('Model\Cart');
            $option = $this->getRequest()->getPost('payment');
            if($option){
                foreach($option as $key=>$value){
                    $cart = $cart->load($key);
                    $cart->paymentMethodId = $value;
                    $cart->save();
                }
            }

            $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
            $layout = $this->getLayout();
            $layout->getContent()->addChild($grid);
            $cart = $this->getCart();
            $grid = $grid->setCart($cart)->toHtml();
            $this->makeResponse($grid);
        }catch(\Exception $e){
            $this->getMessage()->setFailure($e->getMessage());
        }
    }

    public function shippingAddressAction(){
        $data = $this->getRequest()->getPost('shipping');
        $id = $this->getRequest()->getGet('cartId');
        $saveToAddress = $this->getRequest()->getPost('shippingSave');

        $cart = \Mage::getModel('Model\Cart')->load($id);
        $shippingAddress = \Mage::getModel('Model\Cart\Address');

        if(array_key_exists('sameAsBilling', $data)){
            $billingAddress = $cart->getCartBillingAddress();

            if($availableAddress = $cart->getCartShippingAddress()){
                $shippingAddress = $availableAddress;
                $shippingAddress->setData($billingAddress->getOriginalData());
                unset($shippingAddress->cartAddressId);
                $shippingAddress->addressType = 'shipping';
            }else{
                $shippingAddress->setData($billingAddress->getOriginalData());
                unset($shippingAddress->cartAddressId);
                $shippingAddress->addressType = 'shipping';
            }
            $shippingAddress->sameAsBilling = 1;
        }else{
            if($availableAddress = $cart->getCartShippingAddress()){
                $shippingAddress = $availableAddress;
                $shippingAddress->setData($data);
            }else{
                $shippingAddress->setData($data);
                $shippingAddress->cartId = $cart->cartId;
                $shippingAddress->addressType = 'shipping';
            }
        }
        $shippingAddress->save();

        if($saveToAddress){
            $customerAddress = $cart->getCustomer()->getShippingAddress();
            if(!$customerAddress){
                $customerAddress = \Mage::getModel('Model\Customer\Address');
                $customerAddress->customerId = $cart->customerId;
                $customerAddress->addressType = 'shipping';
            }
            $customerAddress->address = $shippingAddress->address;
            $customerAddress->city = $shippingAddress->city;
            $customerAddress->state = $shippingAddress->state;
            $customerAddress->zipcode = $shippingAddress->zipcode;
            $customerAddress->country = $shippingAddress->country;
            $customerAddress->save();
        }

        $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
        $layout = $this->getLayout();
        $layout->getContent()->addChild($grid);
        $cart = $this->getCart();
        $grid = $grid->setCart($cart)->toHtml();
        $this->makeResponse($grid);
    }

    public function billingAddressAction(){
        $data = $this->getRequest()->getPost('billing');
        $id = $this->getRequest()->getGet('cartId');
        $saveToAddress = $this->getRequest()->getPost('billingSave');

        $cart = \Mage::getModel('Model\Cart')->load($id);
        $billingAddress = \Mage::getModel('Model\Cart\Address');

        if($availableAddress = $cart->getCartBillingAddress()){
            $billingAddress = $availableAddress;
            $billingAddress->setData($data);
        }else{
            $billingAddress->setData($data);
            $billingAddress->cartId = $cart->cartId;
            $billingAddress->addressType = 'billing';
        }
        $billingAddress->save();

        if($saveToAddress){
            $customerAddress = $cart->getCustomer()->getBillingAddress();
            if(!$customerAddress){
                $customerAddress = \Mage::getModel('Model\Customer\Address');
                $customerAddress->customerId = $cart->customerId;
                $customerAddress->addressType = 'billing';
            }
            $customerAddress->address = $billingAddress->address;
            $customerAddress->city = $billingAddress->city;
            $customerAddress->state = $billingAddress->state;
            $customerAddress->zipcode = $billingAddress->zipcode;
            $customerAddress->country = $billingAddress->country;
            $customerAddress->save();
        }

        $grid = \Mage::getBlock('Block\Admin\Cart\Grid');
        $layout = $this->getLayout();
        $layout->getContent()->addChild($grid);
        $cart = $this->getCart();
        $grid = $grid->setCart($cart)->toHtml();
        $this->makeResponse($grid);
    }

    public function placeOrderAction(){
        $placeOrder = \Mage::getModel('Model\PlaceOrder');
        $placeOrderItem = \Mage::getModel('Model\PlaceOrder\Item');
        $placeOrderAddress = \Mage::getModel('Model\PlaceOrder\Address');

        $cart = \Mage::getModel('Model\Cart');
        $cartItem = \Mage::getModel('Model\Cart\Item');
        $cartAddress = \Mage::getModel('Model\Cart\Address');
        $id = $this->getRequest()->getGet('cartId');
        $cart->load($id);

        if($cartItem = $cart->getItems()){
            $cart->total = $cart->getTotal($cartItem);
            $cart->discount = $cart->getTotalDiscount($cartItem);
            $cart->save();
        }
        $cart = $cart->load($id);

        if($cartItem){
            foreach($cartItem->getData() as $key=>$item){
                $placeOrderItem->resetData()->setData($item->getOriginalData());
                $placeOrderItem->orderItemId = $item->cartItemId;
                $placeOrderItem->orderId = $item->cartId;
                unset($placeOrderItem->cartItemId);
                unset($placeOrderItem->cartId);
                if($placeOrderItem->save()){
                    $item->delete();
                }
            }
        }

        if($cartAddress = $cart->getCartBillingAddress()){
            $placeOrderAddress->setData($cartAddress->getOriginalData());
            $placeOrderAddress->orderAddressId = $cartAddress->cartAddressId;
            $placeOrderAddress->orderId = $cartAddress->cartId;
            unset($placeOrderAddress->cartAddressId);
            unset($placeOrderAddress->cartId);
            if($placeOrderAddress->save()){
                $cartAddress->delete();
            }
        }

        if($cartAddress = $cart->getCartShippingAddress()){
            $placeOrderAddress->resetData()->setData($cartAddress->getOriginalData());
            $placeOrderAddress->orderAddressId = $cartAddress->cartAddressId;
            $placeOrderAddress->orderId = $cartAddress->cartId;
            unset($placeOrderAddress->cartAddressId);
            unset($placeOrderAddress->cartId);
            if($placeOrderAddress->save()){
                $cartAddress->delete();

            }
        }

        $placeOrder->setData($cart->getOriginalData());
        $placeOrder->orderId = $cart->cartId;
        unset($placeOrder->cartId);
        if($placeOrder->save()){
            $cart->delete();
        }
        
        $placeOrder = \Mage::getBlock('Block\Admin\Cart\PlaceOrder')->toHtml();
        $this->makeResponse($placeOrder);
    }
}

?>