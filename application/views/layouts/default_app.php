<?php
include('include/config.php');
$assets = "app";$header=false;?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('include/default/meta.php');?>
	</head>
	<body>
		<div id="wrapper-app">
			<div id="header">
				<div id="block_header">
					<!--<div id="smoothmenu_container">	
						<div id="smoothmenu1" class="ddsmoothmenu">
							<?php include('include/default/header/menu_app.php'); ?>
						</div>
					</div>-->
					<!--
					<?php if (isset($_SESSION['impersonate'])) {?>
						<div class="impersonate_warning">You are currently in impersonate mode, <a href="#" class="impersonate_reset">click here to return to your original account.</a>
					</div>
					<?php } ?>
					-->
					<?php include('include/default/header/logo.php');?>
					<div class="clr"></div>
				</div>
			</div>
			<div id="main">
				<div id="main_container">
					<div id="content">
						<?php echo $template['body']; ?>
					</div>
					<?php include('include/default/sidebar/index.php');?>
				</div>
				<div class="clr"></div>
			</div>
			<?php include('include/default/footer.php');?>
		</div>
	</body>
</html>