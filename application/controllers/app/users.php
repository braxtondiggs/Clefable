<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
	}
    }
    function index(){
        if ($this->session->userdata('user_type') !== 1) {
	    $this->template->title('Users and Permissions');
	    $this->template->set_layout('default_app')->build('app/users/index');
	}else {
	    $QID = $this->session->userdata("QID");
	    redirect('app/users/edit/'.$QID);
	}
	
    }
    function create() {
	if ($this->session->userdata('user_type') == 1) {    
	    if ($this->ion_auth->get_num_user() > 3) {
		$this->session->set_flashdata('gritter', array($this->lang->line('gritter_max_user')));
		redirect('app/users');
	    }
	    $this->template->title('Add User');
	    $this->template->set('is_new', true);
	    $this->template->set_layout('default_app')->build('app/users/create');
	}else {
	    $QID = $this->session->userdata("QID");
	    redirect('app/users/edit/'.$QID);
	}
    }
    function delete($id=null) {
	$redirect = "";
	if ($this->input->is_ajax_request()) {
	    if ($id !== null) {  
		if ($this->ion_auth->has_ownership($id)) {
		    $this->ion_auth->delete_user($id);
		    $output = array('status' => "succcess", 'redirect' => $redirect, 'output' => '');
		}else {
		    $output = array('status' => "error", 'redirect' => $redirect, 'output' => 'You do not have privliges to modify thtat account');
		}
	    }else {
		$output = array('status' => "error", 'redirect' => $redirect, 'output' => 'No user was selected');
	    }
	    header('Content-Type: application/json',true);
            echo json_encode($output);
	}else {
	    show_404();
	}
    }
    function edit($id=null) {
	$QID = $this->session->userdata("QID");
	if ($id !== null) {  
	    if ($this->ion_auth->has_ownership($id)) { 	
		$this->template->title('Edit User');
		$this->template->set('id', $id);
		$this->template->set_layout('default_app')->build('app/users/edit');
	    }else {
		redirect('app/users/edit/'.$QID);
	    }
	}else {
	    redirect('app/users/edit/'.$QID);
	}
    }
    function impersonate($action = null, $id=null) {
	if ($this->input->is_ajax_request()) {
	    if ($id !== null || $action !== null) {  
		if ($this->ion_auth->has_ownership($id)) {
		    if ($action == "activate") {//get users info
			$this->session->set_userdata(array('username' => $id));
		    }else if($action == "deactivate"){
			$this->session->set_userdata(array('username' => $id));
		    }else{
			
		    }
		}
	    }
	}else{
	    show_404();
	}
    }
    function submit($id=null) {
	if ($this->input->is_ajax_request()) {
	    $this->load->library(array('form_validation', 'email'));
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            if ($id == null) {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
	    }else {
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
	    }
	    $this->form_validation->set_rules('language', 'Language', 'required');
            if ($this->session->userdata('account_type') != 1) {
		$this->form_validation->set_rules('account_type', 'Account Type', 'required|is_natural_no_zero');
	    }
            if ($this->input->post('new_password') == true || $id == null) {
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
	    }
            if ($this->form_validation->run() == FALSE) {
                $output = array('status' => "error", 'output' => "<strong>Error: </strong>".validation_errors());
            }else{
		$password = set_value('password');
		$email = set_value('email');
		$first_name = set_value('first_name');
		$last_name = set_value('last_name');
		if ($id == null) {//create
		    $username = $this->ion_auth_model->id_generator('users', 'username');
		    $additional_data = array(
			'first_name' => $first_name,
			'last_name' => $last_name,
			'user_type' => (int)$this->input->post('account_type'),
			'language' => set_value('language'),
			'has_demo' => 1,
			'provider' => 'CymbitCMS'
		    );
    
		    $data = array('identity' => $email, 'first_name' => $first_name, 'last_name' => $last_name, 'active_first_name' => $this->session->userdata("first_name"), 'active_last_name' => $this->session->userdata("last_name"), 'active_email' => $this->session->userdata("email"), 'password' => $password);
		    $message = $this->load->view('auth/welcome.add_user.tpl.php', $data, true);
		    
		    $this->ion_auth->register($username, $password, $email, $this->session->userdata("account"), $additional_data);
		    $this->email->clear();
		    $this->email->from("support@cymbit.com", "CymbitCMS Support");
		    $this->email->reply_to($this->session->userdata("email"), $this->session->userdata("first_name") . " " . $this->session->userdata("last_name"));
		    $this->email->to($email);
		    $this->email->subject($this->session->userdata("first_name") . " " . $this->session->userdata("last_name") ." has invited you to a CymbitCMS shared account");
		    $this->email->message($message);
		    $this->email->send();
		    
		    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_user_add'), $this->lang->line('gritter_editor_email')));
		    $output = array('status' => "success", 'output' => '','redirect' => base_url('app/users'));
		}else {//edit
		    $gritter = array();
		    $this->ion_auth->update($id, array('first_name' => set_value('first_name'), 'last_name' => set_value('last_name'), 'email' => set_value('email'), 'language' => set_value('language')));
		    if ($this->input->post('new_password') == true) {//Password Change
			if ($this->session->userdata("QID") !== $id) {
			    array_push($gritter, $this->lang->line('gritter_password_email'));
			     $data = array('identity' => $email, 'first_name' => $first_name, 'last_name' => $last_name, 'active_first_name' => $this->session->userdata("first_name"), 'active_last_name' => $this->session->userdata("last_name"), 'active_email' => $this->session->userdata("email"), 'password' => $password);
			    $this->email->clear();
			    $this->email->from("support@cymbit.com", "CymbitCMS Support");
			    $this->email->reply_to($this->session->userdata("email"), $this->session->userdata("first_name") . " " . $this->session->userdata("last_name"));
			    $this->email->to($email);
			    $this->email->subject($this->session->userdata("first_name") . " " . $this->session->userdata("last_name") ." has changed your password");
			    $message = $this->load->view('auth/password_change.tpl.php', $data, true);
			    $this->email->message($message);
			    $this->email->send();
			}
			$this->ion_auth->update($id, array('password' => set_value('password')));
		    }
		    if ($this->session->userdata('account_type') != 1) {
			$this->ion_auth->update($id, array('user_type' => set_value('account_type')));
		    }
		    if ($this->session->userdata("QID") === $id) {
			array_push($gritter, $this->lang->line('gritter_self_edit'));
		    }else{
			array_push($gritter, $this->lang->line('gritter_user_edit'));
		    }
		    $this->session->set_flashdata('gritter', $gritter);
		    $output = array('status' => "success", 'redirect' => base_url('app/users'), 'output' => '');
		}
            }
	    header('Content-Type: application/json',true);
            echo json_encode($output);
        }else{
            show_404();    
        }
    }
}