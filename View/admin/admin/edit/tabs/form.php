<?php $admin = $this->getAdmin(); ?>

<h1>Admin Update Form</h1>
<form id='form' action="<?php echo $this->getUrl()->getUrl('save',NULL,['adminId'=>$admin->adminId],true); ?>" method="POST">
    User Name:<input type="text" name="admin[userName]" value="<?php echo $admin->userName; ?>"><br><br>
    Password:<input type="password" name="admin[password]" value="<?php echo $admin->password; ?>"><br><br>
    Status:
    <select name="admin[status]">
    <?php foreach($admin->getStatusOption() as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($admin->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    <input type="button" onclick="mage.setForm()" value="submit">
</form>
