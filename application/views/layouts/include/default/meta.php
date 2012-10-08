<?php if (!isset($css)) {$css = array();}if (!isset($js)) {$js = array();}?>
<?php echo meta('description', 'CymbitCMS is a FREE hosted content management system that\'s actually easy to use, fast to setup and doesn\'t require programming skills.');?>
<?php echo meta('keywords', 'cms, content management system, hosted, web app, easy, free'); ?>
<?php echo link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
<title><?php echo $template['title']; ?> &raquo; CymbitCMS</title>
<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
<?php echo $template['metadata']; ?>
<?php Assets::css(array_merge(array('reset.css', 'typography.css', 'jquery-ui-1.8.10.custom.css', 'base.css'), (array)$css)); ?>
<?php Assets::js(array_merge(array('jquery.min.js', 'jquery-ui.min.js', 'global.js'), (array)$js));?>
<?php //Assets::clear_cache(); ?>