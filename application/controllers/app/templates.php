<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('Sites_model', 'sites');
	$this->load->model('Templates_model', 'templates');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
	}
    }
    function get($tid = null) {
        $template = $this->templates->get_template($tid);
	if ($template) {
            $this->load->view('app/include/JSON/output_array', array('template' => array('template' => $template)));
	}else {
	    redirect('app/sites');
	}
    }
}