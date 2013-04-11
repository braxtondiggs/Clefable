<?php $site = $site[0];?>
<div id="page-content" class="page-dash" style="padding-bottom:30px;">
<div class="breadCrumbHolder module">
    <div id="breadCrumb" class="breadCrumb module">
	<ul>
	    <li>
		<a href="<?= base_url('app'); ?>">Account Dashboard</a>
	    </li>
	    <li>
		<a href="<?= base_url('app/sites/dashboard/'  . $site->sid); ?>"><?= $site->url;?></a>
	    </li>
	    <?php $i = -1;$last_index = count($paths) - 1;foreach($paths as $path) {$i++;?>
	    <li>
		<?php if ($i != $last_index) {?>
		    <a href="<?= base_url('app/pages/manage/'  . $site->sid . '/' . $path['path']); ?>"><?= $path['title']; ?></a>
		<?php
		}else{
		    echo $path['title'];
		}?>
	    </li>
	    <?php } ?>
	</ul>
    </div>
</div>
<!-- page header -->
<br />
	<h1 id="page-header"><?= $template['title']; ?></h1>
	<p>Your editable pages are listed below. You can click 'edit' on a page to open it in the page editor and change content.</p>
	<p>&nbsp;</p>
<?php foreach($directories as $directory) {?>
    <div style="position: relative;">
	<a href="<?= base_url('app/pages/manage/'  . $site->sid . '/' . urlencode(base64_encode($url_path . $directory))); ?>" class="site page_folder">
	    <span class="icon_lrg folders"></span>
	    <h4><?= ucwords($directory); ?></h4>
	    <p><?=  $url_path . $directory; ?></p>
	</a>
	<div>
	    <a href="<?= base_url('app/folders/edit/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path)) . '/' . urlencode(base64_encode($directory))); ?>" class="page_menu ajax-action edit_action" title="Edit <?= $directory;?> Folder">
		<span class="cus-pencil"></span>
	    </a>
	    <a href="<?= base_url('app/folders/upload/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path . $directory))); ?>" class="page_menu ajax-action upload_action" title="Quick Upload <?= $directory;?> Folder">
		<span class="cus-award-star-gold"></span>
	    </a>
	    <a href="<?= base_url('app/folders/download/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path . $directory))); ?>" class="page_menu ajax-action download_action" title="Quick Download <?= $directory;?> Folder">
		<span class="cus-arrow-refresh"></span>
	    </a>
	    <a href="<?= base_url('app/folders/delete/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path . $directory))); ?>" class="page_menu ajax-action delete_action" title="Delete <?= $directory;?> Folder">
		<span class="cus-cross"></span>
	    </a>
	</div>
    </div>	
<?php } ?>
<?php foreach($files as $file) {?>
    <div style="position: relative;">
	<a href="<?= base_url('app/sitebuilder/pages/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path . $file))); ?>" class="site page">
	    <span class="icon_lrg pages"></span>
	    <h4><?= ucfirst($file)?></h4>
	    <p><?=  $url_path . $file; ?></p>
	</a>
	<div>
	    <a href="<?= base_url('app/pages/edit/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path)) . '/' . urlencode(base64_encode($file))); ?>" class="page_menu ajax-action edit_action" title="Edit <?= $file;?> Folder">
		<span class="cus-pencil"></span>
	    </a>
	    <a href="<?= base_url('app/pages/upload/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path . $file))); ?>" class="page_menu ajax-action upload_action" title="Quick Upload <?= $file;?> Folder">
		<span class="cus-award-star-gold"></span>
	    </a>
	    <a href="<?= base_url('app/pages/download/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path . $file))); ?>" class="page_menu ajax-action download_action" title="Quick Download <?= $file;?> Folder">
		<span class=" cus-arrow-refresh"></span>
	    </a>
	    <a href="<?= base_url('app/pages/delete/' .  $site->sid . '/' . urlencode(base64_encode($dir . $url_path . $file))); ?>" class="page_menu ajax-action delete_action" title="Delete <?= $file;?> Folder">
		<span class="cus-cross"></span>
	    </a>
	</div>
    </div>

<?php } ?>
</div>
<?php $this->load->view('app/include/modal/confirm'); ?>
<?php $this->load->view('app/include/modal/buttonless'); ?>