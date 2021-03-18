<?php
$shipping = $this->getShipping();
$option = $shipping->getStatusOption();
?>


<h1>Shipping Update Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('save',NULL,['methodId'=>$shipping->methodId],true); ?>" method="POST">

    Name:<input type="text" name="shipping[name]" value="<?php echo $shipping->name; ?>"><br><br>
    Code:<input type="text" name="shipping[code]" value="<?php echo $shipping->code; ?>"><br><br>
    Amount:<input type="text" name="shipping[amount]" value="<?php echo $shipping->amount; ?>"><br><br>
    Description:<textarea name="shipping[description]"><?php echo $shipping->description; ?></textarea><br><br>         
    Status:
    <select name="shipping[status]">
    <?php foreach($option as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($shipping->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    <input type="button" onclick="mage.setForm()" value="Save"><br><br>
</form>
