<script type="text/javascript">	
	    $(function() {
			$(".button").button();
			$("#login").validationEngine('attach');
			$("#recovery").validationEngine('attach');
	    });
	    var oneall_js_protocol = (("https:" == document.location.protocol) ? "https" : "http");
	    document.write(unescape("%3Cscript src='" + oneall_js_protocol + "://cymbitcms.api.oneall.com/socialize/library.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<h2 class="underline">Log-in to Cymbit CMS</h2>
<p>Please enter your credentials below to proceed. If you don't already have a login then you may <?php echo anchor(base_url().'register', 'sign up for free'); ?>.</p>
<div id="oneall">
	    <p><strong>Log-in using an existing account with one of these sites:</strong></p>
	    <br />
	    <div id="oneall_widget">
			<div id="view" style="margin:0 auto;width:327px;">
				    <p style="font-size: 1em;font-weight: bold;margin:0;font-family: 'lucida grande',Verdana,sans-serif;color: #333;">Sign in using your account with</p>
			</div>
			<div id="social_login_container"></div>
			<script type="text/javascript">
				    oneall.api.plugins.social_login.build("social_login_container", {
						'providers' :  ['google', 'yahoo', 'openid', 'facebook', 'linkedin', 'twitter'],
						'grid_size_x': '2',
						'css_theme_uri': '<?php echo base_url();?>css/oneall.css',
						'callback_uri': '<?php echo base_url();?>site/oneall'
				    });
			</script>
	    </div>
</div>
<h3 id="Spacer_login" class="left">OR</h3>
<div class="Block">
	    <p><strong>Log-in with your CMS account:</strong></p>
	    <p>&nbsp;</p>
	    <div id="Form_Block" style="padding: 0 15px;">
			<form id="login" class="formular" method="post" action="#" >
				    <div style="height:10px;"></div>
				    <div class="validate_errors alert-error" style="display:none;"></div>
				    <div class="form-item" style="margin-top:20px;">
						<label for="email"><span>*</span>&nbsp;Email</label>
						<input id="email" name="email" type="text" class="validate[required,custom[email]] text" />
				    </div>
				    <div class="form-item">
						<label for="password"><span>*</span>&nbsp;Password</label>
						<input id="password" name="password" type="password" class="validate[required,length[6,32]] text" />
				    </div>
				    <div class="form-item">
						<input id="remember" name="remember" type="checkbox" />
						<label for="remember" style="display:inline;">&nbsp;Remember Me</label>
				    </div>
				    <p style="margin-bottom:.5em;"><?php echo anchor(base_url() . 'signup', 'Sign-Up');?> or <?php echo anchor(base_url().'#', 'Forgot Password', 'id="recov_pass"'); ?></p>
				    <input id="login-submit" class="submit button" type="submit" value="Login!" />
			</form>
			<form id="recovery" class="formular" action="#" style="display:none;">
				    <div class="form-item">
						<p>Enter the email address you use, and a link that will allow you to reset your password will be e-mailed to you.</p>
						<br />
						<div class="ui-widget" style="height:30px;display:none;"></div>
						<label for="recov_email"><span>*</span>&nbsp;Email</label>
						<input id="recov_email" name="recov_email" type="text" class="validate[required,custom[email]] text" />
						<br />
						<!--<div id="recov_response" style="display:none;margin-top:10px;"></div>-->
				    </div>
				    <p>&nbsp;</p>
				    <p>
						<input id="reset-submit" class="submit button" type="submit" value="Reset Password" />
						<input id="cancel-submit" class="button" type="button" value="Cancel" />
				    </p>
			</form>
	    </div>
</div>
