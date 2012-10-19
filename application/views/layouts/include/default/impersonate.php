<?php if($this->session->userdata('impersonate')) { ?>
    <div class="impersonate_warning">
	You are currently in impersonate mode, <a href="<?= base_url('app/users/impersonate/deactivate/'.$this->session->userdata('identity_QID')); ?>" class="ajax-action">click here to return to your original account.</a>
    </div>
<?php }?>