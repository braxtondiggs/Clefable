<div id="header">
	<div id="block_header">
		<a href="<? echo base_url();?>" id="headerlogo" class="right">CymbitCMS &raquo; Simple CMS for Web Designers</a>
		<?php
		$active = strtolower($this->uri->segment(1));
		$mclass = 'class="ui-tabs-selected ui-state-active"';
		?>
		<div id="tabs" class="ui-tabs menu left">
			<ul class="ui-tabs-nav">
				<li <?php echo ($active=="")?$mclass:""; ?>><a href="<? echo base_url();?>">Home</a></li>
				<li <?php echo ($active=="tour")?$mclass:""; ?>><a href="#">Tour</a></li>
				<li <?php echo ($active=="3")?$mclass:""; ?>><a href="http://cymbit.com/Register?free">Sign-up</a></li>
				<li <?php echo ($active=="4")?$mclass:""; ?>><a href="http://docs.cymbit.com/">Support</a></li>
				<li <?php echo ($active=="contact")?$mclass:""; ?>><?php echo anchor(base_url().'contact', 'Contact'); ?></li>
				<li <?php echo ($active=="login")?$mclass:""; ?> style="float:right;"><?php echo anchor(base_url().'login', 'Login'); ?></li>
			</ul>
		</div>
		<div class="clr"></div>
	</div>
</div>