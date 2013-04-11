<?php $site = $site[0]; $activate = $activate[0];?>
<div id="page-content"  style="padding-bottom:20px;">
	<div class="row-fluid">
	<!-- page header -->
	<h1 id="page-header"><?= $template['title']; ?></h1>
	<p>Use this page to turn site features on and off.</p>
	<div class="features" data-class="<?= $site->sid; ?>">
	    <div class="span6" style="padding: 0 10px;border-right: 1px #CCC solid;">
		<h4 class="underline">Standard Features</h4>
		<ul class="standard">
		    <li><label for="template">Page Templates</label><div class="switch right"><input type="checkbox" id="template" name="template" <?= ($activate->template)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="gallery">Image Gallery</label><div class="switch right"><input type="checkbox" id="gallery" name="gallery" <?= ($activate->gallery)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="document">Document Library</label><div class="switch right"><input type="checkbox" id="document" name="document" <?= ($activate->document)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="history">Content History</label><div class="switch right"><input type="checkbox" id="history" name="history" <?= ($activate->history)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="rss">RSS Feeds</label><div class="switch right"><input type="checkbox" id="rss" name="rss" <?= ($activate->rss)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="seo">SEO</label><div class="switch right"><input type="checkbox" id="seo" name="seo" <?= ($activate->seo)?'checked="checked"':''; ?> /></div></li>
		</ul>
	    </div>
	    <div class="span6" style="padding: 0 10px;">
		<h4 class="underline">Premium Features</h4>
		<ul class="premium">
		    <li><label for="navigation">Navigation Manager</label><div class="switch right"><input type="checkbox" id="navigation" name="navigation" <?= ($activate->navigation)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="page_permission">Per-Page Permissions</label><div class="switch right"><input type="checkbox" id="page_permission" name="page_permission" <?= ($activate->page_permission)?'checked="checked"':''; ?> /></div></li>
		</ul>
		<h4 class="underline">Lab Features (Experimental)</h4>
		<ul class="lab">
		    <li><label for="analytics">Google Analytics</label><div class="switch right"><input type="checkbox" id="analytics" name="analytics" <?= ($activate->analytics)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="optimization">Image Optimization</label><div class="switch right"><input type="checkbox" id="optimization" name="optimization" <?= ($activate->optimization)?'checked="checked"':''; ?> /></div></li>
		    <li><label for="includes">Publish Server Side Includes</label><div class="switch right"><input type="checkbox" id="includes" name="includes" <?= ($activate->includes)?'checked="checked"':''; ?> /></div></li>
		</ul>
	    </div>
	</div>
</div>