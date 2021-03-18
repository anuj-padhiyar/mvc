<?php
$payments = $this->getPayment();

$option = $payments->getStatusOption();
?>

<h1>Payment Update Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('save',NULL,['methodId'=>$payments->methodId],true); ?>" method="POST">

    Name:<input type="text" name="payment[name]" value="<?php echo $payments->name; ?>"><br><br>
    code:<input type="text" name="payment[code]" value="<?php echo $payments->code; ?>"><br><br>
    Description:<textarea name="payment[description]"><?php echo $payments->description; ?></textarea><br><br>         
    Status:
    <select name="payment[status]">
    <?php foreach($option as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($payments->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    <input type='button' onclick="mage.setForm()" name='submit' value='Submit'>
</form>