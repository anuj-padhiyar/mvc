<?php $this->setController(\Mage::getBlock("Controller\Core\Admin")); ?>

<div class="head">
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','category'); ?>').resetParams().load();" href="javascript:void(0);">Category</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','customer'); ?>').resetParams().load();" href="javascript:void(0);">Customer</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','product'); ?>').resetParams().load();" href="javascript:void(0);">Product</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','payment'); ?>').resetParams().load();" href="javascript:void(0);">Payment</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','shipping'); ?>').resetParams().load();" href="javascript:void(0);">Shipping</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','admin'); ?>').resetParams().load();" href="javascript:void(0);">Admin</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','customerGroup'); ?>').resetParams().load();" href="javascript:void(0);">Customer Group</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','cmsPages'); ?>').resetParams().load();" href="javascript:void(0);">CMS Pages</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','attribute'); ?>').resetParams().load();" href="javascript:void(0);">Attribute</a>
    <a onclick="mage.setUrl('<?php echo $this->getController()->getUrl('grid','configGroup'); ?>').resetParams().load();" href="javascript:void(0);">Config Group</a>
</div>
<style>
    body{
        background-color:#9fff80;
        /* background-color:white; */
    }
    .head{
        background-color:#009933;
        overflow:hidden;
        color:white;
        margin-bottom:30px;
    }
    a{
        text-decoration:none;
        color:black;
        display:inline;
    }
    div a{
        float:left;
        text-align:center;
        font-size:18px;
        color:#f2f2f2;
        padding:14px 16px;
    }
    div a:hover{
        background-color:white;
        color:black;
    }
    .grid{
        font-family:arial;
        width:100%;
        background-color:#339966;
        text-align:center;
        border:20px;
        margin-top:46px;
    }
    .gridtd,.gridth,.grid{
        border:1px solid #d1d1d1;
        border-collapse:collapse;
    }
    .gridth,.gridtd{
        padding:15px;
    }
    .gridth{
        background-color:#669900;
    }
    .add,.update,.delete,.applyFilter{
        color:white;
        padding:10px;
        border-radius:10px;
    }
    .add:hover,.update:hover,.delete:hover,.applyFilter:hover{
        background-color:white;
        color:black;
    }
    .add,.applyFilter{
        background-color:#bf8040;
    }
    .update{
        background-color:#3333ff;
        padding:10px 10px 10px 10px;

    }.delete{
        margin-left:20px;
        background-color:red;
        padding:10px 10px 10px 10px;
    }
    .tabs{
        background-color:Blue;
    }
    .tabs:hover{
        background-color:pink;
    }
    .leftBar{
        background-color:brown;
    }
    .rightBar{
        background-color:brown;
    }
</style>