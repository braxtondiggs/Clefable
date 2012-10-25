<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sites extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->model('Sites_model', 'sites');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	//if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
	//}
    }
    function index(){
        if ($this->session->userdata('user_type') == 1) {
	    $this->template->title('Manage Sites');
	    $this->template->set('sites', $this->sites->sites());
	    $this->template->set_layout('default_app')->build('app/sites/index');
	}else {
	    //$QID = $this->session->userdata("QID");
	    //redirect('app/users/edit/'.$QID);
	}
    }
    function edit($id = null) {
	$this->load->model('Sites_model');

        $data['query'] = $this->Blog->get_last_ten_entries();
        
    }
    function create() {
        if ($this->session->userdata('user_type') == 1) {    
	    if ($this->ion_auth->get_num_user() > 3) {
		$this->session->set_flashdata('gritter', array($this->lang->line('gritter_max_user')));
		redirect('app/users');
	    }
	    $this->template->title('Site Settings');
	    $this->template->set('is_new', true);
	    $this->template->set_layout('default_app')->build('app/sites/create');
	}else {
	    $QID = $this->session->userdata("QID");
	    redirect('app/users/edit/'.$QID);
	}
    }
    function delete($id=null) {
        
    }
    function status($action = null, $id = null) {
        
    }
    function submit ($id = null) {
        if ($this->input->is_ajax_request()) {
	    $this->load->library(array('form_validation', 'ftp'));
	    $url = $this->input->post('url');
	    $site_name = $this->input->post('site-name');
	    $address = $this->input->post('address');
	    $user = $this->input->post('user');
	    $password = $this->input->post('password');
	    $path = $this->input->post('path');
	    $css = $this->input->post('css');
	    $mode = $this->input->post('mode');
	    $port = $this->input->post('port');
	    $passkey_value = $this->input->post('passkey-value');
	    $required_if_passkey = $this->input->post('passkey') ? '|required' : '' ;
	    $config = array(
		array(
		    'field' => 'url',
		    'label' => 'Site URL',
		    'rules' => 'trim|required|callback__is_valid_url'
		),
		array(
		    'field' => 'site-name',
		    'label' => 'Site Name',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'address',
		    'label' => 'FTP Address',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'user',
		    'label' => 'FTP Username',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'password',
		    'label' => 'FTP Password',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'path',
		    'label' => 'FTP Path',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'css',
		    'label' => 'Editable CSS Class Name',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'mode',
		    'label' => 'FTP Mode',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'port',
		    'label' => 'FTP Port',
		    'rules' => 'trim|required|integer'
		),
		array(
		    'field' => 'passkey-value',
		    'label' => 'Password Key',
		    'rules' => 'trim'.$required_if_passkey
		)
	    );
	    $this->form_validation->set_rules($config);
	    if ($this->form_validation->run() == FALSE) {
                $output = array('status' => "error", 'output' => "<strong>Error: </strong>".validation_errors());
            }else{
		$additional_data = array('url' => $url, 'name' => $site_name, 'server' => $address, 'ftp_username' => $user, 'ftp_password' => $password, 'path' => $path, 'css' => $css, 'ftp_mode' => $mode, 'ftp_port' => $port, 'extra_password' =>  $passkey_value);
		$this->sites->create($additional_data);
		//print_r( $additional_data."$";
		$output = array('status' => "success");
	    }
	    //echo $url;
	    header('Content-Type: application/json',true);
            echo json_encode($output);//validate[required,custom[url]]
	}else {
	    show_404();
	}
    }
    public function _is_valid_url($str) {
	if(!filter_var($str, FILTER_VALIDATE_URL)) {
	    $this->form_validation->set_message('_is_valid_url', 'Your URL is incorrect');
	    return FALSE;
	} else {
	    return TRUE;
        }
    }
}