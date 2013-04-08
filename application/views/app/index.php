<div id="page-content">
	<!-- page header -->
	<h1 id="page-header"><?= $template['title']; ?></h1>
	<p>Click on one of your sites to manage it.</p>
	<p>&nbsp;</p>
	<?php
	foreach ($sites as $site) {
	    if ($site->active == 1) {?>
		<a href="<?= base_url('app/sites/dashboard/' . $site->sid); ?>" class="nav-section" style="height:auto;">
		    <h4 class="underline"><span class="geticon" data-url="<?= $site->url;?>"></span><?= $site->name; ?></h4>
		    <img src="<?= base_url('CMS/screenshots/' . $this->session->userdata('account') . '/' . $site->sid . '.jpg')?>"/>
		</a>
	<?php
	    }
	}
	?>
</div>