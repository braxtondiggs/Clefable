<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sitebuilder extends CI_Controller{
    
    function __construct() {
        parent::__construct();
	$this->load->model('Sites_model', 'sites');
	$this->load->model('Pages_model', 'pages');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    //$this->output->enable_profiler(TRUE);
	}
    }
    function pages($sid = null, $path = null) {
	$site = $this->sites->get_site($sid);
	$this->template->set('site', $site);
	$this->template->set_layout('default_sitebuilder')->build('app/sitebuilder/index');
    }
}