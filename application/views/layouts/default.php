<!DOCTYPE html>
<html>
	<head>
		<?php echo meta('description', 'CymbitCMS is a FREE hosted content management system that\'s actually easy to use, fast to setup and doesn\'t require programming skills.');?>
		<?php echo meta('keywords', 'cms, content management system, hosted, web app, easy, free'); ?>
		<?php echo link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
		<title><?php echo $template['title']; ?> &raquo; CymbitCMS</title>
		<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
		<?php echo $template['metadata']; ?>
		<?php echo link_tag('css/main.css');?><!--codaslider/jquery.easing.js,codaslider/jquery.slider.js-->
		<?php Assets::css('main.css'); ?>
		<script src="https://www.google.com/jsapi?key=ABQIAAAAOErmLAf3Vk8rUjZYy2mskhQAqmNn-Dq8eRxLgecrCu3q_XmBphRz6IwqvMoWSfEbeRAWn76v_h5qtQ" type="text/javascript"></script>
		<script type="text/javascript">
			google.load("jquery", "1");
			google.load("jqueryui", "1");
		</script>
		<?php Assets::js('global.js');?>
	</head>
	<body>
		<h1><?php echo $template['title']; ?></h1>
		<?php echo $template['body']; ?>
                Template Works
	</body>
</html>