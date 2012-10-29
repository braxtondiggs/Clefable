<?php $site = $site[0]; ?>
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
		<a href="<?= base_url('app/sites/dashboard'); ?>"><?= $site->url;?></a>
	    </li>
	    <li>
		<?php //echo($dir != 0)?"<a href=\"#\" class=\"sitemap\">".$root_txt."</a>":$root_txt;?>		
	    </li>
	    <?php /*
			    if ($dir != 0) {
				    $explode_menu = explode("/", $path);
				    $count = count($explode_menu);
				    foreach($explode_menu as $i => $val) {
					    echo "<li>".((($count-1) != $i)?"<a href=\"#\"  rel=\"".$path."\" class=\"page_crumb\">":"").ucfirst($val)." Folder".((($count-1) != $i)?"</a>":"")."</li>";//page_folder
				    }
			    }*/ ?>
	</ul>
    </div>
</div>
<h3 class="underline"><?= $template['title']; ?></h3>
<p>Your editable pages are listed below. You can click 'edit' on a page to open it in the page editor and change content.</p>