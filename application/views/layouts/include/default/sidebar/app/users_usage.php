<?php
if ($this->session->userdata('user_type') == 1) {
    $percentage = round(($this->ion_auth->get_num_user()/$this->config->item('max_users'))*100);?>
<!-- aside progress bars -->
<ul class="indented aside-progress-stats">
    <li>
	<!-- easy pie chart -->
		<div class="easypie">
			<div class="percentage" data-percent="<?= $percentage?>">
				<span><?= $percentage;?></span>%
			</div>
			<div class="easypie-text">
				Users Used
			</div>
		</div>
		<!-- end easy pie chart -->
                <div class="center">
                    <a href="<?= base_url('app/users/create')?>" title="" class="btn btn-success" style="width: 85%;">Add New User</a>
                </div>
        </li>
</ul>

<div class="divider"></div>
<?php } ?>