<?php
$enable = '<span class="status-green cmsicon"></span><span>enabled</span>';
$disable = '<span class="status-red cmsicon"></span><span>disabled</span>';
?>
<div class="breadCrumbHolder module">
    <div id="breadCrumb" class="breadCrumb module">
    	<ul>
            <li>
            	<a href="<?= base_url('app');?>" class="dashboard">Account Dashboard</a>
            </li>
            <li>
                <?= $template['title']; ?>
            </li>
        </ul>
    </div>
</div>
<h3 class="underline"><?= $template['title']; ?></h3>
<p>Click on one of your sites to manage it.</p>
<table id="manage_siteTable" class="table-standard">
    <thead>
        <tr>
            <th scope="col" id="Name">Name</th>
            <th scope="col" id="Url">Url</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
	</tr>
    </thead>
    <tbody>
        <?php foreach ($sites as $site) { ?>
	    <tr>
		<td style="max-width: 150px;">
		    <span class="geticon" data-url="<?= $site->url;?>"></span>
		    <a href="<?= base_url('app/sites/dashboard/' . $site->sid); ?>" class="<?= ($site->active == 0)? 'disabled-link' : '';?>">
			<?= $site->name; ?>
		    </a>
		</td>
		<td style="max-width: 150px;">
		    <?= (($site->active == 0) ? '<span class="disabled-text">':'<span>').str_replace(array('http://', 'https://'), "", $site->url);?></span>
		</td>
		<td>
		    <a href="<?= base_url('app/sites/edit/' . $site->sid); ?>"><span class="edit-doc cmsicon"></span>edit</a>
		</td>
		<td>
		    <?php
		    if ($site->active == 0) {
			echo anchor(base_url('app/sites/status/enable/' . $site->sid), $disable, array('class' => 'ajax-action site_status'));
		    }else if ($site->active == 1) {
			echo anchor(base_url('app/sites/status/disable/' . $site->sid), $enable, array('class' => 'ajax-action site_status'));
		    }
		    ?>
		</td>
		<td>
		    <a href="<?= base_url('app/sites/delete/confirm/' . $site->sid);?>" class="ajax-action">
			<span class="delete cmsicon"></span>delete
		    </a>
		</td>
	    </tr>
	<?php } ?>
        <tr>
            <td class="add-userbtn" colspan="5" style="padding:15px 0 15px 50px;font-weight:bold;">
                <a href="<?php echo base_url("app/sites/create");?>">
                    <span class="newsite cmsicon"></span>Register New Site
                </a>
            </td>
        </tr>
    </tbody>
</table>
<?php $this->load->view('app/include/modal/confirm'); ?>