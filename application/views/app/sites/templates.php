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
	<?php foreach($map as $img) {?>
		<li class="" data-template-id="<?=preg_replace("/\\.[^.\\s]{3,4}$/", "", $img);?>"><a href="<?= base_url('app/sites/template/')?>"><img src="<?= base_url('CMS/screenshots/' . $this->session->userdata('account') . '/' . $img)?>"/></a></li>
	<?php }?>
    </ul>
    
    
</div>
HTML
<textarea style="display:block;" id="html_textarea" data-type="html">
</textarea>
CSS
<textarea style="display:block;" id="css_textarea" data-type="css">
</textarea>
JS
<textarea style="display:block;" id="js_textarea" data-type="js">
</textarea>
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
    .scroll img:hover{
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
</style>
<script>
	$(document).ready(function() {
            var template_id = null;
            var typingTimer;
            var haschanged = false;
            $('.templates').click(function() {
                template_id = $(this).children('li').attr('data-template-id');
                $.ajax('<?= base_url('app/templates/get/')?>'+'/'+template_id,{
                    type: "GET",
                    success: function(data) {
                        $('#html_textarea').val(data.template[0].html);
                        $('#js_textarea').val(data.template[0].js);
                        $('#css_textarea').val(data.template[0].css);
                    }
                });
                return false;
            });
            $('textarea').bind('keyup', function() {
                haschanged = true;
                clearTimeout(typingTimer);
                typingTimer= setTimeout(function() {AutoSaveTemplate($(this).attr('id'), $(this).attr('data-type'))},1000);
            });
            
            function AutoSaveTemplate(id, type) {
                if (template_id && haschanged) {
                    $.ajax('<?= base_url('app/templates/save/')?>'+'/'+template_id,{
                       type: "POST",
                       data: {type: type, content: $('#'+id).val()},
                       success: function(data) {
                           console.log('');
                           haschanged = false;
                       }
                   });
                }
            }
        });
</script>