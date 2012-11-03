<?php $site = $site[0]; ?>
<div class="breadCrumbHolder module">
	<div id="breadCrumb" class="breadCrumb module">
    	<ul>
        	<li>
            	<a href="<?= base_url('app'); ?>">Account Dashboard</a>
            </li>
            <li>
                <a href="<?= base_url('app/sites'); ?>">Manage Sites</a>
            </li>
	    <li>
		<a href="<?= base_url('app/sites/dashboard' . $site->sid); ?>"><?= $site->url;?></a>
	    </li>
	    <?php foreach($paths as $path) {?>
	    <li>
		<a href="<?= base_url('app/pages/manage/' . $site->sid . '/' . $path['path']); ?>"><?= $path['title']; ?></a>
	    </li>
	    <? } ?>
            <li>
                <?php echo $template['title']; ?>
            </li>
        </ul>
    </div>
</div>
<h3 class="underline"><?php echo $template['title']; ?></h3>
<?php include('include/form.php'); ?>