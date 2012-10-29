<?php include('include/config.php');?>
<!DOCTYPE html>
<html>
	<head>
		<?php include('include/default/meta.php');?>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="block_header">
					<?php include('include/default/header/logo.php');?>
					<?php include('include/default/header/nav.php');?>
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