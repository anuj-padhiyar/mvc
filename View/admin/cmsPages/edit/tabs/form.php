<?php 
$cmsPages = $this->getCmsPages();
$options = $cmsPages->getStatusOption(); 
?>

<h1>CMS Pages Form</h1>
<form id="form" action='<?php echo $this->getUrl()->getUrl('save'); ?>' method='POST'>
    Title:<input name='cmsPages[title]' type='text' value='<?php echo $cmsPages->title; ?>'><br><br>
    Identifier:<input name='cmsPages[identifier]' type='text' value='<?php echo $cmsPages->identifier; ?>'><br><br>
    Content:<input name='cmsPages[content]' type='text' value='<?php echo $cmsPages->content; ?>'><br><br>
    Status:<select name='cmsPages[status]'>
    <?php foreach($options as $key=>$value): ?>
    <option value='<?php echo $key; ?>' <?php if($cmsPages->status) echo 'selected'; ?>><?php echo $value ?></option>
    <?php endforeach; ?>
    </select><br><br>
    <input type='button' onclick="mage.setForm()" name='submit' value='Submit'>
</form>

<script>
    CKEDITOR.replace('cmsPages[content]');
</script>