<?php
$category = $this->getCategory();
$option = $category->getStatusOption();
$parent = $this->getTemp();
?>

<h1>Category Form</h1>
<form id ='form' action="<?php echo $this->getUrl()->getUrl('save',NULL,['categoryId'=>$category->categoryId],true); ?>" method="POST">
    Parent Category:
    <select name="category[parentId]">
    <option value="0">Null</option>
    <?php foreach($parent as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($category->parentId == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    Name:<input type="text" name="category[name]" value="<?php echo $category->name; ?>"><br><br>
    Status:
    <select name="category[status]">
    <?php foreach($option as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($category->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    Description:<textarea name="category[description]"><?php echo $category->description ?></textarea><br><br>
    <input type="button" onclick="mage.setForm();" value="Save"><br><br>
</form>