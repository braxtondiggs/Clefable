<?php
    $first_name = "";$user_languages = "en";$type= "2";$account_type = $this->ion_auth->get_account_type();
    $email = $last_name = $first_name;
    if (isset($id)) {
	$user = $this->ion_auth->user($id)->result();
	$first_name = $user[0]->first_name;
	$last_name = $user[0]->last_name;
	$email = $user[0]->email;
	$user_languages = $user[0]->language;
	$type = $user[0]->user_type;
	
    }
?>
<form id="user" class="formular_noattach" method="post" action="<?php echo base_url("app/users/submit".(!isset($id))?"":"/".$id);?>">
    <div class="jQTabs" style="float:left;width:100%;">
	<ul>
	    <li>
		<a href="#tabs-1">
		    <span class="user cmsicon"></span>Basic Information
		</a>
	    </li>
            <li>
		<a href="#tabs-2">
		    <span class="shareperm cmsicon"></span>Permissions</a>
	    </li>
	</ul>
   	<div id="tabs-1" class="Form_Block">
	    <div class="half">
		<div class="form-item">
		    <label for="first-name">
			<span>*</span>&nbsp;First Name
		    </label>
		    <input id="first-name" name="first-name" type="text" value="<?php echo $first_name; ?>" class="validate[required] text-rounded txt-l" />
		    <p>Example: John</p>
		</div>
		<div class="form-item">
		    <label for="last-name">
			<span>*</span>&nbsp;Last Name
		    </label>
		    <input id="last-name" name="last-name" type="text" value="<?php echo $last_name; ?>"  class="validate[required] text-rounded txt-l" />
		    <p>Example: Doe</p>
		</div>
		<div class="form-item">
		    <label for="email">
			<span>*</span>&nbsp;Email
		    </label>
		    <input id="email" name="email" type="text" value="<?php echo $email; ?>" class="validate[required,custom[email]] text-rounded txt-l" />
		    <p>Example: John.Doe@mail.com</p>
		</div>
		<div class="form-item">
		    <label for="language">&nbsp;Language - BETA</label>
		    <select id="language" name="language" class="text-rounded">
			<?php foreach($languages = $this->ion_auth->get_languages() as $lang) {
			    echo '<option value="'.$lang['value'].'"'.($user_languages == $lang['value']?' selected="selected"':'').'>'.$lang['text'].'</option>';
			}
			?>
		    </select>
		    <p>language for this user</p>
		</div>
	    </div>
	    <div class="half">
		<!--<div class="alert-warning">
		    <h6>Account Administrator</h6>
		    <p>Only Business Accounts can have more than one Account Administrator. Upgrade to a Business Account.</p>
		</div>-->
		<div class="form-item">
		    <label style="margin-bottom:15px;">
			<span>*</span>&nbsp;Account Type
		    </label>
		    <input id="admin" name="account_type" type="radio" class="validate[required]" <?php echo ($type == "1")?"checked=\"checked\" ":"";?><?php echo ($account_type == "1")?"disabled=\"disabled\"":"";?> />
		    <label for="admin" style="display: inline;">Administor&nbsp;</label>
		    <input id="editor" name="account_type" type="radio" class="validate[required]" <?php echo ($type == "2")?"checked=\"checked\"":"";?> <?php echo ($account_type == "1" && $type == "1")?"disabled=\"disabled\"":"";?>/>
		    <label for="editor" style="display: inline;">Editor&nbsp;</label>
		</div>
		
		<div class="form-item">
		    <label for="password">&nbsp;Password</label>
		    <input id="password" name="password" type="password" class="text-rounded txt-l validate[required,minSize[6]]" />
		    <p>Only enter a password if you wish to change the existing one.</p>
		</div>
		<div class="form-item">
		    <label for="confirm_pass">&nbsp;Repeat Password</label>
		    <input id="confirm_pass" name="confirm_pass" type="password" class="text-rounded txt-l <?php echo (empty($EID))?"validate[required,equals[password]]":"validate[equals[password]]"?>" />
		    <p>re-enter the password for this account</p>
		</div>
	    </div>
	    <br class="clr" />
	</div>
    </div>
</form>
    