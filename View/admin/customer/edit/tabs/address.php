<?php
$addresses = $this->getAddress();
$billing = [];
$shipping = [];
if($addresses){
    foreach($addresses as $key=>$value){
        if($value['addressType'] == 'Billing'){
            $billing = $value;
        }else if($value['addressType'] == 'Shipping'){
            $shipping = $value;
        }
    }
}
?>

<h1>Customer Address Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('addressSave',NULL,['customerId'=>$this->getRequest()->getGet('customerId')],true); ?>" method="POST">
    <p>Billing Address</p>
    Address:<input type="text" name="address" value="<?php 
            if(array_key_exists('address',$billing)){
                echo $billing['address'];
            };
        ?>"><br><br>
    City:<input type="text" name="city" value="<?php 
            if(array_key_exists('city',$billing)){
                echo $billing['city'];
            };
        ?>"><br><br>
    State:<input type="text" name="state" value="<?php 
            if(array_key_exists('state',$billing)){
                echo $billing['state'];
            };
        ?>"><br><br>
    Zip Code:<input type="text" name="zipcode" value="<?php 
            if(array_key_exists('zipcode',$billing)){
                echo $billing['zipcode'];
            };
        ?>"><br><br>
    Country:<input type="text" name="country" value="<?php 
            if(array_key_exists('country',$billing)){
                echo $billing['country'];
            };
        ?>"><br><br>
   

    <p>Shipping Address</p>
    Address:<input type="text" name="shippingaddress" value="<?php 
            if(array_key_exists('address',$shipping)){
                echo $shipping['address'];
            };
        ?>"><br><br>
    City:<input type="text" name="shippingcity" value="<?php 
            if(array_key_exists('city',$shipping)){
                echo $shipping['city'];
            };
        ?>"><br><br>
    State:<input type="text" name="shippingstate" value="<?php 
            if(array_key_exists('state',$shipping)){
                echo $shipping['state'];
            };
        ?>"><br><br>
    Zip Code:<input type="text" name="shippingzipcode" value="<?php 
            if(array_key_exists('zipcode',$shipping)){
                echo $shipping['zipcode'];
            };
        ?>"><br><br>
    Country:<input type="text" name="shippingcountry" value="<?php 
            if(array_key_exists('country',$shipping)){
                echo $shipping['country'];
            };
        ?>"><br><br>    
    <input type="button" onclick="mage.setForm();" value="Save">
    <input type="reset" value="Reset">
</form>