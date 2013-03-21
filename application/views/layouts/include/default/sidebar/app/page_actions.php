<?php $site = $site[0]; ?>
<div id="page_actions" class="sidebar">
    <h3 class="underline">Page Actions</h3>
    <div><?php $url_seg = $this->uri->segment(5);?>
	<a href="<?= base_url('app/pages/create/' . $site->sid . '/' . (!empty($url_seg)?$url_seg:urlencode(base64_encode('/')))); ?>" class="button ajax-action">
	    <span class="newpage cmsicon"></span>Create New Page
	</a>
    </div>
    <div>
	<a href="<?= base_url('app/ftp/browse_file/index'); ?>" class="button ajax-page-action">
	    <span class="plus cmsicon"></span>Add Existing Page
	</a>
    </div>
    <div>
	<a href="<?= base_url('app/folders/create/' . $site->sid . '/' . (!empty($url_seg)?$url_seg:urlencode(base64_encode('/')))); ?>" class="button ajax-action">
	    <span class="newfolder cmsicon"></span>Create New Folder
	</a>
    </div>
</div>
<script type="text/javascript">
    $(function() {
	$('.ajax-page-action').click(function() {
	    var action = $(this);
	    $('#dialog-confirm').children('#dialog-confirm-body').html('<div id="fileTree"></div>').find('#fileTree').height('500px');
	    $('#dialog-confirm').dialog({ title: "Add File"}).dialog('open').dialog({buttons: {"Ok": function() {
		$.post('<?= base_url('app/ftp/save_file/' .$site->sid); ?>', {file: $('.jqueryFileTree .selected').attr('rel'), server: '<?= $site->server ?>', username: '<?= $site->ftp_username ?>', password: '<?= $site->ftp_password ?>'}, function() {window.location.reload();});
                        $(this).dialog("close");
                    },
                    "Cancel": function() {
                        $(this).dialog("close");
                    }
		}
	    });
	    $('#fileTree').fileTree({ root: '<?= dirname($site->path) ?>/', script: $(action).attr('href'), server: '<?= $site->server ?>', user: '<?= $site->ftp_username ?>', password: '<?= $site->ftp_password ?>', selected: true}, function(file) {/*empty*/});
	return false;
	});
    });
</script>