<?php
if ($this->session->userdata('user_type') == 1) {
$percentage = round(($this->sites->get_num_sites()/$this->config->item('max_sites'))*100);?>
<!-- aside progress bars -->
<ul class="indented aside-progress-stats">
    <li>
	<!-- easy pie chart -->
		<div class="easypie">
			<div class="percentage" data-percent="<?= $percentage?>">
				<span><?= $percentage;?></span>%
			</div>
			<div class="easypie-text">
				Account Usage
			</div>
		</div>
		<!-- end easy pie chart -->
		<div class="center">
		    <a href="<?= base_url('app/sites/create')?>" title="" class="center btn btn-success" style="width: 85%;">Add New Site</a>
		</div>
	</li>
</ul>

<div class="divider"></div>
<?php } ?>