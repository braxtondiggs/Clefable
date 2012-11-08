<?php
if (!empty($this->session)) {
	$gritter = $this->session->flashdata('gritter');
	if (!empty($gritter) || ! empty($gritter_instant)) {
		$gritter = (is_array($gritter))?$gritter:array();$gritter_instant = (is_array($gritter_instant))?$gritter_instant:array();
		//$gritter_merge = array_merge($gritter, $gritter_instant);
		//echo print_r($gritter_merge);
		foreach($gritter as $key) {
			echo '<div class="gritter-notify" style="display:none;">
				<span class="gritter-title">' . $key['title'] . '</span>
				<span class="gritter-text">' . $key['text'] . '</span>
				<span class="gritter-icon">' . $key['icon'] . '</span>
			</div>';
		}
		
	}
}?>
<div id="footer">
	<div class="resize">
		<div class="left">
			<?php echo anchor('/', 'Home'); ?> | 
			<?php echo anchor('/', 'Forum'); ?> | 
			<a href="http://store.cymbit.com/"><span>Store</span></a> | 
			<a href="http://docs.cymbit.com/"><span>Support</span></a> | 
			<?php echo anchor(base_url().'contact', 'Contact'); ?>
		</div>
		<div class="right">
			&#169; <?php echo date('Y');?> Cymbit CMS -
			<?php echo anchor(base_url().'privacy', 'Privacy Policy'); ?> |
			<?php echo anchor(base_url().'terms', 'Terms of Service'); ?> |
			<?php echo anchor(base_url().'sitemap', 'Sitemap'); ?>&nbsp;&nbsp;&nbsp;
		<!--<a href="http://validator.w3.org/check?uri=referer">
				<img src="http://www.w3.org/Icons/valid-xhtml10-blue" alt="Valid XHTML 1.0 Transitional" height="31" width="88" align="middle"  />
		</a>-->
	       </div>
	</div>
	<p class="clr"></p>
</div>