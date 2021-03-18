<?php $customerGroups = $this->getCustomerGroup(); ?>

<h1>Customer Group Table</h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true) ?>').load();" href="javascript:void(0)">Add Data</a>
<table class="grid">
    <tr class="gridtr">
        <th class="gridth">Group Id</th>
        <th class="gridth">Group Name</th>
        <th class="gridth">Status</th>
        <th class="gridth">Created Date</th>
        <th class="gridth">Action</th>
    </tr>
    <?php foreach($customerGroups as $key=>$value){ ?>
        <tr class="gridtr">
            <td class="gridtd"><?php echo $value->groupId; ?></td>
            <td class="gridtd"><?php echo $value->name; ?></td>
            <td class="gridtd"><?php echo $value->status; ?></td>
            <td class="gridtd"><?php echo $value->createdDate; ?></td>
            <td class="gridtd" colspan=2>
                <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['groupId'=>$value->groupId]); ?>').load();" href = "javascript:void(0);">
                    Update
                </a>
                <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['groupId'=>$value->groupId]); ?>').resetParams().load();" href = "javascript:void(0);">
                    Delete
                </a>
            </td>
        </tr>
    <?php } ?>
</table>