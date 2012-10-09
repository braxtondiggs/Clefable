<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
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
                if ($this->ion_auth->login($identity, $password, $remember)) {
                    $output = array('status' => "success", 'output' => $this->load->view('contact/submit', '', true));
                }else{
                    $output = array('status' => "error", 'error_type' => 'user', 'output' => "<strong>Alert:</strong> Oops! Invalid username / password.");
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
	    }else{
		$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));
		if ($forgotten) {
		    $this->session->set_flashdata('message', $this->ion_auth->messages());
		    redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
		} else {
		    $this->session->set_flashdata('message', $this->ion_auth->errors());
		    redirect("auth/forgot_password", 'refresh');
		}
	    }
	    echo json_encode($output);
	}else{
            show_404();    
        }
    }
}
?>