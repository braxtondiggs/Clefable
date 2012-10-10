<html>
<body>
	<p>Hello,</p>
	<p>We all forget our password sometimes. Thankfully, your <?php echo anchor(base_url(), "Cymbit.com"); ?>
		password is safely stored in our secure database.</p>
	<p>To reset your password, please use this link to log in to Cymbit.com and provide a new password:<br />
		<?php echo anchor('login/reset_password/'. $forgotten_password_code, 'Reset Your Password');?>
	</p>
	<?php include('include/footer.php'); ?>
</body>
</html>