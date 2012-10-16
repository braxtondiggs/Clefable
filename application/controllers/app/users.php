<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	$this->output->enable_profiler(FALSE);
    }
    function index(){
        if ($this->has_user_permissions()) {
	    $this->template->title('Users and Permissions');
	    $this->template->set_layout('default_app')->build('app/users/index');
	}
	
    }
    function create() {
	if ($this->has_user_permissions()) {
	    $this->template->title('Add User');
	    $this->template->set('is_new', true);
	    $this->template->set('is_admin', $this->has_user_permissions());
	    $this->template->set_layout('default_app')->build('app/users/create');
	}
    }
    function delete($id=null) {
	if ($this->input->is_ajax_request()) {
	}
    }
    function edit($id=null) {
	$this->template->title('Edit User');
	$this->template->set('id', $id);
	$this->template->set('is_admin', $this->has_user_permissions());
	$this->template->set_layout('default_app')->build('app/users/edit');
    }
    function impersonate($id=null) {
	if ($this->input->is_ajax_request()) {
	}
    }
    function submit($id=null) {
	if ($this->input->is_ajax_request()) {
	    $this->load->library(array('form_validation', 'email'));
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');//|is_unique[users.email]
	    $this->form_validation->set_rules('language', 'Language', 'required');
            $this->form_validation->set_rules('account_type', 'Account Type', 'required|is_natural_no_zero');
            if ($this->input->post('new_password') == true || $id = null) {
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('confirmpassword', 'Confirm Password', 'required|matches[password]');
	    }
            if ($this->form_validation->run() == FALSE) {
                $output = array('status' => "error", 'output' => "<strong>Error: </strong>".validation_errors());
                header('Content-Type: application/json',true);
                echo json_encode($output);
            }else{
                // set email data
                //if ()
		
		if ($id = null) {
		    $username = $this->ion_auth_model->id_generator('users', 'username');
		    $password = set_value('password');
		    $email = set_value('email');
		    $additional_data = array(
			'first_name' => set_value('first_name'),
			'last_name' => set_value('last_name'),
			'user_type' => set_value('account_type'),
			'language' => set_value('language'),
			'has_demo' => 1,
			'provider' => 'CymbitCMS'
		    );
    
		    $data = array('identity' => $email);
		    $message = $this->load->view('auth/welcome.pre-set_user.tpl.php', $data, true);
		    
		    $this->ion_auth->register($username, $password, $email, $additional_data);
		    $this->email->clear();
		    $this->email->from($this->input->post('email'), $this->input->post('name'));
		    $this->email->to('support@cymbit.com');
		    $this->email->reply_to($this->input->post('email'), $this->input->post('name'));
		    $this->email->subject($this->input->post('subject'));
		    $this->email->message($this->input->post('msg'));
		    $this->email->send();
		}else {
		    $this->ion_auth->update($id, array('first_name' => set_value('first_name'), 'last_name' => set_value('last_name'), 'language' => set_value('language')));
		    if ($this->input->post('new_password') == true) {
			$this->ion_auth->update($id, array('password' => set_value('password')));
		    }
			
		}
		
                $output = array('status' => "success", 'output' => '');
                header('Content-Type: application/json',true);
                echo json_encode($output);
            }
        }else{
            show_404();    
        }
    }
    private function has_user_permissions() {//not sure if this works 100%;
	$QID = $this->session->userdata("QID");
	$active_user = $this->ion_auth->user($QID)->result();
	if ($active_user[0]->user_type != 1) {
	    if ($this->input->is_ajax_request()) {
		return FALSE;
	    }else{
		redirect('app/users/edit/'.$QID);
	    }
	}
	return TRUE;
    }
}