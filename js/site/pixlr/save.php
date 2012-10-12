<?php
if (!empty($_GET)) {
	require_once('../../../include/functions.php');
	$img_UID = UID(11);
	$img_file = $_GET['image'];
	$path_parts = pathinfo($_GET['title']);
	$temp_loc = '../../uploads/img_tmp/'.$_GET['SID'].parse_url(substr($_GET['title'], 0, strrpos($_GET['title'], "/")), PHP_URL_PATH);	
	if(!is_dir($temp_loc)) {
		if (!mkdir($temp_loc, 0777)) {
    		die('Failed to create folders...');
		}
	}
	if(is_dir($temp_loc)) {
		if (!copy($img_file, $temp_loc.'/'.$path_parts['basename'])) {
    		echo "failed to copy $img_file...\n";
		}
	}
	?>
	<script type="text/javascript">
	    	if(parent){
				parent.pixlr_image(<?php echo "'".$img_UID."', '".$_GET['title']."', 'http://cymbit.com/site/uploads/img_tmp/".$_GET['SID'].parse_url(substr($_GET['title'], 0, strrpos($_GET['title'], "/")), PHP_URL_PATH)."/".$path_parts['basename']."'";?>);
				parent.pixlr.overlay.hide();
            }
     </script>
<?php 
}else {
	die('hacking attempt logged!');
}
?>
