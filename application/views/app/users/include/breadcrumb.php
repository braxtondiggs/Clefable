<div class="breadCrumbHolder module">
	<div id="breadCrumb" class="breadCrumb module">
    	<ul>
	    <li>
            	<a href="<?php echo base_url("app");?>">Account Dashboard</a>
            </li>
            <?php if ($this->session->userdata('user_type') == 1) { ?>
		<li>
		    <a href="<?php echo base_url("app/users"); ?>">Users &amp; Permissions</a>
		</li>
	<?php } ?>
            <li>
                <?php echo $template['title']; ?>
            </li>
            
        </ul>
    </div>
</div>