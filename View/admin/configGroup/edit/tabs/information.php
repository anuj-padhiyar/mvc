<?php $configGroup = $this->getConfigGroup(); ?>

<h1>Config Group Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="POST">
    Name:<input type="text" name="configGroup[name]" value="<?php echo $configGroup->name; ?>"><br><br>
    <input type="button" onclick="mage.setForm()" value="Save">
</form>
