<?php
    $account_type = $this->session->userdata('account_type');
    $url = "";
    $port = 21;
    $keyword = "cms-editable";
    $has_key = 0;
    $extra_password  = $ftp_secure = $mode = $path = $ftp_password = $ftp_user = $server = $name = $url;
    if (isset($site)) {
	$url = $site->url;
	$name = $site->name;
	$server = $site->server;
	$ftp_user = $site->ftp_username;
	$ftp_password = $site->ftp_password;
	$path = $site->path;
	$keyword = $site->keyword;
	$mode = $site->ftp_mode;
	$port = $site->ftp_port;
	$ftp_secure = $site->ftp_secure;
	$has_key = $site->has_key;
	$extra_password = $site->extra_password;
	$is_new = FALSE;
	$id = $site->sid;
    }else {
	$id = "";
    }
?>
<div class="validate_errors alert-error" style="display:none;"></div>
<form id="site" class="formular" method="post" action="<?php echo base_url("app/sites/submit/".$id);?>">
    <div class="jQTabs">
	<ul>
	    <li><a href="#tabs-1">Settings</a></li>
	    <li><a href="#tabs-2">Advanced</a></li>
	    <!--<li><a href="#tabs-3">WYSIWYG</a></li>-->
	</ul>
	<div id="tabs-1" class="Form_Block">
	    <div class="form-item" >
		<label for="url">
		    <span>*</span>&nbsp;Site URL&nbsp;
		</label>
		<input id="url" name="url" type="text" value="<?= $url;?>" class="validate[required,custom[url]] text-rounded txt-xxl" />
		<p>Example: http://www.examplesite.com/</p>
	    </div>
	    <div class="form-item">
		<label for="site-name">
		    <span>*</span>&nbsp;Site Name&nbsp;
		</label>
		<input id="site-name" name="site-name" type="text" value="<?= $name;?>" class="validate[required] text-rounded txt-xl" />
		<p>Example: Example Company Site</p>
	    </div>
	    <div class="form-item">
		<label for="address">
		    <span>*</span>&nbsp;FTP Address&nbsp;
		</label>
		<input id="address" name="address" type="text" value="<?= $server;?>" class="validate[required] text-rounded txt-xl" />
		<p>Example: examplesite.com</p>
	    </div>
	    <div class="form-item">
		<label for="user"><span>*</span>
		    &nbsp;FTP Username&nbsp;
		</label>
		<input id="user" name="user" type="text" value="<?= $ftp_user;?>" class="validate[required] text-rounded txt-xl" />
	    </div>
	    <div class="form-item" style="margin-bottom:20px;">
		<?php if (!$is_new) {?>
		    <div>
			<label style="margin-bottom:20px;">
			    Change FTP Password&nbsp;
			</label>
			<input id="changepass" name="changepass" type="checkbox" value="true" style="margin-left:20px;">
			<label for="changepass" style="display:inline;">
			    Change Password
			</label>
		    </div>
		<? }?>
		<div style="margin-top:15px;<?= (!$is_new)?'display:none;':''; ?>">
		    <label for="password">
			<span>*</span>&nbsp;FTP Password&nbsp;
		    </label>
		    <input id="password" name="password" type="password" value="<?= $ftp_password; ?>" class="validate[required] text-rounded txt-xl" />
		    <div style="margin: 15px 0;">
			<a href="<?= base_url('app/ftp/test_connection'); ?>" class="button test_ftp left" style="margin-right:15px;">Test</a>
			<span style="margin-top: 9px;float: left;">
			    <img id="ajax-loading" src="<?= base_url('css/images/indicator.gif'); ?>" class="ftp-alert" style="display:none;">
			    <span id="ftp-msg"></span>
			</span>
		    </div>
		</div>
	    </div>
	    <div style="clear:both;"></div>
	    <div class="form-item">
		<label for="path">
		    <span>*</span>&nbsp;Set the path to your homepage on your FTP Server&nbsp;
		</label>
		<input id="path" name="path" type="text" value="<?= $path; ?>" class="validate[required] text-rounded txt-xl" />
		<div style="display: inline;">
		    <a href="<?= base_url('app/ftp/browse_index');?>" class="button asjax-action browse-site"><span class="docarrow cmsicon"></span>Browse</a>
		</div>
		<p>
		    Select your homepage on your FTP server here, so that we can correctly map your web files to your ftp files.
		</p>
	    </div>
	</div>
	<div id="tabs-2" class="Form_Block">
	    <fieldset>
        	<legend>Site Information</legend>
		<div class="form-item">
		    <label for="keyword">
			<span>*</span>&nbsp;Editable CSS Class Name
		    </label>
		    <input id="keyword" name="keyword" value="<?= $keyword;?>" type="text" class="validate[required, onlyLetterNumber] text-rounded txt-xl" />
		    <p>
			This CSS class determines which areas of your site are editable (the default is 'cms-editable')
		    </p>
        	</div>
            <!--<div class="form-item">
		    <label for="CSS">
			Content Style Sheet URL
		    </label>
		    <input id="CSS" name="CSS" type="text" value="<?php echo $CSS;?>" class="text-rounded txt-xl" />
		    <p>
			Styles from this stylesheet will be added to the styles<br />
			dropdown in the Cymbit HTML editor.
		    </p>
        	</div>-->
	    </fieldset>
	    <p>&nbsp;</p>
	    <fieldset>
        	<legend>Publish/Upload Settings</legend>
		<div class="form-item left" style="margin-right: 65px;margin-bottom:10px;">
		    <label for="mode">
			&nbsp;FTP Publishing Method
		    </label>
		    <select id="mode" name="mode" class="text-rounded">
			<option value="Passive" <?= ($mode == 'Passive' ? 'selected="selected"':'');?>>Passive</option>
			<option value="Active" <?= ($mode == 'Active' ? 'selected="selected"':'');?>>Active</option>
		    </select>
		    <p>(FTP files or XML)</p>
		</div>
		<div class="form-item left" style="margin-right: 75px;">
		    <label for="Port">
			<span>*</span>&nbsp;FTP Port
		    </label>
		    <input id="port" name="port" type="text" value="<?= $port;?>" class="validate[required,custom[integer]] text-rounded txt-xs" />
		    <p>default: 21</p>
        	</div>
		<br class="clr" />
		<div class="form-item">
		    <label style="margin-bottom:10px;">
			&nbsp;SFTP
		    </label>
		    <input id="SFTP" name="SFTP" type="checkbox" value="true" <?= ($ftp_secure == 1 ? 'checked="checked"':'');?> />
		    <label for="SFTP" style="display:inline;font:normal 14px Arial, Helvetica, sans-serif;">SFTP</label>
        	</div>
		<p>&nbsp;</p>
		<div class="form-item" style="margin-bottom:20px;">
		    <div>
			<label style="margin-bottom:10px;">
			    &nbsp;Publish Passkey
			</label>
			<input id="passkey" name="passkey" type="checkbox" value="true" <?= ($has_key == 1 ? 'checked="checked"':'');?> style="margin-left:20px;">
			<label for="passkey" style="display:inline;font:normal 14px Arial, Helvetica, sans-serif;">
			    Use Publish Passkey
			</label>
		    </div>
		    <div <?= ($has_key != 1 ? 'style="display:none;"':''); ?>>
			<input id="passkey-value" name="passkey-value" type="password" value="<?= $extra_password;?>" class="validate[required] text-rounded txt-xs" style="margin-left:20px;" />
		    </div>
		    <p>&nbsp;</p>
		    <p>We use the passkey to encrypt your FTP information, but we do NOT store it. Every time you want to publish a page, we ask for your passkey to decrypt the FTP info. Bottom line: your data is safe.</p>
        	</div>
	    </fieldset>
	</div>
    <!--<div id="tabs-3" class="Form_Block">
    	<h6>WYSIWYG Toolbar</h6>
    	<ul id="toolbar1" class="droppable btn_holder"><?php// echo $WYSIWYG1;?></ul>
    	<p style="padding:7px 0 0 0;">This field controls the buttons that show up for both <strong>Text</strong> and <strong>HTML</strong> areas in the WYSIWYG Editor</p>-->
    	<!--<h4>WYSIWYG Toolbar 2</h4>
        <div id="toolbar2" class="droppable"><?php //echo $WYSIWYG2;?></div>
    	<p>This field controls the buttons that show up for <strong>HTML</strong> areas only in the WYSIWYG Editor</p>
    	<p>&nbsp;</p>-->
        <!--<div style="float:left;">
        	<h6>Editor Background Color</h6>
        	<input id="Color" name="Color" type="text" value="<?php //echo $WColor;?>" class="validate[required] text-rounded txt-xl color"/> 
        <p style="padding:7px 0 0 0;">This field controls the background color of<br /> the WYSIWYG Editor</p>
        </div>
        <div class="colorwheel" style="float:left;"></div>
       <div style="clear:both;"></div>
    </div>-->
    </div>
    <p>&nbsp;</p>
    <p>
	<a href="#" class="submit button">
	    <span class="save cmsicon"></span>Save Site Settings
	</a>
    </p>
</form>
<script type="text/javascript">
	$(function() {
	    $('#passkey, #changepass').click(function() {
		$(this).parent('div').next('div').toggle().children('input[type="text"]').val("");
	    });
	    $('.test_ftp').click(function() {
		$('.ftp-alert').show();
		$('#ftp-msg').hide();
		 $.ajax($(this).attr('href'), {
		    type: "POST",
		    data: $(".formular").serialize(),
		    success: function(data) {
			$('.ftp-alert').hide();
			$('#ftp-msg').show().html(data.output);
		    }
		 });
		return false;
	    });
	    $('.browse-site').click(function() {
		$('#dialog-buttonless').dialog({ title: "FTP Browser" }).dialog('open').children('#dialog-buttonless-body').html('<div id="fileTree"></div>');
		var server = $('#address').val();var user = $('#user').val();var pass = $('#password').val();var path = $('#path').val();//From Formurlencode
		$('#fileTree').fileTree({ root: '/', script: '<?= base_url('app/ftp/browse_index'); ?>', server: server, user: user, password: pass, path: path }, function(file) { 
			$('#path').val(file);//selected file
			$('#dialog-buttonless').dialog("close");
		});
		return false;
	    });
	});
</script>