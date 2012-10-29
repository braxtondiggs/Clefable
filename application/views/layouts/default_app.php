<?php
include('include/config.php');
$assets = "app";$header=false;?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('include/default/meta.php');?>
	</head>
	<body>
		<?php //include('include/default/top_menu.php'); ?>
		<?php include('include/default/impersonate.php'); ?>
		<?php include('include/default/header/menu_app.php'); ?>
		<div id="wrapper-app">
			<div id="header">
				<div id="block_header">
					<?php include('include/default/header/logo.php');?>
					<div class="clr"></div>
				</div>
			</div>
			<div id="main">
				<div id="main_container">
					<div id="content<?= (isset($sidebar))?"":"_wide"; ?>">
						<?= $template['body']; ?>
					</div>
					<?php include('include/default/sidebar/index.php');?>
				</div>
				<div class="clr"></div>
			</div>
			<?php include('include/default/footer.php');?>
		</div>
	</body>
</html>