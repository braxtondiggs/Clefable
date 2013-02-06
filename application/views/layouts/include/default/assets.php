<?php $css = array('reset.css', 'typography.css', 'jquery-ui-1.8.10.custom.css', 'base.css', 'rpx.css', 'oneall.css', 'validator/validationEngine.jquery.css'); ?>
<?php $js = array('jquery.min.js', 'jquery-ui.min.js', 'global.js', 'validator/jquery.validationEngine-en.js', 'validator/jquery.validationEngine.js');?>


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