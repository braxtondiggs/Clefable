<?php $QID = $this->session->userdata('username');
$user = $this->ion_auth->user()->row();
		echo $user->email;
echo $QID;
print_r($this->session)?>
<h3 class="underline">Account Dashboard</h3>
<a class="nav-section manage_sitebtn" href="<?php echo base_url()."site/";?>">
	<h4 class="underline"><span class="icon-block cmsicon"></span>Manage Websites</h4>
	<p>Create and manage multiple websites.</p>
</a>
<?php //if() {?>
<a class="nav-section manage_userbtn" href="<?php echo base_url()."site/user";?>">
	<h4 class="underline"><span class="card-stack cmsicon"></span>User &amp; Permission</h4>
	<p>Click to manage user and access.</p>
</a>