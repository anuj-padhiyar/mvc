<?php 
$customers = $this->getCustomer();
if($customers){
    foreach($customers as $key=>$value){
        $data = $value->getData();
        break;
    }   
}
?>

<h1>Customer Table</h1>
<a class="add" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',null,[],true) ?>').load()">Add Data</a>
<table class="grid">
    <?php if(!$customers): ?>
    <tr>
        <td>No Record Found</td>
    </tr>
    <?php else: ?>
    <tr class="gridtr">
        <?php foreach($data as $key=>$value){ ?>
            <th class="gridth"><?php echo $key?></th>
        <?php } ?>
        <th class="gridth" colspan='2'>Action</th>
    </tr>
    <?php foreach ($customers as $key => $value) { ?>
        <?php if($value->addressType == 'Shipping'){continue;} ?>
    <tr class="gridtr">
        <?php foreach($data as $key1=>$value1){ ?>
        <td class="gridtd"><?php echo $value->$key1; ?></td>
        <?php } ?>
        <td class="gridtd" colspan=2>
            <a class="update" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('editForm',NULL,['customerId'=>$value->customerId]); ?>').load();" href = "javascript:void(0);">
                Update
            </a>
            <a class="delete" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('delete',NULL,['customerId'=>$value->customerId]); ?>').resetParams().load();" href = "javascript:void(0);">
                Delete
            </a>
        </td>
    </tr>
    <?php } endif; ?>
</table>