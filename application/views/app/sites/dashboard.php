<?php $site = $site[0]; ?>
<div class="breadCrumbHolder module">
    <div id="breadCrumb" class="breadCrumb module">
        <ul>
    	<li>
                <a href="<?= base_url('app'); ?>">Account Dashboard</a>
            </li>
            <li>
                <a href="<?= base_url('app/sites/'); ?>">Manage Websites</a>
            </li>
            <li>
                <?= $site->url;?>
            </li>
        </ul>
    </div>
</div>
<h3 class="underline"><?= $template['title']; ?></h3>
<p>Start editing your site, images, documents or templates from here.</p>
<a href="<?= base_url('app/pages/manage/' . $site->sid); ?>" class="nav-section sitemap">
    <h4 class="underline">
        <span class="sitemap_blue cmsicon"></span>Site Pages
    </h4>
    <p>Click to open the sitemap.</p>
</a>
<a href="<?= base_url('app/ftp/assets/' . $site->sid); ?>" class="nav-section assets-action">
    <h4 class="underline">
        <span class="image_icon cmsicon"></span>Digital Assets
    </h4>
    <p>Organize your various digital assets.</p>
</a>
<a href="<?= base_url('app'); ?>" class="nav-section doc_assets">
    <h4 class="underline">
        <span class="doc-pdf cmsicon"></span>Manage Documents
    </h4>
    <p>Add or edit documents in your library.</p>
</a>
<a href="<?= base_url('app/sites/template'); ?>"class="nav-section templates">
    <h4 class="underline">
        <span class="blue-documents cmsicon"></span>Manage Templates
    </h4>
    <p>Click here to manage your templates.</p>
</a><!--
	<?php //if ($_SESSION['Type'][$_SESSION['me']] == 0) {?>
    <div class="nav-section activate">
		<h4 class="underline"><span class="switch cmsicon"></span>Activate Features</h4>
		<p>Use this page to turn site features on and off.</p>
	</div>
	<?php //if ($SID !== "XOujlec") { ?>-->
<a href="<?= base_url('app/sites/edit/' . $site->sid);?>" class="nav-section edit_site">
    <h4 class="underline">
        <span class="ham_screw cmsicon"></span>Site Settings
    </h4>
    <p>Click to manage intergration settings.</p>
</a>
<script type="text/javascript">
    $(function() {
	$('.assets-action').click(function() {
	    $('#dialog-buttonless').css({'min-height':'600px', 'padding': '.5em 0px'}).dialog({ title: "Assets Manager", width: '90%'}).dialog('open');
	    $('#dialog-buttonless #manager').fileTree({ root: '/', script: '<?= base_url('app/ftp/browse_file/img/' . $site->sid); ?>', server: '<?= $site->server ?>', user: '<?= $site->ftp_username ?>', password: '<?= $site->ftp_password ?>', path: '<?= $site->path ?>', multiFolder: false, getFolder: true}, function(file) { //once connection has been established
		if (file !== null) {
		    var img = file.substr(0, file.length-1).split(',');//array of files returned 
		    var len=img.length;
		    $("#assets").empty();//clear empty images
		    for(var i=0; i<len; i++) {//go throughall files
			$("#assets").append('<div id="digitalimg_'+i+'"class="asset_img_cont"><img class="asset_img" src="'+jQuery.trim($(".breadCrumb").find("li:last").text())+img[i]+'" style="display:none;" /></div>');//Add images to DOM to choose from 
		    }
		}
	    });
	    $("#assest_manager, #asset_body").height(function() { return ($("#ModalWindow").parents('#dialog-buttonless').height() -5);});//custom fit dialog to size of window screen
	return false;
	});
    });
</script>
<?php
$data['html'] = '<div id="ModalWindow">' . $this->load->view('app/include/modal/HTML/assets', '', TRUE) . '</div>';
$this->load->view('app/include/modal/buttonless', $data); ?>
