<div class="breadCrumbHolder module">
    <div id="breadCrumb" class="breadCrumb module">
    	<ul>
            <li>
            	<a href="<?= base_url('app');?>" class="dashboard">Account Dashboard</a>
            </li>
            <li>
                <?= $template['title']; ?>
            </li>
        </ul>
    </div>
</div>
<h3 class="underline"><?= $template['title']; ?></h3>
<p>Click on one of your sites to manage it.</p>
<?php
foreach ($sites as $site) {
    if ($site->active == 1) {?>
        <a href="<?= base_url('app/sites/dashboard' . $site->sid); ?>" class="site_dashboard nav-section">
            <h4 class="underline"><span class="geticon" title="<?= $site->url; ?>"></span><?= $site->name; ?></h4>
            <p>Click to manage user and access.</p>
        </a>
<?php
    }
}
?>
