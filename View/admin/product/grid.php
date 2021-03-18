<?php $products = $this->getProduct(); ?>

<h1>Product Table</h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true) ?>').load()" href="javascript:void(0)">Add Data</a>
<table class="grid">
    <tr class="gridtr">
        <?php foreach ($products as $key => $value) { 
            foreach($value->getData() as $key2=>$value2){ ?>
                <th class="gridth"><?php echo $key2; ?></th>
        <?php }break;} ?>
        <th class="gridth" colspan='2'>Action</th>
    </tr>
    <?php foreach ($products as $key => $value) { ?>
    <tr>
        <?php foreach($value->getData() as $key2=>$value2){ ?>
            <td class="gridtd"><?php echo $value2; ?></td>
        <?php } ?>
        <td class="gridtd" colspan=2>
            <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['productId'=>$value->productId]); ?>').load();" href = "javascript:void(0);">
                Update
            </a>
            <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['productId'=>$value->productId]); ?>').resetParams().load();" href = "javascript:void(0);">
                Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</table>