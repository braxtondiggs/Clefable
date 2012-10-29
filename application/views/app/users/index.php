<div class="breadCrumbHolder module">
	<div id="breadCrumb" class="breadCrumb module">
    	<ul>
            <li>
            	<a href="<?php echo base_url("app"); ?>">Account Dashboard</a>
            </li>
            <li>
                Users and Permissions
            </li>
        </ul>
    </div>
</div>
<h3 class="underline">Users and Permissions</h3>
<table id="manage_userTable" class="table-standard">
    <thead>
        <tr>
            <th scope="col" id="Name">Name</th>
            <th scope="col" id="Email">Email</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
	</tr>
    </thead>
    <tbody>
	<?php foreach($this->ion_auth->users($this->session->userdata("account"))->result() as $user) {?>
		<tr>
			<td style="max-width: 150px;">
				<span class="<?php echo ($user->user_type == 1) ? "user": "user-share";?> cmsicon"></span><?php echo $user->first_name." ".$user->last_name;?>
			</td>
			<td style="max-width: 150px;">
				<?php echo $user->email;?>
			</td>
			<td>
				<a href="<?php echo base_url("app/users/edit/".$user->username);?>">
					<span class="edit cmsicon"></span>edit
				</a>
			</td>
			<td>
				<?php if ($user->username !== $this->session->userdata("identity_QID") && $user->username !== $this->session->userdata("QID")) { ?>
                                    <a href="<?php echo base_url("app/users/impersonate/activate/".$user->username);?>" class="ajax-action">
                                            <span class="impersonate cmsicon"></span>impersonate
                                    </a>
                                <?php } ?>
			</td>
			<td>
				<a href="<?php echo base_url("app/users/delete/confirm/".$user->username);?>" class="ajax-action">
					<span class="delete cmsicon"></span>delete
				</a>
			</td>
                </tr>
        <?php } ?>
	<tr>
		<td class="add-userbtn" colspan="5" style="padding:15px 0 15px 50px;font-weight:bold;">
			<a href="<?php echo base_url("app/users/create");?>">
				<span class="user-add cmsicon"></span>Register New User
			</a>
		</td>
        </tr>
</tbody>
</table>
<?php $this->load->view('app/include/modal/confirm'); ?>