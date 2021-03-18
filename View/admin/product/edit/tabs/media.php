<?php $media = $this->getMedia(); ?>

<h1>Product Media</h1>
<form id="form" action="<?php echo $this->getUrl()->getUrl('media'); ?>" enctype="multipart/form-data" method="POST">
    <table class="grid">
        <tr>
            <td colspan="5"></td>
            <td><input type="button" onclick="mage.setForm()" name="update" value="update"></td>
            <td><input type="button" onclick="mage.setForm()" name="remove" value="Remove"></td>
        </tr>
        <tr class="gridtr">
            <th class="gridth">$value</th>
            <th class="gridth">Label</th>
            <th class="gridth">Small</th>
            <th class="gridth">Thumb</th>
            <th class="gridth">Base</th>
            <th class="gridth">Gallery</th>
            <th class="gridth">Remove</th>
        </tr>
        <?php foreach($media as $key=>$value){ ?>
            <tr class="gridtr">
                <td class="gridtd"><image src="<?php echo $value['image']; ?>" height="100" width="100"></td>
                <td class="gridtd"><input type="text" name="label[<?php echo $value['mediaId'] ?>]" value="<?php echo $value['label'];?>"></td>		
                <td class="gridtd"><input type="radio" name="small" value="<?php echo $value['mediaId'] ?>" <?php if($value['small'])echo "checked";?>></td>
                <td class="gridtd"><input type="radio" name="thumb" value="<?php echo $value['mediaId'] ?>" <?php if($value['thumb'])echo "checked";?>></td>
                <td class="gridtd"><input type="radio" name="base" value="<?php echo $value['mediaId'] ?>" <?php if($value['base'])echo "checked";?>></td>
                <td class="gridtd"><input type="checkbox" name="gallery[<?php echo $value['mediaId'] ?>]" <?php if($value['gallery'])echo "checked";?>></td>
                <td class="gridtd"><input type="checkbox" name="delete[<?php echo $value['mediaId'] ?>]"></td>
            </tr>
        <?php } ?>
    </table><br><br>
    <input type="file" name="imagefile">
    <input type="button" name="image" onclick="mage.setForm()" value="Upload">
</form>