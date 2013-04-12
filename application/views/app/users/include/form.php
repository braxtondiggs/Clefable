<?php
    $first_name = "";$user_languages = "en";$type= "2";$account_type = $this->session->userdata('account_type');
    $email = $last_name = $first_name;
    if (isset($id)) {
	$user = $this->ion_auth->user($id)->result();
	$first_name = $user[0]->first_name;
	$last_name = $user[0]->last_name;
	$email = $user[0]->email;
	$user_languages = $user[0]->language;
	$type = $user[0]->user_type;
	
    }else {
	$id = "";
    }
?>
<div class="alert alert-error adjusted alert-block" style="display:none;"><h4 class="alert-heading"><strong>Error:</strong></h4>
		    <p>&nbsp;</p>
		    </div>
<form id="user" class="formular form-horizontal themed" method="post" action="<?php echo base_url("app/users/submit/".$id);?>">
    <div class="inner-spacer">
	<ul id="myTab" class="nav nav-tabs default-tabs">
	   <li class="active">
	       <a href="#s1" data-toggle="tab"><span class="cus-user"></span>&nbsp;Basic Information</a>
	   </li>
	   <?php if ($this->session->userdata('user_type') == 1) { ?>
	   <li>
	       <a href="#s2" data-toggle="tab"><span class="cus-lock"></span>&nbsp;Permissions</a>
	   </li>
	   <?php if (!empty($id) && ($id != $this->session->userdata("QID"))) {?>
	   <li>
		<a href="#s3" data-toggle="tab"><span class="cus-user-silhouette"></span>&nbsp;Impersonate</a>
	    </li>
	   <?php }} ?>
       </ul>
	
       <div id="myTabContent" class="tab-content">
	   <div class="tab-pane fade in active" id="s1">
	       <fieldset>
		   <div class="control-group">
			   <label class="control-label" for="first-name"><span>*</span>&nbsp;First Name</label>
			   <div class="controls">
				   <input id="first_name" name="first_name" type="text" value="<?php echo $first_name; ?>" class="validate[required] text-rounded txt-l span12" />
				   <p class="help-block">Example: John</p>
			   </div>
		   </div>
		   <div class="control-group">
			   <label class="control-label" for="last-name"><span>*</span>&nbsp;Last Name</label>
			   <div class="controls">
				   <input id="last_name" name="last_name" type="text" value="<?php echo $last_name; ?>"  class="validate[required] text-rounded txt-l span12" />
				   <p class="help-block">Example: Doe</p>
			   </div>
		   </div>
		   <div class="control-group">
			   <label class="control-label" for="email"><span>*</span>&nbsp;Email</label>
			   <div class="controls">
				   <input id="email" name="email" type="text" value="<?php echo $email; ?>" class="validate[required,custom[email]] text-rounded txt-l span12" />
				   <p class="help-block">Example: John.Doe@mail.com</p>
			   </div>
		   </div>
		   <?php if (!(isset($is_new) && $is_new)) { ?>
		   <div class="control-group">
			   <div class="controls">
				   <label class="checkbox">
				       <input type="checkbox" id="new_password" name="new_password"  value="true">Change Password
				   </label>
			   </div>
		   </div>
		   <?php } ?>
		    <div class="control-group" <?= (!(isset($is_new) && $is_new))? 'style="display:none;"':''?>>
			    <label class="control-label" for="password"><span>*</span>&nbsp;New Password</label>
			    <div class="controls">
				    <input id="password" name="password" type="password" class="text-rounded txt-l validate[required,minSize[6]] span12" />
					<p class="help-block">Only enter a password if you wish to change the existing one.</p>
			    </div>
		    </div>
		    <div class="control-group" <?= (!(isset($is_new) && $is_new))? 'style="display:none;"':''?>>
			    <label class="control-label" for="confirm_password"><span>*</span>&nbsp;Repeat Password</label>
			    <div class="controls">
				    <input id="confirm_password" name="confirm_password" type="password" class="text-rounded txt-l validate[required,equals[password]] span12" />
				    <p class="help-block">Re-enter the password for this account</p>
			    </div>
		    </div>
		   <div class="control-group">
		       <label class="control-label" for="language">&nbsp;Language - BETA</label>
			   <div class="controls">
			       <select id="language" name="language" class="text-rounded span12 with-search">
				   <?php foreach($languages = $this->ion_auth->get_languages() as $lang) {
				       echo '<option value="'.$lang['value'].'"'.($user_languages == $lang['value']?' selected="selected"':'').'>'.$lang['text'].'</option>';
				   }
				   ?>
			       </select>
			       <p class="help-block">Language for this user</p>
			   </div>
		   </div>
		   <?php if ($this->session->userdata('user_type') == 1) { ?>
		   <div class="control-group">
		       <label class="control-label"><span>*</span>&nbsp;Account Type</label>
		       <div class="controls">
			       <label class="radio">
				   <input id="admin" name="account_type" type="radio" class="validate[required]" value="1" <?php echo ($type == "1")?"checked=\"checked\" ":"";?><?php echo ($account_type == "1")?"disabled=\"disabled\"":"";?> />
				   Administor&nbsp;
			       </label>
			       <label class="radio">
				   <input id="editor" name="account_type" type="radio" class="validate[required]" value="2" <?php echo ($type == "2")?"checked=\"checked\"":"";?> <?php echo ($account_type == "1" && $type == "1")?"disabled=\"disabled\"":"";?>/>
				   Editor&nbsp;
			       </label>
				<?php if ($this->session->userdata('account_type') == 1) { ?>
			       <br />
			       <div class="alert adjusted alert-block">
				   <p>Only Business Accounts can have more than one Account Administrator. Upgrade to a Business Account.</p>
			       </div>
		       </div>
		   </div>
		   <?php }} ?>
	       </fieldset>
	   </div>
	    <?php if (!empty($id) && ($id != $this->session->userdata("QID"))) {?>
       <div class="tab-pane fade" id="s2">
       </div>
       <div class="tab-pane fade in" id="s3">
	     <fieldset>
		<div class="control-group">
		<p>
		Impersonate this user, you can see what they would see when they log into their account.
		</p>
		<p>&nbsp;</p>
		<div class="center">
		    <a href="<?php echo base_url("app/users/impersonate/activate/".$id);?>"title="Impersonate this user" class="btn btn-warning btn-large ajax-action">Impersonate this user</a>
		</div>
		</div>
	    </fieldset>
	</div>
       <?php }?>
       </div>
	   <div class="form-actions" style="padding-left:0;">
		<?php if (!empty($id) && ($id != $this->session->userdata("QID") || $this->session->userdata('user_type') == 1)) { ?>
		<a href="<?= base_url('app/sites/delete/approved/' . $id);?>" title="Delete User" class="btn btn-danger left delete">Delete User</a>
		<?php }?>
		<a href="<?= base_url('app')?>" title="Cancel" class="btn">Cancel</a>
		<a href="javascript:void(0);" title="Cancel" class="btn btn-primary submit">Save Changes</a>
	   </div>
       </div>
</form>
<script type="text/javascript">
	$(function() {
	    $('#new_password').click(function() {
		    $(this).parents('div.control-group').next('div').slideToggle().children('input#Passkey-Value').val("");
	    });
	});
</script>

    