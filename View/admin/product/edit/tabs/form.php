<?php
$product = $this->getProduct();
$option = $product->getStatusOption();
?>

<h1>Product Update Form</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('save',NULL,['productId'=>$product->productId],true); ?>" method="POST">
    SKU:<input type="text" name="product[sku]" value="<?php echo $product->sku; ?>"><br><br>
    Name:<input type="text" name="product[name]" value="<?php echo $product->name; ?>"><br><br>
    Price:<input type="text" name="product[price]" value="<?php echo $product->price; ?>"><br><br>
    Discount:<input type="text" name="product[discount]" value="<?php echo $product->discount; ?>"><br><br>
    Quantity:<input type="number" name="product[quantity]" value="<?php echo $product->quantity; ?>"><br><br>
    Description:<textarea name="product[description]"><?php echo $product->description; ?></textarea><br><br>         
    Status:
    <select name="product[status]">
    <?php foreach($option as $key=>$value){ ?>
        <option value="<?php echo $key; ?>" <?php if($product->status == $key){echo "selected";} ?> ><?php echo $value; ?></option>
    <?php } ?>
    </select><br><br>
    <input type="button" onclick="mage.setForm()" value="Save"><br><br>
</form>