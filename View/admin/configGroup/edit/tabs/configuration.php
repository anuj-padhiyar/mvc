<?php $configGroup = $this->getConfigGroup(); ?>
<?php $config = $configGroup->getConfig(); ?>

<form id="form" action="<?php echo $this->getUrl()->getUrl('update'); ?>" method="POST">
    <input type="button" onclick="mage.setForm()" name="update" value="Update">
    <input type="button" name="addConfig" value="Add Config" onclick="addRow();">
    <table id='existingConfig' class='grid'>
        <tbody>
            <?php if($config): ?>
                <?php foreach($config as $key=>$config): ?>
                    <tr class='gridtr'>
                        <td class='gridtd'><input type="text" placeholder="title" name="exist[<?php echo $config->configId; ?>][title]" value="<?php echo $config->title ?>"></td>
                        <td class='gridtd'><input type="text" placeholder="code"name="exist[<?php echo $config->configId; ?>][code]" value="<?php echo $config->code ?>"></td>
                        <td class='gridtd'><input type="text" placeholder="value"name="exist[<?php echo $config->configId; ?>][value]" value="<?php echo $config->value ?>"></td>
                        <td class='gridtd'><input type="button" name="removeConfig" value="Remove Config" onclick="removeRow(this);"></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</form>
<div style="display:none">
    <table id='newConfig'>
        <tbody>
            <tr class='gridtr'>
                <td class='gridtd'><input type="text" placeholder="title" name="new[title][]"></td>
                <td class='gridtd'><input type="text" placeholder="name" name="new[code][]"></td>
                <td class='gridtd'><input type="text" placeholder="value"name="new[value][]"></td>
                <td class='gridtd'><input type="button" name="new[removeConfig][]" value="Remove Config" onclick="removeRow(this)"></td>
            </tr>
        </tbody>
    </table>
</div>

<script>

function addRow(){
    var newConfigTable = document.getElementById('newConfig');
    var existingConfigTable = document.getElementById('existingConfig').children[0];
    existingConfigTable.prepend(newConfigTable.children[0].children[0].cloneNode(true));
}

function removeRow(button){
    var objTr = button.parentElement.parentElement;
    objTr.remove();
}

</script>