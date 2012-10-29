<div id="sites_usage" class="sidebar">
    <h3 class="underline">Account Usage</h3>
    <span class="globe cmsicon" style="margin: 2px 5px 0 10px;"></span>
    <strong>Sites: </strong><strong><span id="usage_start"><?= $this->sites->get_num_sites(); ?></span></strong> out of <strong><span id="usage_end"><?= $this->config->item('max_sites'); ?></span></strong>
    <p>
	    <div id="usage_progressbar" style="border: 1px solid #4297D7;"></div>
    </p>
</div>