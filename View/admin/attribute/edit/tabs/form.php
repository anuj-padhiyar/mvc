<?php $attribute = $this->getAttribute(); ?>

<h1>Attribute Update Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="POST">

    Entity Type Id:<select name="attribute[entityTypeId]">
        <?php foreach($attribute->getEntityTypeOptions() as $key=>$value): ?>
            <option value="<?php echo $key ?>" <?php if($key==$attribute->entityTypeId)echo "selected"; ?>><?php echo $value; ?></option>
        <?php endforeach; ?>
    </select><br><br>
    Name:<input type="text" name="attribute[name]" value="<?php echo $attribute->name; ?>"><br><br>
    Code:<input type="text" name="attribute[code]" value="<?php echo $attribute->code; ?>"><br><br>
    Back End Type:<select name="attribute[backendType]">
        <?php foreach($attribute->getBackendTypeOption() as $key=>$value): ?>
            <option value="<?php echo $key ?>"<?php if($key==$attribute->backendType)echo "selected"; ?>><?php echo $value ?></option>
        <?php endforeach; ?>
    </select><br><br>
    Input Type:<select name="attribute[inputType]">
        <?php foreach($attribute->getInputTypeOption() as $key=>$value): ?>
            <option value="<?php echo $key ?>" <?php if($key==$attribute->inputType)echo "selected"; ?>><?php echo $value ?></option>
        <?php endforeach; ?>
    </select><br><br>
    Sort Order:<input type="text" name="attribute[sortOrder]" value="<?php echo $attribute->sortOrder; ?>"><br><br>
    Back End Model:<input type="text" name="attribute[backendModel]" value="<?php echo $attribute->backendModel; ?>"><br><br>
    <input type="button" onclick="mage.setForm()" value="Save">
</form>
