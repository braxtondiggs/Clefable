<p>Select the template and enter the file name for your new page.</p>
<form id="new_page_form" class="formular Form_Block">
    <div class="form-item">
        <label for="file">
            <span>*</span>&nbsp;File Name
        </label>
        <input id="file" name="file" type="text" class="validate[required] text-rounded txt-xl" value="<?= base64_decode(urldecode($input)) ?>">
    </div>
    <?php if ($action === 'create') { ?>
        <div class="form-item">
            <label for="has_template">
                Use a Template?
            </label>
            <input type="checkbox" id="has_template" name="has_template" />
            
        </div>
        <div class="form-item scroll-item" style="display:none;margin-top:10px;">
            <?php
            $map = directory_map('./CMS/screenshots/' .  $this->session->userdata('account') . '/' . $sid);
            if (!empty($map)) { ?>
                <div class="scroll flexcroll" style="margin:0;">
                    <ul class="templates">
                        <?php
                        foreach($map as $img) {
                            $temp_tid = preg_replace("/\\.[^.\\s]{3,4}$/", "", $img);?>
                                <li data-template-id="<?=$temp_tid?>"><a href="<?= base_url('app/sites/template/')?>"><img src="<?= base_url('CMS/screenshots/' . $this->session->userdata('account') . '/' . $sid . '/' . $img)?>"/></a></li>
                        <?php }?>
                    </ul>
                </div>
            <?php }else {?>
                <p>You do not have any templates setup yet!
                <br /><a href="<?= base_url('app/sites/templates/' . $sid)?>">To create a template, visit here first.</a></p>
            <?php } ?>
        </div>
    <?php } ?>
</form>
<script>
	$(document).ready(function() {
            $('#has_template').bind("click", function() {
                $('.scroll-item').slideToggle('slow');
            });
        });
</script>