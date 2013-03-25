<?php $site = $site[0];?>
<iframe id="frame_content" frameborder="0" scrolling="no" src="<?= base_url('app/sitebuilder/source/' . $this->uri->segment(4) . '/' . $this->uri->segment(5))?>" data-root="<?= dirname($site->path)
?>" data-url="<?= $site->url ?>" data-site-id="<?= $site->sid ?>"></iframe>
<?php $this->load->view('app/include/modal/confirm'); ?>
<?php $this->load->view('app/include/modal/buttonless'); ?>