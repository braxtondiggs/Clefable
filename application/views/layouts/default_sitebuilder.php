<?php
include('include/config.php');
$assets = "sitebuilder";?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('include/default/meta.php');?>
	</head>
	<body>
		<?php //include('include/default/top_menu.php'); ?>
		<?php include('include/default/impersonate.php'); ?>
		<?php include('include/default/header/editor_app.php'); ?>
		<div id="container">
			<?= $template['body']; ?>
		</div>
	</body>
</html>