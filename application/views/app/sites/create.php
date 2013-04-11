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
												<form id="wizard" class="themed formular">
																							
													<div id="wizard_name">
														
														<!-- wizard steps -->
														<ul class="bwizard-steps">
														  	<li>
														  		<span class="label badge-inverse">1</span>
														  		<a href="#inverse-tab1" data-toggle="tab">Step 1</a>
														  	</li>
															<li>
																<span class="label badge-inverse">2</span>
																<a href="#inverse-tab2" data-toggle="tab">Step 2</a>
															</li>
															<li>
																<span class="label badge-inverse">3</span>
																<a href="#inverse-tab3" data-toggle="tab">Step 3</a>
															</li>
															<li>
																<span class="label badge-inverse">4</span>
																<a href="#inverse-tab4" data-toggle="tab">Step 4</a>
															</li>
															<li>
																<span class="label badge-inverse">5</span>
																<a href="#inverse-tab5" data-toggle="tab">Step 5</a>
															</li>
															<li>
																<span class="label badge-inverse">6</span>
																<a href="#inverse-tab6" data-toggle="tab">Step 6</a>
															</li>
														</ul>
														<!-- end wizard steps -->
														
														<div class="tab-content">
															<!-- step 1-->
														    <fieldset class="tab-pane" id="inverse-tab1">
																<div class="control-group">
																	<label class="control-label" for="url"><span>*</span>&nbsp;Site URL&nbsp;</label>
																	<div class="controls">
																		<input id="url" name="url" value="http://google.com" type="text" class="validate[required,custom[url]] text-rounded txt-xl span12" />
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
																	<label class="control-label" for="s1">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s1">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s2">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s2">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s3">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s3">
																	</div>
																</div>
														    </fieldset>
														    <!-- step 3-->
														    <fieldset class="tab-pane" id="inverse-tab3">
																<div class="control-group">
																	<label class="control-label" for="s4">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s4">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s5">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s5">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s6">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s6">
																	</div>
																</div>
														    </fieldset>
														    <!-- step 4-->
														    <fieldset class="tab-pane" id="inverse-tab4">
																<div class="control-group">
																	<label class="control-label" for="s7">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s7">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s8">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s8">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s9">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s9">
																	</div>
																</div>
														    </fieldset>
														    <!-- step 5-->
														    <fieldset class="tab-pane" id="inverse-tab5">
																<div class="control-group">
																	<label class="control-label" for="s10">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s10">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s11">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s11">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s12">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s12">
																	</div>
																</div>
														    </fieldset>
														    <!-- step 6-->
														    <fieldset class="tab-pane" id="inverse-tab6">
																<div class="control-group">
																	<label class="control-label" for="s13">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s13">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s14">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s14">
																	</div>
																</div>
																<div class="control-group">
																	<label class="control-label" for="s15">Sample Input</label>
																	<div class="controls">
																		<input type="text" class="span12" id="s15">
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
																			<button class="btn medium btn-danger">
																				Previous
																			</button>
																		</li>
																		<li class="next">
																			<a href="" title="Cancel" class="btn btn-primary next">Next</a>
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