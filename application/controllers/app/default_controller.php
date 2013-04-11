<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_Controller extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->library('ion_auth');
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(FALSE);
	}
    }
    function index(){
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	
	$this->load->model('Sites_model', 'sites');
        $this->template->title('Account Dashboard');
	$this->template->set('sites', $this->sites->get_sites(TRUE));
	$this->template->set('sidebar', array('app/sites_usage', 'app/users_usage'));
	$this->template->set_layout('default_app')->build('app/index');
    }
    function logout() {
	$this->ion_auth->logout();
	if ($this->input->is_ajax_request()) {
	    header('Content-Type: application/json',true);
	     $output = array('status' => "success", 'output' => "<strong>Success: </strong>Logout successful.");
	}else{
	     redirect('login');
	}
    }
}