<?php $site = $site[0];
$map = directory_map('./CMS/screenshots/' . $this->session->userdata('account') . '/');
?>
<div class="breadCrumbHolder module">
	<div id="breadCrumb" class="breadCrumb module">
    	<ul>
		<li>
            	<a href="<?= base_url('app'); ?>">Account Dashboard</a>
            </li>
            <li>
                <a href="<?= base_url('app/sites'); ?>">Manage Sites</a>
            </li>
            <li>
                <a href="<?= base_url('app/sites/dashboard/'  . $site->sid); ?>"><?= $site->url;?></a>
            </li>
            <li>
                <?php echo $template['title']; ?>
            </li>
        </ul>
    </div>
</div>
<h3 class="underline"><?php echo $template['title']; ?></h3>
<div class="scroll flexcroll" style="">
    <ul class="templates">
        <li data-template-id="new"><a href="<?= base_url('app/sites/template/')?>"><img src="<?= base_url('CMS/screenshots/add_template.png')?>"/></a></li>
	<?php foreach($map as $img) {
            $temp_tid = preg_replace("/\\.[^.\\s]{3,4}$/", "", $img);?>
		<li class= "<?= ($tid == $temp_tid)?'selected':'' ?>" data-template-id="<?=$temp_tid?>"><a href="<?= base_url('app/sites/template/')?>"><img src="<?= base_url('CMS/screenshots/' . $this->session->userdata('account') . '/' . $img)?>"/></a></li>
	<?php }?>
    </ul>
    
    
</div>
<form id="template_form" class="formular Form_Block" action="">
    <div class="form-item" >
	<label for="name">
	    <span>*</span>&nbsp;Template Name&nbsp;
	</label>
        <span class="saving_name"><span class="spinner"></span>&nbsp;Saving...</span>
	<input id="name" name="name" type="text" data-type="name" class="validate[required] text-rounded txt-xl" />
    </div>
    <div class="form-item textarea">
        <label for="html_textarea">
	    <span>*</span>&nbsp;HTML Code&nbsp;
	</label>
        <span class="saving_html"><span class="spinner"></span>&nbsp;Saving...</span>
        <textarea style="display:block;" id="html_textarea" name="html" data-type="html" class="validate[required] text-rounded"></textarea>
    </div>
    <div class="form-item textarea">
        <label for="css_textarea">
	    <span>*</span>&nbsp;Cascading Style Sheets(CSS) Code&nbsp;
	</label>
        <span class="saving_css"><span class="spinner"></span>&nbsp;Saving...</span>
        <textarea style="display:block;" id="css_textarea" name="css" data-type="css" class="validate[required] text-rounded"></textarea>
    </div>
    <div class="form-item textarea">
        <label for="html_textarea">
	    <span>*</span>&nbsp;Javascript Code&nbsp;
	</label>
        <span class="saving_js"><span class="spinner"></span>&nbsp;Saving...</span>
        <textarea style="display:block;" id="js_textarea" name="js" data-type="js" class="validate[required] text-rounded"></textarea>
    </div>
    <p>&nbsp;</p>
    <p>
        <a href="#" class="submit button">
	    <span class="save cmsicon"></span><span class="save_text">Add as New Template</span>
	</a>
    </p>
</form>
<style>
    .scroll {
        overflow: auto;
        height:190px;
        margin:0 15px;
        background-color:#999;
        white-space: nowrap;
        -moz-border-radius: 10px;
        border-radius: 10px;
    }
    .scroll img{
        margin: 10px 10px 0 10px;
        border: 5px solid transparent;
    }
    .scroll img:hover, .scroll li.selected img{
        border: 5px solid black;
    }
    .scroll ul {
float:left;
margin-right:-999em;
white-space:nowrap;
list-style:none;
padding: 0;
}
.scroll li {
text-align:center;
float:left;
display:inline;           
}
.scrollgeneric {
line-height:1px;
font-size:1px;
position:absolute;
top:0;left:0;
}
.hscrollerbase {
height:17px;
background:#999;
border-radius: 0 0 10px 10px;
}
.hscrollerbar {
height:12px;
background:#000;
padding:3px;
border:1px solid #999;
}
.hscrollerbar:hover {
background:#222;
border:1px solid #222;
}
textarea {
    height:100px;
    width:100%;
}
.form-item {
    margin:25px 0 0 50px;
    width:80%;
}
.saving_html, .saving_js, .saving_css, .saving_name {
    float:right;
    display: none;
}
.spinner {
    background: url('../../../css/images/indicator.gif') no-repeat;
    display: inline-block;
    width: 18px;
    height: 16px;
}
.Form_Block .textarea label {
    display:inline-block;
}
</style>
<script>
	$(document).ready(function() {
            var template_id = null;
            var typingTimer;
            var haschanged = false;
            
            $('.templates li').bind('click', function() {
                if (!$(this).hasClass('selected')) {
                    $(this).toggleClass('selected').siblings().removeClass('selected');
                }
                template_id = $(this).attr('data-template-id');
                $('form').attr('action', '<?= base_url('app/templates/save/' . $site->sid)?>' + '/' + template_id);
                if (template_id !== "new") {
                    $.ajax('<?= base_url('app/templates/get/')?>'+'/'+template_id,{
                        type: "GET",
                        success: function(data) {
                            $('#html_textarea').val(data.template[0].html);
                            $('#js_textarea').val(data.template[0].js);
                            $('#css_textarea').val(data.template[0].css);
                            $('#name').val(data.template[0].name);
                            $('.save_text').text("Save Template");
                        }
                    });
                }else {
                    $('#html_textarea, #js_textarea, #css_textarea, #name').val("");
                    $('.save_text').text("Add as New Template");
                }
                return false;
            });
            $('textarea, input[type="text"]').bind('keyup', function() {
                var _this = $(this);
                haschanged = true;
                clearTimeout(typingTimer);
                typingTimer= setTimeout(function() {AutoSaveTemplate($(_this).attr('id'), $(_this).data('type'))},1000);
            });
            
            $('.templates li.selected').trigger('click');
            function AutoSaveTemplate(id, type) {
                if (template_id && haschanged && template_id !== "new") {
                    var data = {};
                    data[type] = $('#'+id).val();
                    $('.saving_'+type).fadeIn('slow');
                    $.ajax('<?= base_url('app/templates/save/' . $site->sid)?>'+'/'+template_id,{
                       type: "POST",
                       data: data,
                       success: function(data) {
                            $('.saving_'+type).fadeOut('slow');
                           haschanged = false;
                       }
                   });
                }
            }
        });
</script>