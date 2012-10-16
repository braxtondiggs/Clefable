<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	$this->output->enable_profiler(TRUE);
    }
    function index(){
        $this->template->title('Users and Permissions');
	$this->template->set_layout('default_app')->build('app/users/index');
    }
    function create() {
	$this->template->title('Add User');
	$this->template->set_layout('default_app')->build('app/users/create');
    }
    function delete($id=null) {
	if ($this->input->is_ajax_request()) {
	}
    }
    function edit($id=null) {
	$this->template->title('Edit User');
	$this->template->set('id', $id);
	$this->template->set_layout('default_app')->build('app/users/edit');
    }
    function impersonate($id=null) {
	if ($this->input->is_ajax_request()) {
	}
    }
}