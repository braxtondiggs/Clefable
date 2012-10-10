<script type="text/javascript">
    $(function() {
        $(".button").button();
        $("#reset").validationEngine('attach');
    });
</script>
<div class="Block" style="margin:0 auto;clear:both;float: none;">
    <p>&nbsp;</p>
    <p>Please enter your new password.</p>
    <div id="Form_Block" style="padding: 0 15px;">
	<form id="reset" class="formular" method="post" action="#" >
	    <div style="height:10px;"></div>
	    <div class="validate_errors alert-error" style="display:none;"></div>
	    <div class="form-item">
                <label for="password"><span>*</span>&nbsp;New Password</label>
                <input id="password" name="password" type="password" class="validate[required,minSize[6]] text" />
            </div>
            <div class="form-item">
                <label for="confirmpassword"><span>*</span>&nbsp;Confirm New Password</label>
                <input id="confirmpassword" name="confirmpassword" type="password" class="validate[required,equals[password]] text" />
                <input id="pass_token" name="pass_token" type="hidden" value="<?php echo $token;?>" />
            </div>
	    <input id="reset-pass-submit" class="submit button" type="submit" value="Reset Password" />
	</form>
    </di
</div>