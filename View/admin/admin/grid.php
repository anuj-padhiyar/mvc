<?php $admins = $this->getAdmin(); ?>

<h1>Admin Table</h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true); ?>').load();" href="javascript:void(0);">Add Data</a>
<table class="grid">
    <tr class="gridtr">
        <th class="gridth">AdminId</th>
        <th class="gridth">Username</th>
        <th class="gridth">Password</th>
        <th class="gridth">Status</th>
        <th class="gridth">createdDate</th>
        <th class="gridth" colspan='2'>Action</th>
    </tr>
    <?php foreach ($admins as $key => $value) { ?>
    <tr class="gridtr">
        <td class="gridtd"><?php echo $value->adminId; ?></td>
        <td class="gridtd"><?php echo $value->userName; ?></td>
        <td class="gridtd"><?php echo $value->password ?></td>
        <td class="gridtd"><?php echo $value->status; ?></td>
        <td class="gridtd"><?php echo $value->createdDate; ?></td>
        <td class="gridtd" colspan=2>
            <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['adminId'=>$value->adminId]); ?>').load();" href = "javascript:void(0);">
                Update
            </a>
            <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['adminId'=>$value->adminId]); ?>').resetParams().load();" href = "javascript:void(0);">
                Delete
            </a>
        </td>
    </tr>
    <?php } ?>
</table>
