<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
    }
    function index(){
        $this->template->title('Users and Permissions');
	$this->template->set_layout('default_app')->build('app/users/index');
	$this->output->enable_profiler(TRUE);
    }
    function create() {
	$this->template->title('Users and Permissions');
	$this->template->set_layout('default_app')->build('app/users/create');
    }
    function edit($id=null) {
	$this->template->title('Users and Permissions');
	$this->template->set_layout('default_app')->build('app/users/edit');
    }
}