<?php
class MY_App extends CI_Input {

    function __construct()
    {
        parent::__construct();
    }

    public function is_valid_url($str) {
	$this->form_validation->set_message('_is_valid_url', 'Your URL is incorrect');
	return false;
	if(!filter_var($str, FILTER_VALIDATE_URL)) {
	    $this->form_validation->set_message('_is_valid_url', 'Your URL is incorrect');
	    return FALSE;
	} else {
	    return TRUE;
        }
    }
}