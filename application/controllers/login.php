<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('site');
	}
	$this->template->title('Login');
	$this->template->set('css', array('oneall.css', 'validator/validationEngine.jquery.css'));
        $this->template->set('js', array('validator/jquery.validationEngine-en.js', 'validator/jquery.validationEngine.js'));
        $this->template->set_layout('default_wide')->build('login/index');
    }
    function submit() {
        if ($this->input->is_ajax_request()) {
            $this->load->library(array('form_validation', 'ion_auth'));
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
            
	    header('Content-Type: application/json',true);$output = array();
	    if ($this->form_validation->run() == FALSE) {
                $output = array('status' => "error", 'error_type' => 'form', 'output' => "<strong>Error: </strong>".validation_errors());
            }else{
                $identity = set_value('email');
                $password = set_value('password');
                $remember = set_value('remember'); // remember the user
		if (!$this->ion_auth->is_max_login_attempts_exceeded($identity)) {
		    if ($this->ion_auth->login($identity, $password, $remember)) {
			$output = array('status' => "success", 'output' => $this->load->view('contact/submit', '', true));
		    }else{
			$this->ion_auth->increase_login_attempts($identity);
			$output = array('status' => "error", 'error_type' => 'user', 'output' => "<strong>Alert:</strong> Oops! Invalid username / password.");
		    }
		}else{
		    $output = array('status' => "error", 'error_type' => 'max_login', 'output' => "<strong>Alert:</strong> You have too many login attempts.");
		}
            }
	    echo json_encode($output);
        }else{
            show_404();    
        }
    }
    function lost_pass() {
	if ($this->input->is_ajax_request()) {
	    $this->load->library(array('form_validation', 'ion_auth'));
	    $this->form_validation->set_rules('recov_email', 'Email', 'required|valid_email');
	    
	    header('Content-Type: application/json',true);$output = array();
	    if ($this->form_validation->run() == FALSE) {
		$output = array('status' => "error", 'output' => "<strong>Error: </strong>".validation_errors());
	    }else{
		if ($this->ion_auth->forgotten_password($this->input->post('recov_email'))) {
		    $output = array('status' => "success", 'output' => "<strong>It's on the way: </strong>A link to reset your password has been sent to your email address.");
		}else{
		    $output = array('status' => "error", 'output' => "<strong>Error: </strong>We do not have record of account with that email address. Please review the enter email address.");
		}
	    }
	    echo json_encode($output);
	}else{
            show_404();    
        }
    }
    function reset_password($token = null) {
	if ($token !== null) {
	    $this->template->title('Reset Password');
	    $this->template->set('css', array('oneall.css', 'validator/validationEngine.jquery.css'));
	    $this->template->set('js', array('validator/jquery.validationEngine-en.js', 'validator/jquery.validationEngine.js'));
	    $this->template->set('token', $token);
	    $this->template->build('login/reset_password');
	}else {
	    redirect('login');
	}
    }
    function reset_password_submit() {
	if ($this->input->is_ajax_request()) {
	    $this->load->library(array('form_validation', 'ion_auth'));
	    $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
	    $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
	    header('Content-Type: application/json',true);$output = array();
	    if ($this->form_validation->run() == FALSE) {
		$output = array('status' => "error", 'output' => "<strong>Error: </strong>".validation_errors());
	    }else{
		if ($this->ion_auth->forgotten_password_complete($this->input->post('pass_token'), $this->input->post('password'))) {
		    $output = array('status' => "success", 'output' => "<p>&nbsp;</p>Your password has been reset. Please proceed to the ".anchor('login', 'login page').".");
		}else{
		    $output = array('status' => "error", 'output' => "<strong>Error: </strong>The token submited is incorrect, please report this error to us so it can be fixed immediately.");
		}
	    }
	    echo json_encode($output);
	}
    }
}
?>