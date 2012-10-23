<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sites extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
	}
    }
    function index(){
        if ($this->session->userdata('user_type') == 1) {
	    $this->template->title('Manage Sites');
	    $this->template->set_layout('default_app')->build('app/sites/index');
	}else {
	    //$QID = $this->session->userdata("QID");
	    //redirect('app/users/edit/'.$QID);
	}
    }
    function edit($id = null) {
        
    }
    function create() {
        if ($this->session->userdata('user_type') == 1) {    
	    if ($this->ion_auth->get_num_user() > 3) {
		$this->session->set_flashdata('gritter', array($this->lang->line('gritter_max_user')));
		redirect('app/users');
	    }
	    $this->template->title('Site Settings');
	    $this->template->set('is_new', true);
	    $this->template->set_layout('default_app')->build('app/sites/create');
	}else {
	    $QID = $this->session->userdata("QID");
	    redirect('app/users/edit/'.$QID);
	}
    }
    function delete($id=null) {
        
    }
    function status($action = null, $id = null) {
        
    }
    function submit ($id = null) {
        
    }
}