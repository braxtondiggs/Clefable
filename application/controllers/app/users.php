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
        if ($this->session->userdata('user_type') == 1) {
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
    function delete($status = null, $id=null) {
	$output = array('status' => 'fail');
	if ($this->input->is_ajax_request()) {
	    if ($id !== null && $this->ion_auth->username_check($id)) {
		if ($status === "confirm") {
		    if ($id === $this->session->userdata("QID")) {
			if  ($this->session->userdata("user_type") == 1) {
			    $output = array('status' => "success", 'dialog' => 'confirm', 'redirect' => base_url('app/users/delete/approved/' . $id), 'output' => array('title' => 'Are you sure?', 'text' => 'Are you sure you want to delete your account? You will be logged out and everything related to your account will be removed, if you are the only administrative user on the account.'));
			}else if ($this->session->userdata("user_type") != 1) {
			    $output = array('status' => "success", 'dialog' => 'confirm', 'redirect' => base_url('app/users/delete/approved/' . $id), 'output' => array('title' => 'Are you sure?', 'text' => 'Are you sure you want to delete your account? You will be logged out and all of your information will be removed permanently.'));
			}
		    }else {
			$output = array('status' => "success", 'dialog' => 'confirm', 'redirect' => base_url('app/users/delete/approved/' . $id), 'output' => array('title' => 'Are you sure?', 'text' => 'Are you sure you want to delete this user?'));
		    }
		}else if($status === "approved") {
		    if ($this->ion_auth->has_ownership($id)) {
			if ($this->ion_auth->is_only_admin()) {
			    $output = array('status' => 'reload');
			}else {
			    $output = array('status' => "succcess", 'action' => 'delete', 'output' => array('id' => $id, 'gritter' => $this->lang->line('gritter_user_delete')));
			}
			$this->ion_auth->delete_user($id);
		    }else {
			$output = array('status' => 'fail');
		    }
		}
	    }
	    header('Content-Type: application/json',true);
            echo json_encode($output);
	}else {
	    show_404();
	}
    }
    function edit($id=null) {
	$QID = $this->session->userdata("QID");
	if ($id !== null && $this->ion_auth->username_check($id)) {  
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
	    $output = array('status' => "fail");
	    if ($id !== null || $action !== null) {
		if ($this->ion_auth->username_check($id)) {
		    if ($this->ion_auth->has_ownership($id)) {
			$user = $this->ion_auth->user($id)->row();
			$this->session->set_userdata(array('QID' => $id, 'first_name' => $user->first_name, 'last_name' => $user->last_name, 'email' => $user->email));
			if ($action == "activate") {
			    if($this->session->userdata("user_type") == 1) {
				$this->session->set_userdata('impersonate', true);
				$this->session->set_flashdata('gritter', array($this->lang->line('gritter_impersonate'), $this->lang->line('gritter_impersonate_exit')));
			    }
			}else{
			    $this->session->unset_userdata('impersonate');
			    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_impersonate_done')));
			}
			$this->session->set_userdata('user_type', $user->user_type);
			$output = array('status' => "success", 'redirect' => base_url('app'));
		    }
		}
	    }
	    header('Content-Type: application/json',true);
            echo json_encode($output);
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
		    if ($this->session->userdata('user_type') == 1 && $this->ion_auth->get_num_user() <= 3) {
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
			$this->email->from("no-reply@cymbit.com", "CymbitCMS");
			$this->email->reply_to($this->session->userdata("email"), $this->session->userdata("first_name") . " " . $this->session->userdata("last_name"));
			$this->email->to($email);
			$this->email->subject($this->session->userdata("first_name") . " " . $this->session->userdata("last_name") ." has invited you to a CymbitCMS shared account");
			$this->email->message($message);
			$this->email->send();
			
			$this->session->set_flashdata('gritter', array($this->lang->line('gritter_user_add'), $this->lang->line('gritter_editor_email')));
			$output = array('status' => "success", 'output' => '','redirect' => base_url('app/users'));
		    }else{
			$output = array('status' => "fail");
		    }
		}else {//edit
		    if ($this->ion_auth->username_check($id)) {
			if (!$this->ion_auth->is_my_email($email)) {
			    $gritter = array();$redirect = base_url('app/users');
			    $this->ion_auth->update($id, array('first_name' => set_value('first_name'), 'last_name' => set_value('last_name'), 'email' => set_value('email'), 'language' => set_value('language')));
			    if ($this->input->post('new_password') == true) {//Password Change
				if ($this->session->userdata("QID") !== $id) {
				    array_push($gritter, $this->lang->line('gritter_password_email'));
				     $data = array('identity' => $email, 'first_name' => $first_name, 'last_name' => $last_name, 'active_first_name' => $this->session->userdata("first_name"), 'active_last_name' => $this->session->userdata("last_name"), 'active_email' => $this->session->userdata("email"), 'password' => $password);
				    $this->email->clear();
				    $this->email->from("no-reply@cymbit.com", "CymbitCMS");
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
			    }else {
				$redirect = base_url('app');
			    }
			    if ($this->session->userdata("QID") === $id) {
				array_push($gritter, $this->lang->line('gritter_self_edit'));
			    }else{
				array_push($gritter, $this->lang->line('gritter_user_edit'));
			    }
			    $this->session->set_flashdata('gritter', $gritter);
			    $output = array('status' => 'success', 'redirect' => $redirect, 'output' => '');
			}else {
			    $output = array('status' => 'error', 'output' => '<strong>Error: </strong>This email address is already taked with another account.');
			}
		    }else {
			$output = array('status' => 'fail');
		    }
		}
            }
	    header('Content-Type: application/json',true);
            echo json_encode($output);
        }else{
            show_404();    
        }
    }
}