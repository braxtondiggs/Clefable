<?php
$title = "";
$path = $filename = $title;
echo $url_path."$";
if (isset($site)) {
}
?>
<div class="validate_errors alert-error" style="display:none;"></div>
<form id="page" class="formular" method="post" action="<?php echo base_url("app/page/submit/" . $site->sid);?>">
    <div class="jQTabs">
	<ul>
	    <li>
		<a href="#tabs-1">
		    <span class="user cmsicon"></span>Integration
		</a>
	    </li>
	    <li>
		<a href="#tabs-2">
		    <span class="shareperm cmsicon"></span>SEO and Meta
		</a>
	    </li>
	</ul>
   	<div id="tabs-1" class="Form_Block">
	    <div class="form-item">
		<label for="title">Page Title:</label>
		<input id="title" name="title" type="text" value="<?= $title;?>" class="validate[required] text-rounded txt-xl" />
	    </div>
	    <div class="form-item">
		<label for="filename">File Name:</label>
		<input id="filename" name="filename" type="text" value="<?= $filename;?>" class="validate[required] text-rounded txt-xl" />
	    </div>
	    <div class="form-item">
		<label for="path">File Path:</label>
		<input id="path" name="path" type="text" value="<?= $path;?>" class="validate[required] text-rounded txt-xl" disabled="disabled"/>
	    </div>
	    <p>&nbsp;</p>
	    <h3>There is more to come here!! We promise!!</h3>
	</div>
	<div id="tabs-2">
	    <h3>This feature is still <strong>alpha testing</strong>. We are working hard to get this up and running!</h3>
	</div>
</div>
<p>&nbsp;</p>
<p><a href="#" class="button save_page"><span class="save cmsicon"></span>Save Page Settings</a></p>
</form>