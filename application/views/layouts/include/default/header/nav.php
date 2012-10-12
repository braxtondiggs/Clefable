<?php
$active = strtolower($this->uri->segment(1));
$mclass = 'class="ui-tabs-selected ui-state-active"';
?>
<div id="tabs" class="ui-tabs menu left">
	<ul class="ui-tabs-nav">
		<li <?php echo ($active=="")?$mclass:""; ?>><?php echo anchor(base_url(), 'Home');?></li>
		<li <?php echo ($active=="tour")?$mclass:""; ?>><a href="#">Tour</a></li>
		<li <?php echo ($active=="signup")?$mclass:""; ?>><?php echo anchor(base_url() . 'signup', 'Sign-Up');?></li>
		<li <?php echo ($active=="4")?$mclass:""; ?>><a href="http://docs.cymbit.com/">Support</a></li>
		<li <?php echo ($active=="contact")?$mclass:""; ?>><?php echo anchor(base_url() . 'contact', 'Contact'); ?></li>
		<li <?php echo ($active=="login")?$mclass:""; ?> style="float:right;"><?php echo anchor(base_url() . 'login', 'Login'); ?></li>
	</ul>
</div>