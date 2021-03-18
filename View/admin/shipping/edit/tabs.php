<?php
$tabs = $this->getTabs();
foreach($tabs as $key=>$value){ ?>
        <a class='tabs' onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl(null,null,['tab'=>$key]) ?>').load()" href = "javascript:void(0)">
        <?php echo $value['label'] ?>
    </a>
<?php }?>