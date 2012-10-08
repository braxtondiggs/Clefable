<!DOCTYPE html>
<html>
	<head>
		<?php echo meta('description', 'CymbitCMS is a FREE hosted content management system that\'s actually easy to use, fast to setup and doesn\'t require programming skills.');?>
		<?php echo meta('keywords', 'cms, content management system, hosted, web app, easy, free'); ?>
		<?php echo link_tag('favicon.ico', 'shortcut icon', 'image/ico'); ?>
		<title><?php echo $template['title']; ?> &raquo; CymbitCMS</title>
		<?php echo meta('Content-type', 'text/html; charset=utf-8', 'equiv'); ?>
		<?php echo $template['metadata']; ?>
		<?php Assets::css(array('reset.css', 'typography.css', 'jquery-ui-1.8.10.custom.css', 'base.css')); ?>
		<?php Assets::js(array('jquery.min.js', 'jquery-ui.min.js', 'global.js'));?>
		<?php //Assets::clear_cache(); ?>
	</head>
	<body>
		<div id="wrapper">
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
							<li <?php echo ($active=="5")?$mclass:""; ?>><a href="http://cymbit.com/Contact">Contact</a></li>
							<li <?php echo ($active=="6")?$mclass:""; ?> style="float:right;"><a href="http://cymbit.com/Login">Login</a></li>
						</ul>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<div id="main">
				<div id="main_container">
					<div id="content">
						<?php echo $template['body']; ?>
					</div>
				</div>
				<div class="clr"></div>
			</div>
			<div id="footer">
				<div class="resize">
					<div class="left">
						<?php echo anchor('/', 'Home'); ?> | 
						<?php echo anchor('/', 'Forum'); ?> | 
						<a href="http://store.cymbit.com/"><span>Store</span></a> | 
						<a href="http://docs.cymbit.com/"><span>Support</span></a> | 
						<a href="http://cymbit.com/Contact"><span>Contact</span></a>
					</div>
					<div class="right">
						&#169; <?php echo date('Y');?> Cymbit CMS -
						<?php echo anchor('/privacy', 'Privacy Policy'); ?> |
						<?php echo anchor('/terms', 'Terms of Service'); ?> |
						<?php echo anchor('/sitemap', 'Sitemap'); ?>&nbsp;&nbsp;&nbsp;
					<!--<a href="http://validator.w3.org/check?uri=referer">
							<img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" align="middle"  />
					</a>-->
				       </div>
				</div>
				<p class="clr"></p>
			</div>
		</div>
	</body>
</html>