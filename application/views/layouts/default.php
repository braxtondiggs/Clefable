<!DOCTYPE html>
<html>
	<head>
		<?php echo meta('description', 'CymbitCMS is a FREE hosted content management system that\'s actually easy to use, fast to setup and doesn\'t require programming skills.');?>
		<?php echo meta('keywords', 'cms, content management system, hosted, web app, easy, free'); ?>
		<?php echo link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
		<title><?php echo $template['title']; ?> &raquo; CymbitCMS</title>
		<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
		<?php echo $template['metadata']; ?>
		<?php echo link_tag(array('css/mystyles.css', 's.css'));?>
	</head>
	<body>
		<?php echo br(3);
		//echo link_tag('css/mystyles.css');?>
		<h1><?php echo $template['title']; ?></h1>
		<?php echo $template['body']; ?>
                Template Works
	</body>
</html>