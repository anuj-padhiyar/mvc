<?php $attributes = $this->getAttributes(); ?>

<h1>Attribute Table</h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true); ?>').load();" href="javascript:void(0);">Add Data</a>
<table border="1" class='grid'>
    <tr class='gridtr'>
        <th class='gridth'>Attribute Id</th>
        <th class='gridth'>Entity Type Id</th>
        <th class='gridth'>Name</th>
        <th class='gridth'>Code</th>
        <th class='gridth'>Input Type</th>
        <th class='gridth'>Back End Type</th>
        <th class='gridth'>Sort Order</th>
        <th class='gridth'>Back End Model</th>
        <th class='gridth' colspan="2">Action</th>
    </tr>
        <?php if(!$attributes): ?>
                <tr class='gridtr'>
                    <td class='gridtd' colspan="9">No Record Found</td>
                </tr>
        <?php else: ?>
        <?php foreach($attributes as $key=>$value): ?>
    <tr class='gridtr'>
        <td class='gridtd'><?php echo $value->attributeId ?></td>
        <td class='gridtd'><?php echo $value->entityTypeId ?></td>
        <td class='gridtd'><?php echo $value->name ?></td>
        <td class='gridtd'><?php echo $value->code ?></td>
        <td class='gridtd'><?php echo $value->inputType ?></td>
        <td class='gridtd'><?php echo $value->backendType ?></td>
        <td class='gridtd'><?php echo $value->sortOrder ?></td>
        <td class='gridtd'><?php echo $value->backendModel ?></td>
        <td class="gridtd" colspan=2>
                <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['attributeId'=>$value->attributeId]); ?>').load();" href = "javascript:void(0);">
                    Update
                </a>
                <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['attributeId'=>$value->attributeId]); ?>').resetParams().load();" href = "javascript:void(0);">
                    Delete
                </a>
            </td>
    </tr>
    <?php endforeach; ?>
    <?php endif; ?>
</table>