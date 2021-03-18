<?php $categories = $this->getCategory() ?>

<h1>Category Table</h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true); ?>').load();" href="javascript:void(0);">Add Data</a>
<table class="grid">
    <thead>
        <tr class="gridtr">
            <th class="gridth">CategotyId</th>
            <th class="gridth">Name</th>
            <th class="gridth">Status</th>
            <th class="gridth">Discription</th>
            <th class="gridth" colspan='2'>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!$categories): ?>
        <tr class="gridtr">
            <td>No Record Found...</td>
        </tr>
        <?php else: ?>
        <?php foreach ($categories as $key => $value) { ?>
        <tr class="gridtr">
            <td class="gridtd"><?php echo $value->categoryId; ?></td>
            <td class="gridtd"><?php echo $value->name; ?></td>
            <td class="gridtd"><?php echo $value->status ?></td>
            <td class="gridtd"><?php echo $value->description; ?></td>
            <td class="gridtd" colspan=2>
                <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['categoryId'=>$value->categoryId]); ?>').load();" href = "javascript:void(0);">
                    Update
                </a>
                <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['categoryId'=>$value->categoryId]); ?>').resetParams().load();" href = "javascript:void(0);">
                    Delete
                </a>
            </td>
        </tr>
        <?php } ?>
        <?php endif; ?>
    </tbody>
</table>