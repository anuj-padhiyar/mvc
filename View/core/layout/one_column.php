<html>
	<head>
		<title>Home(1)</title>
		<script type="text/javascript" src="<?php echo $this->baseUrl('Skin/Admin/Js/jquery.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo $this->baseUrl('Skin/Admin/Js/mage.js'); ?>"></script>
		<script type="text/javascript" src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
	</head>
	<body>
		<div id="gridHtml">
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tbody>
			<tr>
				<td width = "100%" colspan = "3">
					<?php echo $this->getHeader()->toHtml();?>
				</td>
			</tr>
			<tr>
				<td style = 'text-align:left' width = "100%">
					<?php
						echo $this->createBlock('Block\Core\Layout\Message')->toHtml();
						echo $this->getChild('content')->toHtml();
					?>
				</td>
			</tr>
			<tr>
				<td style = 'text-align:center' height="100px" colspan = "3">
					<?php echo $this->getChild('footer')->toHtml();?>
				</td>
			</tr>
		   </tbody>
		</table>
	</body>
</html>
