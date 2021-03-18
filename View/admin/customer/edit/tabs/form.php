<?php
$customers = $this->getCustomer();
$option = $customers->getStatusOption();
$group = $this->getGroup();

?>

<h1>Customer Form</h1>
<form id='form' action="<?php echo $this->getUrl()->getUrl('save',NULL,['customerId'=>$customers->customerId],true); ?>" method="POST">
    Group:
    <select name="customer[groupId]">
        <?php foreach($group as $key=>$value){?>
        <option value="<?php echo $value['groupId'] ?>"><?php echo $value['name']; ?></option>
        <?php } ?>
    </select><br><br>
    First Name:<input type="text" name="customer[firstName]" value="<?php echo $customers->firstName; ?>"><br><br>
    Last Name:<input type="text" name="customer[lastName]" value="<?php echo $customers->lastName; ?>"><br><br>
    Email:<input type="text" name="customer[email]" value="<?php echo $customers->email; ?>"><br><br>
    Passsword:<input type="text" name="customer[password]" value="<?php echo $customers->password; ?>"><br><br>
    Status:
    <select name="customer[status]">
    <?php foreach($option as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($customers->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    <input type="button" onclick="mage.setForm()" value="Save"><br><br>
</form>