<?php

$customer = $this->getCustomer();
$billing = $customer->getBillingAddress();
$shipping = $customer->getShippingAddress();

?>

<h1>Customer Address Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('addressSave',NULL,['customerId'=>$this->getRequest()->getGet('customerId')],true); ?>" method="POST">
    <p>Billing Address</p>
    Address:<input type="text" name="billing[address]" value="<?php echo $customer->getAddressValue('billing','address'); ?>"><br><br>
    City:<input type="text" name="billing[city]" value="<?php echo $customer->getAddressValue('billing','city'); ?>"><br><br>
    State:<input type="text" name="billing[state]" value="<?php echo $customer->getAddressValue('billing','state'); ?>"><br><br>
    Zip Code:<input type="text" name="billing[zipcode]" value="<?php echo $customer->getAddressValue('billing','zipcode'); ?>"><br><br>
    Country:<input type="text" name="billing[country]" value="<?php echo $customer->getAddressValue('billing','country'); ?>"><br><br>

    <p>Shipping Address</p>
    Address:<input type="text" name="shipping[address]" value="<?php echo $customer->getAddressValue('shipping','address'); ?>"><br><br>
    City:<input type="text" name="shipping[city]" value="<?php echo $customer->getAddressValue('shipping','city');?>"><br><br>
    State:<input type="text" name="shipping[state]" value="<?php echo $customer->getAddressValue('shipping','state');?>"><br><br>
    Zip Code:<input type="text" name="shipping[zipcode]" value="<?php echo $customer->getAddressValue('shipping','zipcode');?>"><br><br>
    Country:<input type="text" name="shipping[country]" value="<?php echo $customer->getAddressValue('shipping','country');?>"><br><br>    
    <input type="button" onclick="mage.setForm();" value="Save">
    <input type="reset" value="Reset">
</form>