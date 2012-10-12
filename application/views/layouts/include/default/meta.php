<?php if (!isset($css)) {$css = array();}if (!isset($js)) {$js = array();}?>
<?php echo meta('description', 'CymbitCMS is a FREE hosted content management system that\'s actually easy to use, fast to setup and doesn\'t require programming skills.');?>
<?php echo meta('keywords', 'cms, content management system, hosted, web app, easy, free'); ?>
<?php echo link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
<title><?php echo $template['title']; ?> &raquo; CymbitCMS</title>
<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
<?php echo $template['metadata']; ?>
<?php ($assets == "app")?include('assets_app.php'):include('assets.php'); ?>
<?php //Assets::clear_cache(); ?>