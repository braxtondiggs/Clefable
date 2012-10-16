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
			<td>
				<span class="<?php echo ($user->user_type == 1) ? "user": "user-share";?> cmsicon"></span><?php echo $user->first_name." ".$user->last_name;?>
			</td>
			<td>
				<?php echo $user->email;?>
			</td>
			<td>
				<a href="<?php echo base_url("app/users/edit/".$user->username);?>">
					<span class="edit cmsicon"></span>edit
				</a>
			</td>
			<td>
				<a href="<?php echo base_url("app/users/impersonate/".$user->username);?>" class="impersonate_user">
					<span class="impersonate cmsicon"></span>impersonate
				</a>
			</td>
			<td>
				<a href="<?php echo base_url("app/users/delete/".$user->username);?>" class="delete_user">
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