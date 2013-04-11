<?php $site = $site[0]; ?>
<div id="page-content">
    <!-- page header -->
    <h1 id="page-header"><?= $template['title']; ?></h1>
    <p>&nbsp;</p>
    	<div class="fluid-container">
            <!-- widget grid -->
            <section id="widget-grid" class="">
                    
                    <!-- row-fluid -->
                    <div class="row-fluid">
                        <article class="span12">
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
		    <div class="alert alert-error adjusted alert-block" style="display:none;"><h4 class="alert-heading"><strong>Error:</strong></h4>
		    <p>&nbsp;</p>
		    </div>
		    
		    <form id="site" class="formular form-horizontal themed" method="post" action="<?php echo base_url("app/sites/submit/".$id);?>">
			<div class="inner-spacer">
			    <ul id="myTab" class="nav nav-tabs default-tabs">
				<li class="active">
				    <a href="#s1" data-toggle="tab"><span class="left cus-anchor"></span>&nbsp;Settings</a>
				</li>
				<li>
				    <a href="#s2" data-toggle="tab"><span class="left cus-star-2"></span>&nbsp;Advanced</a>
				</li>
			    </ul>
			     
			    <div id="myTabContent" class="tab-content">
				<div class="tab-pane fade in active" id="s1">
				    <fieldset>
					<div class="control-group">
						<label class="control-label" for="url"><span>*</span>&nbsp;Site URL&nbsp;</label>
						<div class="controls">
							<input id="url" name="url" type="text" value="<?= $url;?>" class="validate[required,custom[url]] text-rounded txt-xl span12" />
							<p class="help-block">Example: http://www.examplesite.com/</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="site-name"><span>*</span>&nbsp;Site Name&nbsp;</label>
						<div class="controls">
							<input id="site-name" name="site-name" type="text" value="<?= $name;?>" class="validate[required] text-rounded txt-xl span12" />
							<p class="help-block">Example: Example Company Site</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="address"><span>*</span>&nbsp;FTP Address&nbsp;</label>
						<div class="controls">
							<input id="address" name="address" type="text" value="<?= $server;?>" class="validate[required] text-rounded txt-xl span12" />
							<p class="help-block">Example: examplesite.com</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" for="user"><span>*</span>&nbsp;FTP Username&nbsp;</label>
						<div class="controls">
							<input id="user" name="user" type="text" value="<?= $ftp_user;?>" class="validate[required] text-rounded txt-xl span12" />
							<p class="help-block">Example: examplesite.com</p>
						</div>
					</div>
					<?php if (!$is_new) {?>
					<div class="control-group">
						<div class="controls">
							<label class="checkbox">
							    <input type="checkbox" id="changepass" name="changepass"  value="true">Change Password
							</label>
						</div>
					</div>
					<? }?>
					    <div class="control-group" style="<?= (!$is_new)?'display:none;':''; ?>">
						    <label class="control-label" for="password"><span>*</span>&nbsp;FTP Password&nbsp;</label>
						    <div class="controls">
							<input id="password" name="password" type="password" value="<?= $ftp_password; ?>" class="validate[required] text-rounded txt-xl span12" />
							<div style="margin: 15px 0;">
							    <a href="<?= base_url('app/ftp/test_connection'); ?>" title="Test Connection" class="btn btn-primary test_ftp left">Test Connection</a>
							    <span style="margin: 4px 0 0 9px;float: left;">
							       <img id="ajax-loading" src="<?= base_url('css/images/indicator.gif'); ?>" class="ftp-alert" style="display:none;">
							       <span id="ftp-msg"></span>
							    </span>
							</div>
						    </div>
					    </div>
					<div class="control-group">
					    <label class="control-label" for="user"><span>*</span>&nbsp;Set the path to your homepage on your FTP Server&nbsp;</label>
					    <div class="controls">
						<div class="input-append">
						    <input id="path" name="path" type="text" value="<?= $path; ?>" class="validate[required] text-rounded txt-xl span12" />
						     <div class="btn-group">
							<button type="button" href="<?= base_url('app/ftp/browse_index');?>" class="btn medium btn-primary ajax-action browse-site">Browse</button>
						     </div>
						    <p class="help-block"> Select your homepage on your FTP server here, so that we can correctly map your web files to your ftp files.</p>
						</div>
					    </div>
					</div>
					
				    </fieldset>
				</div>
				<div class="tab-pane fade in" id="s2">
				    <fieldset>
					<div class="control-group">
					    <label class="control-label" for="mode"><span>*</span>&nbsp;FTP Publishing Method&nbsp;</label>
					    <div class="controls">
						<select id="mode" name="mode" class="text-rounded span12 with-search">
						    <option value="Passive" <?= ($mode == 'Passive' ? 'selected="selected"':'');?>>Passive</option>
						    <option value="Active" <?= ($mode == 'Active' ? 'selected="selected"':'');?>>Active</option>
						</select>
						<p class="help-block">(FTP files or XML)</p>
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="keyword"><span>*</span>&nbsp;Editable CSS Class Name&nbsp;</label>
					    <div class="controls">
						<input id="keyword" name="keyword" value="<?= $keyword;?>" type="text" class="validate[required, onlyLetterNumber] text-rounded txt-xl span12" />
						<p class="help-block">This CSS class determines which areas of your site are editable (the default is 'cms-editable')</p>
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="port"><span>*</span>&nbsp;FTP Port&nbsp;</label>
					    <div class="controls">
						<input id="port" name="port" type="text" value="<?= $port;?>" class="validate[required,custom[integer]] text-rounded txt-xs span12" />
						<p class="help-block">Default: 21</p>
					    </div>
					</div>
					<!--<div class="control-group">
					    <div class="controls">
						<label class="checkbox">
						    <input type="checkbox" id="SFTP" name="SFTP"  value="true" <?= ($ftp_secure == 1 ? 'checked="checked"':'');?>>SFTP
						</label>
					    </div>
					</div>
					<div class="control-group">
					    <div class="controls">
						<label class="checkbox">
						    <input type="checkbox" id="passkey" name="passkey"  value="true" <?= ($has_key == 1 ? 'checked="checked"':'');?>>Publish Passkey
						</label>
					    </div>
					</div>
					<div <?= ($has_key != 1 ? 'style="display:none;"':''); ?>>
					    <div class="control-group">
						<label class="control-label" for="passkey-value"><span>*</span>&nbsp;Use Publish Passkey&nbsp;</label>
						<div class="controls">
						    <input id="passkey-value" name="passkey-value" type="password" value="<?= $extra_password;?>" class="validate[required] text-rounded txt-xs span12" />
						    <p class="help-block">We use the passkey to encrypt your FTP information, but we do NOT store it. Every time you want to publish a page, we ask for your passkey to decrypt the FTP info. Bottom line: your data is safe.</p>
						</div>
					    </div>
					</div>-->
				    </fieldset>
				</div>
			    </div>
			    <div class="form-actions" style="padding-left:0;">
				<a href="<?= base_url('app/sites/delete/confirm/' . $site->sid);?>" title="Delete Site" class="btn btn-danger left delete">Delete Site</a>
				<a href="<?= base_url('app')?>" title="Cancel" class="btn">Cancel</a>
				<a href="javascript:void(0);" title="Cancel" class="btn btn-primary submit">Save Changes</a>
			    </div>
			</div>
		    </form>
		    <script type="text/javascript">
			    $(function() {
				$('#passkey, #changepass').click(function() {
				    $(this).parents('div.control-group').next('div').toggle().children('input[type="text"]').val("");
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
				    $("#dash-modal").modal('show').width('400px').find('.modal-body').html('<div id="fileTree"></div>').css({'padding':'15px 0 5px 15px', 'overflow-y':'scroll', 'min-height': '400px'});
				    var server = $('#address').val();var user = $('#user').val();var pass = $('#password').val();var path = $('#path').val();//From Formurlencode
				    $('#fileTree').fileTree({ root: path.substring(0, path.lastIndexOf("/")), script: '<?= base_url('app/ftp/browse_file/index'); ?>', server: server, user: user, password: pass}, function(file) { 
					    $('#path').val(file);//selected file
					    $("#dash-modal").modal('hide');
				    });
				    return false;
				});
			    });
		    </script>
                        </article>
                    </div>
            </section>
        </div>
</div>
<?php $this->load->view('app/include/modal/buttonless'); ?>