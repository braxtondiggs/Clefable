<?php
if ($this->session->userdata('user_type') == 1) {?>
    <div id="upgrade_1" class="sidebar">
	<h3 class="underline">Upgrade Account</h3>
	<p>Learn about the benefits of a <strong>Premium Account</strong>, and upgrade now - click below!</p>
	<div style="padding-left: 35px;"><a href="<?= base_url('app#'); ?>" class="button"><span class="crown cmsicon"></span>Upgrade Now</a></div>
    </div>
<?php } ?>
