<?php $groupPrice = $this->getGroupPrice(); ?>

<h1>Group Price</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('groupPrice') ?>" method="POST">
    <input type="button" onclick="mage.setForm()" name="save" value="UPDATE">
    <table class="grid">
        <tr class="gridtr">
            <th class="gridth">Group Id</th>
            <th class="gridth">Group Name</th>
            <th class="gridth">Group Price</th>
            <th class="gridth">Version</th>
        </tr>
        <?php foreach($groupPrice as $key=>$value){ ?>
        <?php $type = ($value->groupPrice) ? "old" : "new" ; ?>
            <tr class="gridtr">
                <td class="gridtd" ><?php echo $value->groupId ?></td>
                <td class="gridtd"><?php echo $value->groupName ?></td>
                <td class="gridtd" ><input type = "text" name="price[<?php echo $type; ?>][<?php echo $value->groupId ?>]" value="<?php echo $value->groupPrice ?>"></td>
                <td class="gridtd"><?php echo $type;?></td> 
            </tr>
        <?php } ?>
    </table>
</form>