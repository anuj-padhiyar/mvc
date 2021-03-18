<html>
    <head>
        <title>Home(3)</title>
        <script type="text/javascript" src="<?php echo $this->baseUrl('Skin/Admin/Js/jquery.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo $this->baseUrl('Skin/Admin/Js/mage.js'); ?>"></script>
		<script type="text/javascript" src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>

    </head>
    <body>
        <table style="text-align:center" border = "0" cellspacing="0" cellpadding="0" width="100%">
            <tbody>
            <tr>
                <td colspan="3">
                    <?php echo $header = $this->getHeader()->toHtml(); ?>
                </td>
            </tr>
            <tr>
                <td class="leftBar" height="400px" width="160px">
                    <?php echo $left = $this->getLeft()->toHtml(); ?> 
                </td>
                <td height="400px"> 
                        <?php echo $content = $this->getContent()->toHtml(); ?> 
                </td>
                <td class="leftBar" height="400px" width="160px">
                    <?php echo $right = $this->getRight()->toHtml(); ?>
                </td>
            </tr>
            <tr>
                <td colspan="3" height="100px"> 
                    <?php echo $footer = $this->getFooter()->toHtml(); ?>
                </td>
            </tr>
        </table>
    </body>
</html>



