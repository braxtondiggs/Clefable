<?php
$seg5 = $this->uri->segment(5);
$seg5_decode = base64_decode(urldecode($seg5));
$site = $site[0];
$path = dirname($site->path);
?>

<div id="smoothmenu_container">
    <div id="smoothmenu1" class="ddsmoothmenu">
	<div id="menu_arrow" class="ui-icon ui-icon-triangle-1-s"></div>
	<ul class="menu_standard">
	    <li style="margin-left: 45px;"><a href="#" class="nothing">File</a>
                <ul>
                    <li>
                        <a href="<?= base_url('app/pages/browse_local/' . $site->sid); ?>" class="mopen">Open</a>
                    </li>
                    <li>
                        <a href="#">Save</a>
                    </li>
                    <li>
                        <a href="#">Save As</a>
                        <ul>
                            <li>
                                <a href="#">New File</a>
                            </li>
                            <li>
                                <a href="#">New Template</a>
                            </li>
                        </ul>
                    </li>
                    <li><?php $cut = substr(dirname($seg5_decode), 0, strlen($path)); ?>
                        <a href="<?= base_url('app/pages/manage/' . $this->uri->segment(4)) . '/' . urlencode(base64_encode((($cut == $path)?substr(dirname($seg5_decode), strlen($path)):dirname($seg5_decode))))?>" class="close_app">Close</a>
                    </li>
                </ul>
            </li>
        <li>
            <a href="#" class="nothing">Edit</a>
            <ul>
                <!--<li>
                    <a href="#">Undo</a>
                </li>
                <li>
                    <a href="#">Redo</a>
                </li>-->
                <li>
                    <a href="#" class="mcut">Cut</a>
                </li>
                <li>
                    <a href="#" class="mcopy">Copy</a>
                </li>
                <li>
                    <a href="#" class="mpaste">Paste</a>
                </li>
                <li>
                    <a href="#" class="msearch">Find & Replace</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="nothing">View</a>
            <ul>
  		<li>
                    <a href="#" class="mpreview">Preview</a>
                </li>
                <li>
                    <a href="#" class="mlive">Live View</a>
                </li>
                <li>
                    <a href="#" class="msource">Source</a>
                </li>
            </ul>
        </li>
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