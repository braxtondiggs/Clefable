<div id="smoothmenu_container">
    <div id="smoothmenu1" class="ddsmoothmenu">
	<div id="menu_arrow" class="ui-icon ui-icon-triangle-1-s"></div>
	<ul class="menu_standard">
	    <li style="float: right; margin-right: 65px;">
		<a href="#" class="nothing" style="border-left: 1px solid #778; border-right: 0px;">
		    <span class="smiley cmsicon"></span><?= $this->session->userdata('first_name') . '&nbsp;' . $this->session->userdata('last_name'); ?>
		</a>
		<ul>
		    <li>
			<a href="<?= base_url('app/users/edit/' . $this->session->userdata('QID')); ?>">Change Password</a>
		    </li>
		    <li>
			<a href="<?= base_url('app/logout'); ?>">Logout</a>
		    </li>
		</ul>
	    </li>
	</ul>
	<br style="clear: left" />
    </div>
</div>