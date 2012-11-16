<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sites extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->model('Sites_model', 'sites');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
	}
    }
    function index(){
        if ($this->session->userdata('user_type') == 1) {
	    $this->template->title('Manage Sites');
	    $this->template->set('sites', $this->sites->get_sites());
	    $this->template->set('sidebar', array('app/sites_usage', 'app/account_type', 'app/help'));
	    $this->template->set_layout('default_app')->build('app/sites/index');
	}else {
	    $this->template->title('Manage Sites');
	    $this->template->set('sites', $this->sites->get_sites());
	    $this->template->set_layout('default_app')->build('app/sites/index_editor');
	}
    }
    
    function create() {
        if ($this->session->userdata('user_type') == 1) {    
	    if ($this->sites->get_num_sites() > $config['max_sites']) {
		$this->session->set_flashdata('gritter', array($this->lang->line('gritter_max_sites')));
		redirect('app/sites');
	    }
	    $this->template->title('Site Settings');
	    $this->template->set('is_new', true);
	    $this->template->set_layout('default_app')->build('app/sites/create');
	}else {
	    redirect('app');
	}
    }
    function dashboard($id = null) {
	$sites = $this->sites->get_site($id);
	$activate = $this->sites->get_features($id);
	if ($sites && $activate) { 	
	    $this->template->title('Site Actions');
	    $this->template->set('site', $sites);
	    $this->template->set('activate', $activate);
	    $this->template->set_layout('default_app')->build('app/sites/dashboard');
	}else {
	    redirect('app/sites');
	}
    }
    function edit($id = null) {
	$sites = $this->sites->get_site($id);
	if ($sites && $this->session->userdata('user_type') == 1) { 	
	    $this->template->title('Edit Site');
	    $this->template->set('site', $sites);
	    $this->template->set_layout('default_app')->build('app/sites/edit');
	}else {
	    redirect('app/sites');
	}
    }
    function delete($status = null, $id = null) {
	$sites = $this->sites->get_site($id);
        $output = array('status' => 'fail');
	if ($this->input->is_ajax_request()) {
	    if ($sites && $this->session->userdata('user_type') == 1) {
		if ($status === "confirm") {
		    $output = array('status' => "success", 'dialog' => 'confirm', 'modal_redirect' => base_url('app/sites/delete/approved/' . $id), 'output' => array('title' => 'Are you sure?', 'text' => 'Are you sure you want to delete your site? All the pages and information related to this site will be removed.<p>&nbsp;</p><p><strong>*Note</strong>: Your site still exists on your server.'));
		}else if($status === "approved") {
		    $this->sites->delete($id);
		    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_site_delete')));
		    $output = array('status' => "reload");
		}
	    }
	    header('Content-Type: application/json',true);
            echo json_encode($output);
	}else {
	    show_404();
	}
    }
    function features($sid = null, $isajax = null, $item = null, $action = null) {
	if ($isajax === null) {
	    $sites = $this->sites->get_site($sid);
	    $activate = $this->sites->get_features($sid);
	    if ($sites && $activate) { 	
		$this->template->title('Activate Features');
		$this->template->set('site', $sites);
		$this->template->set('activate', $activate);
		$this->template->set_layout('default_app')->build('app/sites/features');
	    }else {
		redirect('app/sites');
	    }
	}else if($isajax === 'ajax'){
	    if ($this->input->is_ajax_request()) {
		$this->sites->activate($sid, 'update', array($item => ($action === "enable")?true:false));
	    }else{
		show_404();
	    }
	}
    }
    function status($action = null, $id = null) {
        $output = array('status' => 'fail');
	$sites = $this->sites->get_site($id);
	if ($this->input->is_ajax_request()) {
	    if ($sites) {
		if ($action === "enable") {
		    $data = array('active' => 1);
		    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_site_enabled')));
		}else if ($action === "disable") {
		    $data = array('active' => 0);
		    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_site_disabled')));
		}
		$this->sites->update($id, $data);
		$output = array('status' => "reload");
    	    }
	    header('Content-Type: application/json',true);
	    echo json_encode($output);
	}else {
	    show_404();
	}
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
	    $keyword = $this->input->post('keyword');
	    $mode = $this->input->post('mode');
	    $port = $this->input->post('port');
	    $passkey_value = $this->input->post('passkey-value');
	    $required_if_password = $this->input->post('changepass') ? '|required' : '' ;
	    $required_if_passkey = $this->input->post('passkey') ? '|required' : '' ;
	    $config = array(
		array(
		    'field' => 'url',
		    'label' => 'Site URL',
		    'rules' => 'trim|required|callback__is_valid_url|callback__is_used[sites.url]'
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
		    'rules' => 'trim'.$required_if_password
		),
		array(
		    'field' => 'path',
		    'label' => 'FTP Path',
		    'rules' => 'trim|required'
		),
		array(
		    'field' => 'keyword',
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
		$additional_data = array('url' => $url, 'name' => $site_name, 'server' => $address, 'ftp_username' => $user, 'ftp_password' => $password, 'path' => $path, 'keyword' => $keyword, 'ftp_mode' => $mode, 'ftp_port' => $port, 'extra_password' =>  $passkey_value);
		if ($this->_test_ftp_connection($address, $user, $password, $port, FALSE)) {
		    if ($id === null) {
			if ($this->sites->get_num_sites() > $config['max_sites']) {
			    $this->sites->create($additional_data);
			    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_site_create'), $this->lang->line('gritter_site_next')));
			}else {
			    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_max_site')));
			}
		    }else {
			$this->sites->update($id, $additional_data);
			$this->session->set_flashdata('gritter', array($this->lang->line('gritter_site_update')));
		    }
		    $output = array('status' => "success", 'redirect' => base_url('app/sites'));
		}else {
		    $output = array('status' => "error", 'output' => '<strong>Error: </strong> Your site\'s FTP information has failed, please review.');
		}
	    }
	    header('Content-Type: application/json',true);
            echo json_encode($output);
	}else {
	    show_404();
	}
    }
    function templates($sid = null) {
	$sites = $this->sites->get_site($sid);
	if ($sites) { 	
	    $this->template->title('Manage Templates');
	    $this->template->set('site', $sites);
	    $this->template->set_layout('default_app')->build('app/sites/templates');
	}else {
	    redirect('app/sites');
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
    public function _is_used($str, $table) {
	if ($this->sites->check_unique($str, $table, $this->uri->segment(4))) {
	    return TRUE;
	}else {
	    $this->form_validation->set_message('_is_used', 'The %s is already in use, please select something else.');
	    return FALSE;
	}
    }
    function _test_ftp_connection($ftp_server, $ftp_user, $ftp_password, $port, $sftp) {
	if ($sftp == TRUE) {
	    $conn_id = @ftp_ssl_connect($ftp_server, $port);
	}else {
	    $conn_id = @ftp_connect($ftp_server, $port);
	}
    
	// login with username and password
	if (!@ftp_login($conn_id, $ftp_user, $ftp_password)) {
	    return FALSE;
	}else {
	    return TRUE;
	}
	
	ftp_close($conn_id);
    }
    function test() {
	$params = array(
   'www.cymbit.com', // site url
   'yoursite.jpg',  // image filename
   NULL,        // $custom_id 
   NULL,        // $browserWidth 
   NULL,        // $browserHeight
   NULL,        // $width - width of the generated image
   NULL,        // $height - height of the generated image
   NULL,        // $format - the file format 
   NULL                // $delay - milliseconds before the screenshot being taken
);  

$this->load->library('Grabzit');
$result = $this->grabzit->grab_image($params);
var_dump($result);
    }
}