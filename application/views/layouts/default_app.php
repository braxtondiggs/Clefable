<?php
include('include/config.php');
$assets = "app";$header=false;?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('include/default/meta.php');?>
	</head>
	<body>
		<body>
  	<!-- .height-wrapper -->
	<div class="height-wrapper">
		
		<!-- header -->
		<header>
			<?php if($this->session->userdata('impersonate')) { ?>
			<div class="alert adjusted alert-warning impersonate">
				<p><i class="cus-exclamation-octagon-fram"></i>You are currently in impersonate mode, <a href="<?= base_url('app/users/impersonate/deactivate/'.$this->session->userdata('identity_QID')); ?>" class="ajax-action">click here to return to your original account.</a></p>
			</div>
			<?php } ?>
			<!-- tool bar -->
			<div id="header-toolbar" class="container-fluid">
				<!-- .contained -->
				<div class="contained">
					
					<!-- theme name -->
					<h1>Cymbit CMS <span class="hidden-phone">- <?= $template['title']; ?> </span> </h1>
					<!-- end theme name -->
					
					<!-- span4 -->
					<div class="pull-right">
						<!-- demo theme switcher-->
						<div id="theme-switcher" class="btn-toolbar">
							
							<!-- search and log off button for phone devices -->
							<div class="btn-group pull-right visible-phone">
								<a href="javascript:void(0)" class="btn btn-inverse btn-small"><i class="icon-search"></i></a>
								<a href="<?= base_url('app/logout'); ?>" class="btn btn-inverse btn-small"><i class="icon-off"></i></a>
							</div>
							<!-- end buttons for phone device -->
							
							<!-- dropdown mini-inbox-->
							<div class="btn-group">
								<!-- new mail ticker -->
								<a href="javascript:void(0)" class="btn btn-small btn-inverse dropdown-toggle" data-toggle="dropdown">
									<span class="mail-sticker">3</span>
									<i class="cus-email"></i>
								</a>
								<!-- end new mail ticker -->
								
								<!-- email lists -->
								<div class="dropdown-menu toolbar pull-right">
									<h3>Inbox</h3>
									<ul id="mailbox-slimscroll-js" class="mailbox">
										<li>
											<a href="javascript:void(0)" class="unread">
												<img src="<?=base_url('images/app/email-important.png')?>" alt="important mail">
												From: David Simpson
												<i class="icon-paper-clip"></i>
												<span>Dear Victoria, Congratulations! Your work has been uploaded to wrapbootstrap.com...</span>
											</a>
										</li>
										<li>
											<a href="javascript:void(0)" class="unread attachment">
												
												<img src="<?=base_url('images/app/email-unread.png')?>" alt="important mail">
												Re:Last Year sales
												<i class="icon-paper-clip"></i>
												<span>Hey Vicky, find attached! Thx :-)</span>
											</a>
										</li>
										<li>
											<a href="javascript:void(0)" class="unread">
												<img src="<?=base_url('images/app/email-unread.png')?>" alt="important mail">
												Company Party
												<i class="icon-paper-clip"></i>
												<span>Hi, You have been cordially invited to join new year after party.</span>
											</a>
										</li>
										<li>
											<a href="javascript:void(0)" class="read">
												<img src="<?=base_url('images/app/email-read.png')?>" alt="important mail">
												RE: 2 Bugs found...
												<i class="icon-paper-clip"></i>
												<span>I have found two more bugs in this your beta version, maybe its not working...</span>
											</a>
										</li>
										<li>
											<a href="javascript:void(0)" class="read">
												<img src="<?=base_url('images/app/email-read.png')?>" alt="important mail">
												2 Bugs found...
												<i class="icon-paper-clip"></i>
												<span>Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales.</span>
											</a>
										</li>
										<li>
											<a href="javascript:void(0)" class="read">
												<img src="<?=base_url('images/app/email-read.png')?>" alt="important mail">
												Welcome to Jarvis!
												<i class="icon-paper-clip"></i>
												<span>Feugiat a, tellus. Phasellus viverra nulla ut metus varius. Quisque rutrum. Aenean imperdiet... </span>
											</a>
										</li>
									</ul>
									<a href="javascript:void(0);" id="go-to-inbox">Go to Inbox <i class="icon-double-angle-right"></i></a>
								</div>
								<!-- end email lists -->
							</div>
							<!-- end dropdown mini-inbox-->
							
							<!-- Tasks -->
							<div class="btn-group hidden-phone">
								<a href="javascript:void(0)" class="btn btn-inverse btn-small">My Tasks</a>
								<a href="javascript:void(0)" class="btn btn-inverse dropdown-toggle btn-small" data-toggle="dropdown"><span class="caret"></span></a>
					
								<div class="dropdown-menu toolbar pull-right">
									<h3>Showing All Tasks</h3>
									<ul class="progressbox">
						                <li>
						                    <strong><i class="online pull-left"></i>Urgent Bug Fixes</strong><b>Complete</b>
						                    <div class="progress progress-success slim"><div class="bar" style="width: 100%;"></div></div>
						                </li>
						                <li>
						                    <strong>Added functionality</strong><b>70%</b>
						                    <div class="progress progress-info slim"><div class="bar" style="width: 70%;"></div></div>
						                </li>
						                <li>
						                    <strong>CAD Changes</strong><b>50%</b>
						                    <div class="progress progress-info slim"><div class="bar" style="width: 50%;"></div></div>
						                </li>
						                <li>
						                    <strong>Marketing Campaign Mocup</strong><b>22%</b>
						                    <div class="progress progress-danger slim"><div class="bar" style="width: 22%;"></div></div>
						                </li>
						                <li>
						                    <strong><i class="offline pull-left"></i>Proposal</strong><b>Pending</b>
						                    <div class="progress progress-info slim"><div class="bar" style="width: 0%;"></div></div>
						                </li>
						            </ul>
								</div>

							</div>
							<!-- end Tasks -->
							
							<!-- theme dropdown -->
							<div class="btn-group hidden-phone">
								<a href="javascript:void(0)" class="btn btn-small btn-inverse" id="reset-widget"><i class="icon-refresh"></i></a>
								<a href="javascript:void(0)" class="btn btn-small btn-inverse dropdown-toggle" data-toggle="dropdown">Themes <span class="caret"></span></a>
								<ul id="theme-links-js" class="dropdown-menu toolbar pull-right">
									<li>
										<a href="javascript:void(0)" data-rel="purple"><i class="icon-sign-blank purple-icon"></i>Royal Purple</a>
									</li>
									<li>
										<a href="javascript:void(0)" data-rel="blue"><i class="icon-sign-blank navyblue-icon"></i>Navy Blue</a>
									</li>
									<li>
										<a href="javascript:void(0)" data-rel="green"><i class="icon-sign-blank green-icon "></i>Emerald</a>
									</li>
									<li>
										<a href="javascript:void(0)" data-rel="darkred"><i class="icon-sign-blank red-icon "></i>Dark Rose</a>
									</li>
									<li>
										<a href="javascript:void(0)" data-rel="default"><i class="icon-sign-blank grey-icon"></i>Default</a>
									</li>
								</ul>
							</div>
							<!-- end theme dropdown-->
							
						</div>
					  	<!-- end demo theme switcher-->
					</div>
					<!-- end span4 -->
				</div>
				<!-- end .contained -->
			</div>
			<!-- end tool bar -->
			
		</header>
		<!-- end header -->
		
	    <div id="main" role="main" class="container-fluid">
			<div class="contained">
				<!-- aside -->	
				<aside>	
					
					<!-- search box -->
					<div class="main-search">
						<label for="main-search"><i class="icon-search"></i></label>
	                    <input id="main-search" type="text" placeholder="Search...">
                	</div>
					<div class="divider"></div>
					<!-- end search box -->
										
					<!-- aside item: Mini profile -->
					<div class="my-profile">
						<a href="<?= base_url('app/users/edit/' . $this->session->userdata('QID')); ?>" class="my-profile-pic">
							<img src="<?=base_url('images/app/avatar/avatar_0.jpg')?>" alt="" />
						</a>
						<span class="first-child">Welcome <strong><?= $this->session->userdata('first_name') . '&nbsp;' .  ucwords(substr($this->session->userdata('last_name'), 0, 1)); ?>!</strong></span>
						<span><a href="<?= base_url('app/users/edit/' . $this->session->userdata('QID')); ?>" class="edit-profile">Edit Profile </a></span>
					</div>
					<div class="divider"></div>
					<!-- end aside item: Mini profile -->

					<!-- aside item: Menu -->
					<div class="sidebar-nav-fixed">
						
						<ul class="menu" id="accordion-menu-js">
							
							<li class="current">
								<a href="<?=base_url('app')?>"><i class="icon-home"></i>Dashboard</a>
							</li>
						<li class="">
								<a href="javascript:void(0)"><i class="icon-globe"></i>My Sites <span class="badge"><?// $this->sites->get_num_sites() ?></span></a>
								<ul>
								<?php
								foreach ($this->session->userdata('sites') as $site) {
									if ($site['active'] == 1) {?>
									<li>
										<a href="<?= base_url('app/sites/dashboard/' . $site['sid']); ?>">
											<?= $site['name']; ?>
										</a>
									</li>
									<?php
									    }
									}
									if ($this->session->userdata('user_type') == 1) {
									?>
									<li>
										<a href="<?= base_url('app/sites/create'); ?>">
											Add New Site
										</a>
									</li>
									<?php } ?>
								</ul>
						</li>
						<?php
						if ($this->session->userdata('user_type') == 1) {?>
							<li class="">
								<a href="javascript:void(0)"><i class="icon-user"></i>Users<span class="badge"><?// $this->ion_auth->get_num_user() ?></span></a>
								<ul>
									<?php
									
										foreach ($this->session->userdata('users') as $user) {?>
									<li>
										<a href="<?= base_url('app/users/edit/' . $user['username']); ?>">
											<?= $user['first_name'] . '&nbsp;' .  ucwords(substr($user['last_name'], 0, 1)) .'.';?>
										</a>
									</li>
									<?php
									}
									
									?>
									<li>
										<a href="<?= base_url('app/users/create'); ?>">
											Add New User
										</a>
									</li>
									
								</ul>
							</li>
							<?php } ?>
							<li>
								<a href="<?=base_url('app/logout')?>" class="logout"><i class="icon-off"></i>Logout</a>
							</li>
						</ul>
						
					</div>
					<div class="divider"></div>
					<!-- end aside item: Menu -->

				</aside>
				<!-- aside end -->
				
				<!-- main content -->
				<?= $template['body']; ?>
				<!-- end main content -->
			
				<!-- aside right on high res -->
				<?php include('include/default/sidebar/index.php');?>
				
				<!-- end aside right -->
			</div>
			
	    </div><!--end fluid-container-->
		<div class="push"></div>
	</div>
	<!-- end .height wrapper -->
	
	<!-- footer -->
	
	<!-- if you like you can insert your footer here -->
	
	<!-- end footer -->

    <!--================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    	<!-- OPTIONAL: Use this migrate scrpit for plugins that are not supported by jquery 1.9+ -->
		<!-- DISABLED <script src="js/libs/jquery.migrate-1.0.0.min.js"></script> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script>window.jQuery.ui || document.write('<script src="<?=base_url('js/app/libs/jquery.ui.min.js')?>"><\/script>')</script>
    
    <!-- IMPORTANT: Jquery Touch Punch is always placed under Jquery UI -->
    <script src="<?=base_url('js/app/include/jquery.ui.touch-punch.min.js')?>"></script>
    
    <!-- REQUIRED: Mobile responsive menu generator -->
	<script src="<?=base_url('js/app/include/selectnav.min.js')?>"></script>

	<!-- REQUIRED: Datatable components -->
    <script src="<?=base_url('js/app/include/jquery.accordion.min.js')?>"></script>

	<!-- REQUIRED: Toastr & Jgrowl notifications  -->
    <script src="<?=base_url('js/app/include/toastr.min.js')?>"></script>
    <script src="<?=base_url('js/app/include/jquery.jgrowl.min.js')?>"></script>
    
    <!-- REQUIRED: Sleek scroll UI  -->
    <script src="<?=base_url('js/app/include/slimScroll.min.js')?>"></script>
	
	<!-- REQUIRED: Datatable components -->
	<script src="<?=base_url('js/app/include/jquery.dataTables.min.js')?>"></script>
	<script src="<?=base_url('js/app/include/DT_bootstrap.min.js')?>"></script> 

    <!-- REQUIRED: Form element skin  -->
    <script src="<?=base_url('js/app/include/jquery.uniform.min.js')?>"></script>

	<script type="text/javascript">
		var ismobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));	
	    if(!ismobile){
	    	
	    	/** ONLY EXECUTE THESE CODES IF MOBILE DETECTION IS FALSE **/
	    	
	    	/* REQUIRED: Datatable PDF/Excel output componant */
	    	
	    	document.write('<script src="<?=base_url('js/app/include/ZeroClipboard.min.js')?>"><\/script>'); 
	    	document.write('<script src="<?=base_url('js/app/include/TableTools.min.js')?>"><\/script>');
	    	document.write('<script src="<?=base_url('js/app/include/select2.min.js')?>"><\/script>'); 
	    	document.write('<script src="<?=base_url('js/app/include/jquery.excanvas.min.js')?>"><\/script>');
	    	document.write('<script src="<?=base_url('js/app/include/jquery.placeholder.min.js')?>"><\/script>');
	    	
			/** DEMO SCRIPTS **/
	        $(function() {
	            /* show tooltips */
				
	        });
	        /** end DEMO SCRIPTS **/
	        
	    }else{
	    	
	    	/** ONLY EXECUTE THESE CODES IF MOBILE DETECTION IS TRUE **/
	    	
			document.write('<script src="<?=base_url('js/app/include/selectnav.min.js')?>"><\/script>');
	    }
	</script>

    <!-- REQUIRED: iButton -->
    <script src="<?=base_url('js/app/include/jquery.ibutton.min.js')?>"></script>
	
	<!-- REQUIRED: Justgage animated charts -->
	<script src="<?=base_url('js/app/include/raphael.2.1.0.min.js')?>"></script> 
    <script src="<?=base_url('js/app/include/justgage.min.js')?>"></script> 
    
    <!-- REQUIRED: Morris Charts -->
    <script src="<?=base_url('js/app/include/morris.min.js')?>"></script> 
    <script src="<?=base_url('js/app/include/morris-chart-settings.js')?>"></script> 
    
    <!-- REQUIRED: Animated pie chart -->
    <script src="<?=base_url('js/app/include/jquery.easy-pie-chart.min.js')?>"></script>
    
    <!-- REQUIRED: Functional Widgets -->
    <script src="<?=base_url('js/app/include/jarvis.widget.min.js')?>"></script>
    <script src="<?=base_url('js/app/include/mobiledevices.min.js')?>"></script>
	
	<!-- REQUIRED: Full Calendar -->
    <script src="<?=base_url('js/app/include/jquery.fullcalendar.min.js')?>"></script>		
    
    <!-- REQUIRED: Flot Chart Engine -->
    <script src="<?=base_url('js/app/include/jquery.flot.cust.min.js')?>"></script>			
    <script src="<?=base_url('js/app/include/jquery.flot.resize.min.js')?>"></script>		
    <script src="<?=base_url('js/app/include/jquery.flot.tooltip.min.js')?>"></script>		
    <script src="<?=base_url('js/app/include/jquery.flot.orderBar.min.js')?>"></script> 	
    <script src="<?=base_url('js/app/include/jquery.flot.fillbetween.min.js')?>"></script> 	
    <script src="<?=base_url('js/app/include/jquery.flot.pie.min.js')?>"></script> 	 
    
    <!-- REQUIRED: Sparkline Charts -->
    <script src="<?=base_url('js/app/include/jquery.sparkline.min.js')?>"></script>

	<!-- REQUIRED: Infinite Sliding Menu (used with inbox page) -->
	<script src="<?=base_url('js/app/include/jquery.inbox.slashc.sliding-menu.js')?>"></script> 

    
    <!-- REQUIRED: Progress bar animation -->
    <script src="<?=base_url('js/app/include/bootstrap-progressbar.min.js')?>"></script>
    
    <!-- REQUIRED: wysihtml5 editor -->
    <script src="<?=base_url('js/app/include/wysihtml5-0.3.0.min.js')?>"></script>
    <script src="<?=base_url('js/app/include/bootstrap-wysihtml5.min.js')?>"></script>

	<!-- REQUIRED: Masked Input -->
    <script src="<?=base_url('js/app/include/jquery.maskedinput.min.js')?>"></script> 
    
    <!-- REQUIRED: Bootstrap Date Picker -->
    <script src="<?=base_url('js/app/include/bootstrap-datepicker.min.js')?>"></script>

    <!-- REQUIRED: Bootstrap Wizard -->
    <script src="<?=base_url('js/app/include/bootstrap.wizard.min.js')?>"></script> 
    
	<!-- REQUIRED: Bootstrap Color Picker -->
     <script src="<?=base_url('js/app/include/bootstrap-colorpicker.min.js')?>"></script> 

    
	<!-- REQUIRED: Bootstrap Time Picker -->
    <script src="<?=base_url('js/app/include/bootstrap-timepicker.min.js')?>"></script> 
    
    <!-- REQUIRED: Bootstrap Prompt -->
    <script src="<?=base_url('js/app/include/bootbox.min.js')?>"></script> 
    
    <!-- REQUIRED: Bootstrap engine -->
    <script src="<?=base_url('js/app/include/bootstrap.min.js')?>"></script>
    
    <!-- DO NOT REMOVE: Theme Config file -->
    <script src="<?=base_url('js/app/config.js')?>"></script>
    
    <!-- d3 library placed at the bottom for better performance -->
    <script src="<?=base_url('js/app/include/d3.v3.min.js')?>"></script> 
    <script src="<?=base_url('js/app/include/adv_charts/d3-chart-1.js')?>"></script>
    <script src="<?=base_url('js/app/include/adv_charts/d3-chart-2.js')?>"></script> 

    <!-- Google Geo Chart -->
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script> 
    <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <!-- DISABLED <script src="js/include/adv_charts/geochart.js"></script> -->
    
    <script src="<?=base_url('js/app/include/jquery.livequery.min.js')?>"></script>
    <script src="<?=base_url('js/app/include/jquery.filetree.js')?>"></script>
    <script src="<?=base_url('js/app/include/jquery.jbreadcrumb.js')?>"></script>
    <script src="<?=base_url('js/validator/jquery.validationEngine.js')?>"></script>
    <script src="<?=base_url('js/validator/jquery.validationEngine-en.js')?>"></script>
    <script src="<?=base_url('js/app/include/jquery.gritter.min.js')?>"></script>
     <script src="<?=base_url('js/app/include/global.js')?>"></script>
    
    <!-- end scripts -->
    <script type="text/javascript">
	$(function() {
		<?php
		if (!empty($this->session)) {
			$toastr = $this->session->flashdata('toastr');
			if (!empty($toastr) || ! empty($toastr_instant)) {
				$toastr = (is_array($toastr))?$toastr:array();//$toastr_instant = (is_array($toastr_instant))?$toastr_instant:array();
		foreach($toastr as $key) {
			echo "toastr.".$key['type']."('".$key['text']."','".$key['title']."');";
		}
		
	}

			$gritter = $this->session->flashdata('gritter');
			if (!empty($gritter) || ! empty($gritter_instant)) {
				$gritter = (is_array($gritter))?$gritter:array();//$toastr_instant = (is_array($toastr_instant))?$toastr_instant:array();
				foreach($gritter as $key) {
				echo "$.jGrowl('".$key['text']."', { 
					header: '".$key['title']."', 
					sticky: false,
					life: 5000,
					speed: 500,
					position: 'top-right', //this is default position
					easing: 'easeOutBack',
					animateOpen: { 
						height: \"show\"
					},
					animateClose: { 
						opacity: 'hide' 
					}
				});";
				}
			}
		}?>

	});
     </script>
	</body>
</html>