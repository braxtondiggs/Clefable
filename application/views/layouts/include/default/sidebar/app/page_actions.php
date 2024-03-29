<?php $site = $site[0]; 
    $url_seg = $this->uri->segment(5);
    $url_seg = (!empty($url_seg)?urlencode(base64_encode(dirname($site->path) . base64_decode(urldecode($url_seg)))):urlencode(base64_encode(dirname($site->path) . '/')));
    ?>
<!-- aside progress bars -->
<div class="aside-buttons">
    <a href="<?= base_url('app/pages/create/' . $site->sid . '/' . $url_seg); ?>" title="" class="btn btn-success"><span class="cus-doc-text-image"></span>Create New Page</a>
    <a href="<?= base_url('app/ftp/browse_file/index'); ?>" title="" class="btn btn-info"><span class="cus-add"></span>Add Existing Page</a>
    <a href="<?= base_url('app/folders/create/' . $site->sid . '/' . $url_seg); ?>" title="" class="btn btn-warning"><span class=" cus-folder"></span>Create New Folder</a>
</div>
<div class="divider"></div>
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