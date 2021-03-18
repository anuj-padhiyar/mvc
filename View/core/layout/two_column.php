<html>
    <head>
        <title>Home(2)</title>
    </head>
    <body>
    <table border=1 width="100%">
        <tbody>
            <tr>
                <td height="100px" colspan="3">
                    <?php echo $header = $this->getChild('header')->toHtml(); ?>
                </td>
            </tr>
            <tr>
                <td height="500px" width="150px">
                    <?php echo $left = $this->getChildren()['left']->toHtml(); ?> 
                </td>
                <td>
                    <?php
                        echo $this->createBlock('Block\Core\Layout\Message')->toHtml(); 
                        echo $this->getChild('content')->toHtml();
                    ?>
                </td>
                <td width="150px">
                    <?php echo $right = $this->getChildren()['right']->toHtml(); ?>
                </td>  
            </tr>
            <tr>
                <td height="100px"colspan="3">
                    <?php echo $this->getChild('footer')->toHtml(); ?>
                </td>
            </tr>
        </tbody>
</table>
    </body>
</html>


