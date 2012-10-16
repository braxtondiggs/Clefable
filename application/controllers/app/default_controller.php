<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Default_Controller extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	$QID = $this->session->userdata("QID");
	$active_user = $this->ion_auth->user($QID)->result();
	$url = "";
	if ($active_user[0]->user_type != 1) {
	    $url = "/edit/".$QID;
	}
	$this->template->set('user_url', $url);
        $this->template->title('Account Dashboard');
	$this->template->set_layout('default_app')->build('app/index');
    }
    function logout() {
	$this->load->library('ion_auth');
	$this->ion_auth->logout();
	if ($this->input->is_ajax_request()) {
	    header('Content-Type: application/json',true);
	     $output = array('status' => "success", 'output' => "<strong>Success: </strong>Logout successful.");
	}else{
	     redirect('login');
	}
    }
}