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
	    $this->output->enable_profiler(FALSE);
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
    function save($sid = null, $tid = null) {
        $template = false;
        if ($tid !== "new") {
            $template = $this->templates->update($tid, $sid, $this->input->post(NULL, TRUE));
        }else {
            $template = $this->templates->create($sid, $this->input->post(NULL, TRUE));
            $tid = $template;
            $template = true;
            //add code to generate image here
        }
        if ($template) {
            $output = array('status' => "success", 'redirect' => base_url('app/sites/templates/' . $sid . '/' . $tid));
        }else {
            $output = array('status' => "error");
        }
        header('Content-Type: application/json',true);
        echo json_encode($output);
    }
}