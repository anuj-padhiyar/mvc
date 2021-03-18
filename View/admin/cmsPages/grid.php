<?php $cmsPages = $this->getCmsPages(); ?>

<h1>CMS Pages Table<h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true) ?>').load();" href="javascript:void(0)">Add Data</a>
<table class='grid'>
    <tr class='gridtr'>
        <th class='gridth'>Page Id</th>
        <th class='gridth'>Title</th>
        <th class='gridth'>Identifier</th>
        <th class='gridth'>Content</th>
        <th class='gridth'>Status</th>
        <th class='gridth'>Created Date</th>
        <th class="gridth" colspan='2'>Action</th>
    </tr>
    <?php foreach($cmsPages as $key=>$value): ?>
    <tr class='gridtr'>
        <td class='gridtd'><?php echo $value->pageId ?></td>
        <td class='gridtd'><?php echo $value->title ?></td>
        <td class='gridtd'><?php echo $value->identifier ?></td>
        <td class='gridtd'><?php echo $value->content ?></td>
        <td class='gridtd'><?php echo $value->status ?></td>
        <td class='gridtd'><?php echo $value->createdDate ?></td>
        <td class="gridtd" colspan=2>
            <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['pageId'=>$value->pageId]); ?>').resetParams().load();" href = "javascript:void(0);">
                Update
            </a>
            <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['pageId'=>$value->pageId]); ?>').resetParams().load();" href = "javascript:void(0);">
                Delete
            </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>