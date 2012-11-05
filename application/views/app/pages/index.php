<?php $site = $site[0];?>
<div class="breadCrumbHolder module">
    <div id="breadCrumb" class="breadCrumb module">
	<ul>
	    <li>
		<a href="<?= base_url('app'); ?>">Account Dashboard</a>
	    </li>
	    <li>
		<a href="<?= base_url('app/sites/'); ?>">Manage Websites</a>
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
<h3 class="underline"><?= $template['title']; ?></h3>
<p>Your editable pages are listed below. You can click 'edit' on a page to open it in the page editor and change content.</p>
<?php foreach($directories as $directory) {?>
    <a href="<?= base_url('app/pages/manage/'  . $site->sid . '/' . urlencode(base64_encode($url_path . $directory))); ?>" class="site page_folder">
	<span class="icon_lrg folders"></span>
     	<span class="page_menu delete_folder">
	    <span class="delete cmsicon" title="Delete <?= $directory;?> page"></span>
        </span>
	<h4><?= ucwords($directory); ?></h4>
        <p><?=  $url_path . $directory; ?></p>
    </a>
<?php } ?>
<?php foreach($files as $file) {?>
    <a href="<?= base_url('app'); ?>" class="site page">
	<span class="icon_lrg pages"></span>
	<span class="page_menu delete_page">
	    <span class="delete cmsicon" title="Delete <?= $file;?> page"></span>
        </span>
        <span class="page_menu edit_page">
            <span class="edit cmsicon" title="Edit Page"></span>
        </span>
     	<h4><?= ucfirst($file)?></h4>
        <p><?=  $url_path . $file; ?></p>
    </a>
<?php } ?>
<?php $this->load->view('app/include/modal/confirm'); ?>
<?php $this->load->view('app/include/modal/buttonless'); ?>