<?php $attributes = $this->getAttributes(); ?>

<form id="form" action="<?php echo $this->getUrl()->getUrl('updateAttribute'); ?>>" method="POST">
    <?php foreach($attributes as $key=>$attribute): ?>
        <br>
        <?php if($attribute->inputType == "text"): ?>
            <?php echo $attribute->name; ?> : 
            <input type="text" value="<?php echo $attribute->name; ?>"><br>
        <?php endif; ?>
        <?php if($attribute->inputType == "textarea"): ?>
            <?php echo $attribute->name; ?>
            <textarea name="<?php echo $attribute->name ?>"></textarea><br>
        <?php endif; ?>
        <?php if($attribute->inputType == "select"): ?>
            <?php echo $attribute->name; ?>
            <select name="">
            <option selected disabled>Select <?php echo $attribute->name; ?></option>
                <?php foreach($attribute->getOptions() as $key=>$option): ?>
                    <option value="<?php echo $option->optionId ;?>"><?php echo $option->name; ?></option>
                <?php endforeach; ?>
            </select><br>
        <?php endif; ?>
        <?php if($attribute->inputType == "checkbox"): ?>
            <?php echo $attribute->name; ?>
                <?php foreach($attribute->getOptions() as $key=>$option): ?>
                    <input type="checkbox" value="<?php echo $option->optionId ;?>"><?php echo $option->name; ?>
                <?php endforeach; ?><br>
        <?php endif; ?>
        <?php if($attribute->inputType == "radio"): ?>
            <?php echo $attribute->name; ?>
                <?php foreach($attribute->getOptions() as $key=>$option): ?>
                    <input type="radio" value="<?php echo $option->optionId ;?>"><?php echo $option->name; ?></option>
                <?php endforeach; ?><br>
        <?php endif; ?>
    <?php endforeach; ?>
    <br>
    <input type="button" onclick="mage.setForm()" value="Update">
</form>