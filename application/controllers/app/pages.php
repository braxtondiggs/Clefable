<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once(dirname(__FILE__)."/ftp.php");
class Pages extends CI_Controller{
    
    function __construct() {
        parent::__construct();
	$this->load->model('Sites_model', 'sites');
	$this->load->model('Pages_model', 'pages');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
	}
    }
    function create($sid = null, $path = null, $folder_action = null) {
	if ($sid !== "folder") {
	    $sites = $this->sites->get_site($sid);
	    $this->template->title('Create Page');
	    $path_output = array(array('title' => 'Root Folder', 'path' => urlencode(base64_encode('/'))));
	    if ($path !== null) {
		$path = base64_decode(urldecode($path));
		$path_explode = explode('/', $path);
		foreach ($path_explode as $menu_path) {
		    if(!empty($menu_path)) {
			array_push($path_output, array('title' => $menu_path, 'path' => urlencode(base64_encode('/' . $menu_path))));
		    }
		}
	    }
	    $this->template->set('url_path', $path);
	    $this->template->set('paths', $path_output);
	    $this->template->set('site', $sites);
	    $this->template->set_layout('default_app')->build('app/pages/create');
	}else {
	    $this->_create_folder($folder_action, $path);
	}
    }
    function edit($sid = null, $pid = null) {
	$this->template->title('Edit Page');
	$this->template->set('sidebar', array('app/page_actions', 'app/help'));
	$this->template->set_layout('default_app')->build('app/pages/index');
    }
    function manage($sid = null, $path = null) {
	$qid = $this->session->userdata("QID");
	$sites = $this->sites->get_site($sid);
	$this->template->title('Site Pages');
	$this->template->set('sidebar', array('app/page_actions', 'app/help'));
	
	$this->template->set('site', $sites);
	$path_output = array(array('title' => 'Root Folder', 'path' => urlencode(base64_encode('/'))));
	if ($path == null) {
	    $path = '/';
	}else {
	    $path = base64_decode(urldecode($path));
	    $path_explode = explode('/', $path);
	    foreach ($path_explode as $menu_path) {
		if(!empty($menu_path)) {
		    array_push($path_output, array('title' => $menu_path, 'path' => urlencode(base64_encode('/' . $menu_path))));
		}
	    }
	}
	$map = directory_map('./CMS/' . $qid . $path, 2);
	$files = array();$directories = array();
	if (!empty($map)) {
	    foreach ($map as $k => $v) {
		if (!is_array($v)) {
		    $ext = preg_replace('/^.*\./', '', $v);
		    if (in_array($ext, array("htm", "html", "php"))) {
			array_push($files, $v);
		    }
		} else{
		    array_push($directories, $k);
		}
	    }
	}
	$this->template->set('paths', $path_output);
	$this->template->set('directories', $directories);
	$this->template->set('files', $files);
	$this->template->set('url_path', (($path == '/')?'/':$path. '/'));
	$this->template->set_layout('default_app')->build('app/pages/index');
    }
    private function _create_folder($action = null, $path = null) {
	if ($this->input->is_ajax_request()) {
	    header('Content-Type: application/json',true);
	    if ($action == null) {
		echo json_encode(array('status' => "success", 'dialog' => 'confirm', 'modal_redirect' => base_url('app/pages/create/folder/' . $path . '/approved'), 'output' => array('title' => 'Create New Folder?', 'text' => '<p>The best practice is to create folder names with lower case letters, and to use dashes (-) instead of spaces in your folder names. For example: about-us</p><form id="new_folder_form" class="formular"><div class="form-item Form_Block"><label for="folder"><span>*</span> Folder Name</label><input id="folder" name="folder" type="text" class="validate[required] text-rounded txt-xl"></div></form>')));
	    }else if ($action === "approved") {
		$qid = $this->session->userdata("QID");
		$folder = trim($this->input->post('folder'));
		$path = base64_decode(urldecode($path));
		$path = (empty($path)?'/':$path);
		$path .= '/' . $folder . '/index.php';
		if ($this->pages->_site_folder($qid)) {
		    if ($this->pages->_create_folder($qid, $path)) {
			$this->session->set_flashdata('gritter', array($this->lang->line('gritter_add_folder')));
		    }
		}
		echo json_encode(array('status' => 'reload'));
	    }
	}else {
	    show_404();
	}
    }
}