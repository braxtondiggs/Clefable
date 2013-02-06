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
		<li class=""><a href="<?= base_url('app/sites/template/')?>"><img src="<?= base_url('CMS/screenshots/' . $this->session->userdata('account') . '/' . $img)?>"/></a></li>
	<?php }?>
    </ul>
    
    
</div>
HTML
<textarea style="display:block;">
	
</textarea>
CSS
<textarea style="display:block;">
	
</textarea>
JS
<textarea style="display:block;">
	
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
	$('.templates').click(function() {
			
	});
</script>