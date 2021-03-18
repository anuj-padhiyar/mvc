<?php $payments = $this->getPayment(); ?>

<h1>Payment Table</h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true) ?>').load();" href="javascript:void(0)">Add Data</a>
<table class="grid">
    <tr class="gridtr">
        <th class="gridth">Method ID</th>
        <th class="gridth">Name</th>
        <th class="gridth">Code</th>
        <th class="gridth">Description</th>
        <th class="gridth">Status</th>
        <th class="gridth">Created Date</th>
        <th class="gridth" colspan='2'>Action</th>
    </tr>
    <?php
        foreach ($payments as $key => $value) {
    ?>
    <tr class="gridtr">
        <td class="gridtd"><?php echo $value->methodId;?></td>
        <td class="gridtd"><?php echo $value->name;?></td>		
        <td class="gridtd"><?php echo $value->code;?></td>		
        <td class="gridtd"><?php echo $value->description;?></td>
        <td class="gridtd"><?php echo $value->status;?></td>
        <td class="gridtd"><?php echo $value->createdDate;?></td>
        <td class="gridtd" colspan=2>
            <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['methodId'=>$value->methodId]); ?>').load();" href = "javascript:void(0);">
                Update
            </a>
            <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['methodId'=>$value->methodId]); ?>').resetParams().load();" href = "javascript:void(0);">
                Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</table>