<?php
$customerGroup = $this->getCustomerGroup();
$option = $customerGroup->getStatusOption();
?>

<h1>Customer Group Update Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('save',NULL,['groupId'=>$customerGroup->groupId],true); ?>" method="POST">
    Name:<input type="text" name="customerGroup[name]" value="<?php echo $customerGroup->name; ?>"><br><br>
    Status:
    <select name="customerGroup[status]">
    <?php foreach($option as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($customerGroup->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    <input type="button" onclick="mage.setForm()" value="Submit"><br><br>
</form>