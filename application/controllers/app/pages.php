<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->model('Sites_model', 'sites');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
	}
    }
    function index(){
	$sites = $this->sites->get_site($id);
	$this->template->title('Site Pages');
	$this->template->set('site', $sites);
	$this->template->set_layout('default_app')->build('app/pages/index');
    }
}