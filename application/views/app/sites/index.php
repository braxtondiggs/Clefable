<div class="breadCrumbHolder module">
    <div id="breadCrumb" class="breadCrumb module">
    	<ul>
            <li>
            	<a href="#" class="dashboard">Account Dashboard</a>
            </li>
            <li>
                Manage Sites
            </li>
        </ul>
    </div>
</div>
<h3 class="underline">Manage Sites</h3>
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
		<td>
		    <?= $site->name; ?>
		</td>
		<td>
		    
		</td>
		<td>
		    
		</td>
		<td>
		    
		</td>
		<td>
		    
		</td>
	    </tr>
	<?php } ?>
        <tr>
            <td class="add-userbtn" colspan="5" style="padding:15px 0 15px 50px;font-weight:bold;">
                <a href="<?php echo base_url("app/sites/create");?>">
                    <span class="user-add cmsicon"></span>Register New Site
                </a>
            </td>
        </tr>
    </tbody>
</table>
<?php $this->load->view('app/include/modal/confirm'); ?>