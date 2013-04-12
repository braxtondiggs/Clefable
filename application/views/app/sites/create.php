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
                             <div class="inner-spacer"> 
									        <!-- content goes here -->
										<div class="alert alert-error adjusted alert-block" style="display:none;"><h4 class="alert-heading"><strong>Error:</strong></h4>
											<p>&nbsp;</p>
											</div>
												<form id="wizard" class="themed formular" method="post" action="<?= base_url("app/sites/submit/");?>">
																							
													<div id="wizard_name">
														
														<!-- wizard steps -->
														<ul class="bwizard-steps">
														  	<li>
														  		<span class="label badge-inverse">1</span>
														  		<a href="#inverse-tab1" data-toggle="tab">Step 1 &raquo; Site Info</a>
														  	</li>
															<li>
																<span class="label badge-inverse">2</span>
																<a href="#inverse-tab2" data-toggle="tab">Step 2 &raquo; FTP Info</a>
															</li>
															<li>
																<span class="label badge-inverse">3</span>
																<a href="#inverse-tab3" data-toggle="tab">Step 3 &raquo; Homepage</a>
															</li>
															<li>
																<span class="label badge-inverse">4</span>
																<a href="#inverse-tab4" data-toggle="tab">Step 4 &raquo; Advanced</a>
															</li>
														</ul>
														<!-- end wizard steps -->
														
														<div class="tab-content">
															<!-- step 1-->
														    <fieldset class="tab-pane" id="inverse-tab1">
																<div class="control-group">
																	<label class="control-label" for="url"><span>*</span>&nbsp;Site URL&nbsp;</label>
																	<div class="controls">
																		<input id="url" name="url" type="text" class="validate[required,custom[url]] text-rounded txt-xl span12" />
																		<p class="help-block">Example: http://www.examplesite.com/</p>
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="site-name"><span>*</span>&nbsp;Site Name&nbsp;</label>
																	<div class="controls">
																		<input id="site-name" name="site-name" type="text" class="validate[required] text-rounded txt-xl span12" />
																		<p class="help-block">Example: Example Company Site</p>
																	</div>
																</div>
														    </fieldset>
														    <!-- step 2-->
														    <fieldset class="tab-pane" id="inverse-tab2">
															<div class="control-group">
																<label class="control-label" for="address"><span>*</span>&nbsp;FTP Address&nbsp;</label>
																<div class="controls">
																	<input id="address" name="address" type="text" class="validate[required] text-rounded txt-xl span12" />
																	<p class="help-block">Example: examplesite.com</p>
																</div>
															</div>
															<div class="control-group">
																<label class="control-label" for="user"><span>*</span>&nbsp;FTP Username&nbsp;</label>
																<div class="controls">
																	<input id="user" name="user" type="text" class="validate[required] text-rounded txt-xl span12" />
																	<p class="help-block">Example: examplesite.com</p>
																</div>
															</div>
															    <div class="control-group">
																    <label class="control-label" for="password"><span>*</span>&nbsp;FTP Password&nbsp;</label>
																    <div class="controls">
																	<input id="password" name="password" type="password" class="validate[required] text-rounded txt-xl span12" />
																	<div style="margin: 15px 0;height: 25px;">
																	    <a href="<?= base_url('app/ftp/test_connection'); ?>" title="Test Connection" class="btn btn-primary test_ftp left">Test Connection</a>
																	    <span style="margin: 4px 0 0 9px;float: left;">
																	       <img id="ajax-loading" src="<?= base_url('css/images/indicator.gif'); ?>" class="ftp-alert" style="display:none;">
																	       <span id="ftp-msg"></span>
																	    </span>
																	</div>
																    </div>
															    </div>
																								    </fieldset>
														    <!-- step 3-->
														    <fieldset class="tab-pane" id="inverse-tab3">
																<div class="control-group">
																<label class="control-label" for="user"><span>*</span>&nbsp;Set the path to your homepage on your FTP Server&nbsp;</label>
																<div class="controls">
																    <div class="input-append">
																	<input id="path" name="path" type="text" class="validate[required] text-rounded txt-xl span12" />
																	 <div class="btn-group">
																	    <button type="button" href="<?= base_url('app/ftp/browse_index');?>" class="btn medium btn-primary ajax-action browse-site">Browse</button>
																	 </div>
																	<p class="help-block"> Select your homepage on your FTP server here, so that we can correctly map your web files to your ftp files.</p>
																    </div>
																</div>
															    </div>
														    </fieldset>
														    <!-- step 4-->
														    <fieldset class="tab-pane" id="inverse-tab4">
																<div class="control-group">
																	<label class="control-label" for="mode"><span>*</span>&nbsp;FTP Publishing Method&nbsp;</label>
																	<div class="controls">
																	    <select id="mode" name="mode" class="text-rounded span12 with-search">
																		<option value="Passive" selected="selected">Passive</option>
																		<option value="Active">Active</option>
																	    </select>
																	    <p class="help-block">(FTP files or XML)</p>
																	</div>
																    </div>
																    <div class="control-group">
																	<label class="control-label" for="keyword"><span>*</span>&nbsp;Editable CSS Class Name&nbsp;</label>
																	<div class="controls">
																	    <input id="keyword" name="keyword" value="content-editable" type="text" class="validate[required, onlyLetterNumber] text-rounded txt-xl span12" />
																	    <p class="help-block">This CSS class determines which areas of your site are editable (the default is 'cms-editable')</p>
																	</div>
																    </div>
																    <div class="control-group">
																	<label class="control-label" for="port"><span>*</span>&nbsp;FTP Port&nbsp;</label>
																	<div class="controls">
																	    <input id="port" name="port" type="text" value="21" class="validate[required,custom[integer]] text-rounded txt-xs span12" />
																	    <p class="help-block">Default: 21</p>
																	</div>
																    </div>
														    </fieldset>
														    <!-- wizard -->
														    <div class="form-actions wizard">
														    	<div class="span6 hidden-phone">
														    		<strong class="" style="margin-right: 5px; line-height: 25px; float:left;">Start</strong>
														    		<strong class="" style="margin-left: 5px; line-height: 25px;">Finish</strong>
																	<div id="bar" class="progress progress-info slim" style="margin-bottom:0;">
																		<div class="bar"></div>
																	</div>
														    	</div>

																<div class="span6">
															    	<ul style="list-style: none;">
																		<li class="previous">
																			<a href="javscript:void(0);" title="Previous" class="btn btn-danger wizard_previous">Previous</a>
																		</li>
																		<li class="next">
																			<a href="javascript:void(0);" title="Next" class="btn btn-primary wizard_next">Next</a>
																		</li>
															    	</ul>
																</div>

															</div>
														</div>
															
													</div>
									
												</form>
										    </div>
			     
										    <!-- end content-->
									    </div>
                        </article>
                    </div>
            </section>
        </div>
</div>
<?php $this->load->view('app/include/modal/buttonless'); ?>

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