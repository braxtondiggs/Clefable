<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Signup extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->library('ion_auth');
	if ($this->ion_auth->logged_in()) {
	    redirect('app');
	}
	$this->template->title('Sign-Up');
        $this->template->build('signup/index');
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
                    'first_name' => 'New',
		    'last_name' => 'User',
		    'user_type' => 1,
		    'language' => 'en',
		    'has_demo' => 1,
		    'provider' => 'CymbitCMS'
		);

		$data = array('identity' => set_value('email'));
		$message = $this->load->view('auth/welcome.tpl.php', $data, true);
		$this->ion_auth->register($username, $password, $email, false, $additional_data);
		$this->email->clear();
		$this->email->from('no-reply@cymbit.com', 'CymbitCMS');
                $this->email->to($this->input->post('email'));
                $this->email->subject("Welcome to Cymbit CMS");
                $this->email->message($message);
                $this->email->send();
		$output = array('status' => "success", 'redirect' => base_url('app'));
		$this->session->set_flashdata('gritter', array($this->lang->line('gritter_welcome')));
	
            }
	    Assets::clear_cache();
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