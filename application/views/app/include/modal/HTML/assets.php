<div id="asset_container">
	<div id="assest_manager" style="float:left;width: 20.5%;padding:1.5% 0 1.5% 1.5%;min-height:400px;overflow: hidden;">
		<div id="manager" style="overflow-y: scroll;height:90%;"></div>
	</div>
	<div id="asset_body" style="float:left;width:75.5%;padding: 1.5% 0px 1.5% 1%;">
		<div id="ab_top" style="border-bottom: 2px dotted #CCC;padding-bottom: 5px;margin: 0 16px 5px 0;">Create New: <a href="#" class="">New Folder</a> | <a href="#" class="">New Image</a></div>
		<div id="assets" style="overflow-x: hidden;overflow-y: scroll;height:90%;">
        </div>
        <div id="asset_helper">
		<p class="asset_helper_title">
			<span class="img_title"></span>
		</p>
		<a id="asset_img_src" target="_blank">view full size in new window</a>
		<p class="size">Size: <span class="img_size"></span> (<span class="img_width"></span>x<span class="img_height"></span>)</p>
		<div class="right">
			<a href="<?= base_url('app/ftp/save_file/' . $sid); ?>" class="btn medium btn-danger edit-imgbtn" title="Edit Image" style="margin-right:6px;">Edit</a>
			<a href="<?= base_url('app/')?>" class="btn medium btn-primary ajax-action" title="Delete Image">Delete</a>
		</div>
	</div>
</div>