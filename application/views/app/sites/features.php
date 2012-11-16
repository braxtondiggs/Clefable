<?php $site = $site[0]; $activate = $activate[0];?>
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
                <a href="<?= base_url('app/sites/dashboard/'  . $site->sid); ?>"><?= $site->url;?></a>
            </li>
            <li>
                <?php echo $template['title']; ?>
            </li>
        </ul>
    </div>
</div>
<h3 class="underline"><?php echo $template['title']; ?></h3>
<p>Use this page to turn site features on and off.</p>
<div class="features" data-class="<?= $site->sid; ?>">
    <div class="half">
        <h4 class="underline">Standard Features</h4>
        <ul class="standard">
            <li>Page Templates<span class="checkbox"><input type="checkbox" id="template" class="iButton" <?= ($activate->template)?'checked="checked"':''; ?> /></span></li>
            <li>Image Gallery<span class="checkbox"><input type="checkbox" id="gallery" class="iButton" <?= ($activate->gallery)?'checked="checked"':''; ?> /></span></li>
            <li>Document Library<span class="checkbox"><input type="checkbox" id="document" class="iButton" <?= ($activate->document)?'checked="checked"':''; ?> /></span></li>
            <li>Content History<span class="checkbox"><input type="checkbox" id="history" class="iButton" <?= ($activate->history)?'checked="checked"':''; ?> /></span></li>
            <li>RSS Feeds<span class="checkbox"><input type="checkbox" id="rss"class="iButton" <?= ($activate->rss)?'checked="checked"':''; ?> /></span></li>
            <li>SEO<span class="checkbox"><input type="checkbox" id="seo" class="iButton" <?= ($activate->seo)?'checked="checked"':''; ?> /></span></li>
        </ul>
    </div>
    <div class="half">
        <h4 class="underline">Premium Features</h4>
        <ul class="premium">
            <li>Navigation Manager<span class="checkbox"><input type="checkbox" id="navigation" class="iButton" <?= ($activate->navigation)?'checked="checked"':''; ?> /></span></li>
            <li>Per-Page Permissions<span class="checkbox"><input type="checkbox" id="page_permission" class="iButton" <?= ($activate->page_permission)?'checked="checked"':''; ?> /></span></li>
        </ul>
        <h4 class="underline">Lab Features (Experimental)</h4>
        <ul class="lab">
            <li>Google Analytics<span class="checkbox"><input type="checkbox" id="analytics" class="iButton" <?= ($activate->analytics)?'checked="checked"':''; ?> /></span></li>
            <li>Image Optimization<span class="checkbox"><input type="checkbox" id="optimization" class="iButton" <?= ($activate->optimization)?'checked="checked"':''; ?> /></span></li>
            <li>Publish Server Side Includes<span class="checkbox"><input type="checkbox" id="includes" class="iButton" <?= ($activate->includes)?'checked="checked"':''; ?> /></span></li>
        </ul>
    </div>
</div>