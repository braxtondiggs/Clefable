<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    //redirect('site');
	}
	$this->template->title('Sign-Up');
	$this->template->set('css', array('oneall.css', 'validator/validationEngine.jquery.css'));
        $this->template->set('js', array('validator/jquery.validationEngine-en.js', 'validator/jquery.validationEngine.js'));
        $this->template->set_layout('default_wide')->build('signup/index');
    }
    function submit() {
        if ($this->input->is_ajax_request()) {
            $this->load->library(array('form_validation', 'ion_auth'));
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
            $this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
            $this->form_validation->set_rules('terms', 'Terms of Service', 'required');
            
	    header('Content-Type: application/json',true);$output =array();
	    if ($this->form_validation->run() == FALSE) {
                $output = array('status' => "error", 'error_type' => 'form', 'output' => "<strong>Error: </strong>".validation_errors());
            }else{
                $username = $this->ion_auth_model->id_generator('users', 'username');
		$password = set_value('password');
		$email = set_value('email');
		$additional_data = array(
                    'first_name' => 'Ben',
		    'last_name' => 'Edmunds',
		);								
		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

		$this->ion_auth->register($username, $password, $email, $additional_data, $group);
		$output = array('status' => "success");
	
            }
	    echo json_encode($output);
        }else{
            show_404();    
        }
    }
    function check_email() {
        if ($this->input->is_ajax_request()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fieldValue', 'Email', 'required|valid_email|is_unique[users.email]');
            $email = set_value('email');
	    
	    header('Content-Type: application/json',true);
	    $arrayToJs = array();$arrayToJs[0] = 'email';
	    if ($this->form_validation->run() == FALSE) {
                $arrayToJs[1] = false;
            }else{
		$arrayToJs[1] = true;
	    }
            echo json_encode($arrayToJs);
        }else{
            show_404();    
        }
    }
}