<script type="text/javascript">
    $(function() {
        $(".button").button();
        $("#Form_Block").validationEngine({
            ajaxFormValidation: true
        });
    });
    var oneall_js_protocol = (("https:" == document.location.protocol) ? "https" : "http");
    document.write(unescape("%3Cscript src='" + oneall_js_protocol + "://cymbitcms.api.oneall.com/socialize/library.js' type='text/javascript'%3E%3C/script%3E"));
</script>	
<h3 class="underline">Sign up with Cymbit CMS</h3>
<div id="oneall">
    <p><strong>Register using existing account at one of these sites:</strong></p>
    <p>You will then use this account to log-in to Cymbit CMS, so you don't have to remember an additional password.<br /><br /></p>
    <div id="oneall_widget">
        <div id="view" style="margin:0 auto;width:327px;">
            <p style="font-size: 1em;font-weight: bold;margin:0;font-family: 'lucida grande',Verdana,sans-serif;color: #333;">Sign in using your account with</p>
        </div>
        <div id="social_login_container"></div>
        <script type="text/javascript">
            oneall.api.plugins.social_login.build("social_login_container", {
                'providers' :  ['google', 'yahoo', 'openid', 'facebook', 'linkedin', 'twitter'],
                'grid_size_x': '2',
                'css_theme_uri': 'http://cymbit.com/css/oneall.css',
                'callback_uri': 'http://cymbit.com/site/oneall'
            });
        </script>
    </div>
</div>
<h3 id="Spacer_register" class="left">OR</h3>
<div class="Block">
    <p><strong>Register with a new username/password:</strong></p>
    <p>Create a username &amp; password you want to use for Cymbit CMS. This will add you to our mailing list for contact and support purposes.</p>
    <form id="Form_Block" class="formular" method="post" action="#">
        <div class="validate_errors alert-error" style="display:none;"></div>
        <div class="form-item">
            <label for="email"><span>*</span>&nbsp;Email</label>
            <input id="email" name="email" type="text" class="validate[required,custom[email],ajax[ajaxEmail]] text" />
        </div>
        <div class="form-item">
            <label for="password"><span>*</span>&nbsp;Password</label>
            <input id="password" name="password" type="password" class="validate[required,minSize[6]] text" />
	</div>
        <div class="form-item">
            <label for="confirmpassword"><span>*</span>&nbsp;Confirm Password</label>
            <input id="confirmpassword" name="confirmpassword" type="password" class="validate[required,equals[password]] text" />
        </div>
        <div class="form-item">
            <input name="terms" id="terms" class="validate[required] checkbox" type="checkbox" value="Yes" />
            <label for="terms" style="display:inline;font:16px Georgia, 'Times New Roman', Times, serif;"><span>*</span>&nbsp;Agree To The&nbsp;</label><a title="Terms of Service" class="modal" href="Terms/modal">Terms of Service</a>
        </div>
        <input id="signup-submit" class="submit button" type="submit" value="Get Started!" />
    </form>
</div>