<div id="page-content" class="dashboard">
	<!-- page header -->
	<h1 id="page-header"><?= $template['title']; ?></h1>
	<p>Click on one of your sites to manage it.</p>
	<p>&nbsp;</p>
	<?php
	foreach ($sites as $site) {
	    if ($site->active == 1) {?>
		<a href="<?= base_url('app/sites/dashboard/' . $site->sid); ?>" class="nav-section" style="height:auto;">
		    <h4 class="underline"><span class="geticon" data-url="<?= $site->url;?>"></span><?= $site->name; ?></h4>
		    <img class="dash-screenshot" src="<?= base_url('CMS/screenshots/' . $this->session->userdata('account') . '/' . $site->sid . '/main.jpg')?>"/>
		</a>
	<?php
	    }
	}
	if ($this->session->userdata('user_type') == 1) {?>
	<a href="<?= base_url('app/sites/create'); ?>" class="nav-section" style="height:auto;">
		    <h4 class="underline"><span class="left icon-plus" style="color: green"></span>Add New Site</h4>
		    <img class="dash-screenshot" src="<?= base_url('CMS/screenshots/add_template.png')?>"/>
		</a>
		<?php } ?>
</div>