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
		<?php include('include/default/header/menu_app.php'); ?>
		<div id="container">
		    <iframe id="frame_content" frameborder="0" scrolling="no" src="<?= base_url('app/sitebuilder/source/' . $this->uri->segment(4) . '/' . $this->uri->segment(5))?>"></iframe>
		</div>
	</body>
</html>