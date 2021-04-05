<?php
$collection = $this->getCollection();
$columns = $this->getColumns();
$actions = $this->getActions();
$buttons = $this->getButtons();
?>

<h1><?php echo $this->getTitle(); ?></h1>
<form id="form" action="<?php echo $this->getFormUrl('filter'); ?>" method="POST">
    <?php if($buttons): ?>
        <?php foreach ($buttons as $key => $value): ?>
            <a class="<?php echo $key; ?>" onclick="<?php echo $this->getButtonUrl($value['method']); ?>" href="javascript:void(0)">
                <?php echo $value['label']; ?>
            </a>
        <?php endforeach; ?>
    <?php endif; ?>
    <table class="grid">
        <?php if($columns): ?>
            <tr class="gridtr">
                <?php foreach($columns as $key=>$value): ?>
                    <th class="gridth"><?php echo $value['label']; ?></th>
                <?php endforeach; ?>
                <th class="gridth" colspan="2">Actions</th>
            </tr>
            <tr class="gridtr">
                <?php foreach($columns as $field=>$value): ?>
                    <td class="gridtd"><input type="text" name="field[<?php echo $value['type']; ?>][<?php echo $field;?>]" value="<?php echo $this->getFilter()->getFilterValue($value['type'],$field); ?>"></td>
                <?php endforeach; ?>
            </tr>
        <?php endif; ?>
        <?php if($collection): ?>
            <?php foreach($collection as $key => $row): ?>
                <tr class="gridtr">
                    <?php if($columns): ?>
                        <?php foreach($columns as $field=>$value): ?>
                            <td class="gridtd"><?php echo $this->getFieldValue($row,$field); ?></td>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if($actions): ?>
                        <?php foreach($actions as $key=>$value): ?>
                            <td>
                                <a class="<?php echo $key; ?>" onclick="<?php echo $this->getMethodUrl($row,$value['method']); ?>" href = "javascript:void(0);">
                                    <?php echo $value['label']; ?>
                                </a>
                            </td>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>

<?php $this->getFilter()->clearFilters(); ?>