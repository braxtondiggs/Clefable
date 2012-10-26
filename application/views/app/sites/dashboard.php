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
                <?= $site->url;?>
            </li>
        </ul>
    </div>
</div>
<h3 class="underline"><?= $template['title']; ?></h3>
<p>Start editing your site, images, documents or templates from here.</p>
<a href="<?= base_url('app/pages'); ?>" class="nav-section sitemap">
    <h4 class="underline">
        <span class="sitemap_blue cmsicon"></span>Site Pages
    </h4>
    <p>Click to open the sitemap.</p>
</a>
<a href="<?= base_url('app'); ?>" class="nav-section assets">
    <h4 class="underline">
        <span class="image_icon cmsicon"></span>Digital Assets
    </h4>
    <p>Organize your various digital assets.</p>
</a>
<a href="<?= base_url('app'); ?>" class="nav-section doc_assets">
    <h4 class="underline">
        <span class="doc-pdf cmsicon"></span>Manage Documents
    </h4>
    <p>Add or edit documents in your library.</p>
</a>
<a href="<?= base_url('app/sites/template'); ?>"class="nav-section templates">
    <h4 class="underline">
        <span class="blue-documents cmsicon"></span>Manage Templates
    </h4>
    <p>Click here to manage your templates.</p>
</a><!--
	<?php //if ($_SESSION['Type'][$_SESSION['me']] == 0) {?>
    <div class="nav-section activate">
		<h4 class="underline"><span class="switch cmsicon"></span>Activate Features</h4>
		<p>Use this page to turn site features on and off.</p>
	</div>
	<?php //if ($SID !== "XOujlec") { ?>-->
<a href="<?= base_url('app/sites/edit/' . $site->sid);?>" class="nav-section edit_site">
    <h4 class="underline">
        <span class="ham_screw cmsicon"></span>Site Settings
    </h4>
    <p>Click to manage intergration settings.</p>
</a>