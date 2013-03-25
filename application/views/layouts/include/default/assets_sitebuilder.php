<?php $css = array('reset.css', 'typography.css', 'jquery-ui-1.8.10.custom.css', 'app/sitebuilder.css', 'app/extruder/mbExtruder.css', 'validator/validationEngine.jquery.css', 'gritter/jquery.gritter.css','app/breadcrumb/breadcrumb.css', 'app/menu/menu.css', 'app/filetree/jqueryFileTree.css', 'app/ibutton/jquery.ibutton.min.css'); ?>
<?php $js = array('jquery.min.js', 'jquery-ui.min.js', 'app/global.js', 'app/application.js', 'validator/jquery.validationEngine-en.js', 'validator/jquery.validationEngine.js', 'app/breadcrumb/jquery.jBreadCrumb.js', 'jquery.gritter.min.js', 'app/jquery.livequery.min.js', 'jquery.scrollTo-min.js', 'app/FileTree/jqueryFileTree.js', 'app/menu/jquery.menu.js', 'app/pixlr/pixlr.js', 'jquery.easing.js', 'app/jquery.ibutton.min.js', 'app/flexcroll.js');?>


<?php
if (isset($css)) {
    foreach ($css as $css_file) {
	echo '<link rel="stylesheet" href="'. base_url() .'css/'.$css_file .'">';
    }
}
?>

<?php
if (isset($js)) {
    foreach ($js as $js_file) {
	echo '<script type="text/javascript" src="' . base_url() .'js/' . $js_file .'"></script>';
    }
}
?>