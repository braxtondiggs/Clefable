<?php
if ($this->session->userdata('user_type') == 1) {?>
    <div id="list_sites" class="sidebar">
	<h3 class="underline">Manage Sites</h3>
	<?php foreach($sites as $site) {?>
	    <a href= "<?= base_url('app/sites/dashboard/' . $site->sid);?>"class="site">
		<h4><?= $site->name;?></h4>
		<p>
		    <?= $site->url; ?>
		</p>
	    </a>
	<?php }?>
    </div>
<?php }?>