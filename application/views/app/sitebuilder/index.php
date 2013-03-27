<?php $site = $site[0];?>
<iframe id="frame_content" frameborder="0" scrolling="no" src="<?= base_url('CMS/' .$this->session->userdata('account').'/'. $this->uri->segment(4) .base64_decode(urldecode($this->uri->segment(5))))?>" data-root="<?= dirname($site->path)
?>" data-url="<?= $site->url ?>" data-site-id="<?= $site->sid ?>" data-path="<?= $this->uri->segment(5)?>" data-keyword="<?= $site->keyword ?>" ></iframe>
<div id="cymbitcms"></div>
<div id="cymbitcms-contextmenu" class="ddsmoothmenu-v" style="display:none;"> 
<ul> 
	<li><a href="#" class="vborder medit"><span class="pencil_arrow cmsicon"></span> Edit</a></li> 
	<li><a href="#" class="mcut"><span class="blue_cut cmsicon"></span> Cut</a></li>
	<li><a href="#" class="mcopy"><span class="blue_doc cmsicon"></span> Copy</a></li>
	<li><a href="#" class="mpaste"><span class="clip_paste cmsicon"></span> Paste</a>
    	<ul>
        	<li><a href="#" class="vborder paste-mbefore"><span class="curve-arrow-left cmsicon"></span> Before</a></li>
        	<li><a href="#" class="vborder paste-mafter"><span class="curve-arrow-right cmsicon"></span> After</a></li>
        </ul>
    </li>
	<li><a href="#" class="vborder mdelete"><span class="eraser cmsicon"></span> Delete</a></li>
	<li><a href="#" class="mnew"><span class="add cmsicon"></span> New</a>
    	<ul>
        	<li><a href="#" class="vborder new-mbefore"><span class="curve-arrow-left cmsicon"></span> Before</a></li>
            <li><a href="#" class="vborder new-mafter"><span class="curve-arrow-right cmsicon"></span> After</a></li>
        </ul>
   	</li>
</ul>
<br style="clear: left" /> 
</div> 
<?php $this->load->view('app/include/modal/confirm'); ?>
<?php $this->load->view('app/include/modal/buttonless'); ?>