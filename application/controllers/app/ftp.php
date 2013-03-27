<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ftp extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->model('Sites_model', 'sites');
	$this->load->model('Pages_model', 'pages');
	$this->load->library(array('ftp'));
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(FALSE);
	}
    }
    function test_connection() {
        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json',true);
	    $ftp_server = trim($this->input->post('address'));
            $ftp_user = trim($this->input->post('user'));
            $ftp_password = trim($this->input->post('password'));
            $port = trim($this->input->post('port'));
            // set up basic connection
            if ($this->input->post('SFTP') == true) {
		$conn_id = @ftp_ssl_connect($ftp_server, $port) or die(json_encode(array('status' => 'error', 'output' => '<span class="delete ftp-alert cmsicon" style="display: inline-block;float: none;"></span>&nbsp;Couldn\'t connect to ' . $ftp_server)));
            }else {
                $conn_id = @ftp_connect($ftp_server, $port) or die(json_encode(array('status' => 'error', 'output' => '<span class="delete ftp-alert cmsicon" style="display: inline-block;float: none;"></span>&nbsp;Couldn\'t connect to ' . $ftp_server)));
            }
    
            // login with username and password
            if (!@ftp_login($conn_id, $ftp_user, $ftp_password)) {
                $output = array('status' => 'error', 'output' => '<span class="delete ftp-alert cmsicon" style="display: inline-block;float: none;"></span>&nbsp;Username and Password is incorrect');
            }else {
                $output = array('status' => 'success', 'output' => '<span class="tick ftp-alert cmsicon" style="display: inline-block;float: none;"></span>&nbsp;Connection OK!');
            }
            
            ftp_close($conn_id);
            echo json_encode($output);
        }else {
            show_404();
        }
    }
    function browse_file($action = null, $id = null) {
	if ($this->input->is_ajax_request()) {
	    $ftp_server = trim($this->input->post('server'));
	    $ftp_user = trim($this->input->post('username'));
	    $ftp_password = trim($this->input->post('password'));
	    $port = trim($this->input->post('port'));
	    $dir = trim($this->input->post('dir'));
	    $sftp = $this->input->post('SFTP');
	    if ($dir === "." || $dir === "./" ||  $dir === "//" || $dir === "../" || $dir === "/./" || $dir ==="") {
		$dir = "/"; 
	    }
	    
	    if ($action === "index") {
		$allowed_extentions = array("htm", "html", "php");
	    }else if ($action === "img") {
		$allowed_extentions = array("jpg", "jpeg", "gif", "png", "bmp", "psd", "pxd");
	    }else if ($action === "docs") {
		$allowed_extentions = array("txt", "pdf", "doc", "docx", "log", "rtf", "ppt", "pptx", "swf");
	    }
	    $this->_open_connection($ftp_server, $ftp_user, $ftp_password, $port, $sftp);
	    $ftp_nlist = $this->ftp->list_files($dir);
	    
	    sort($ftp_nlist);
	    $output = '<ul class="jqueryFileTree" style="display: none;">';
	    foreach ($ftp_nlist as $folder) {
		//1. Size is '-1' => directory
  		if (@ftp_size($this->ftp->conn_id, $dir.$folder) == '-1' && $folder !== "." && $folder !== "..") {
		    //output as [ directory ]
		    $output .= '<li class="directory collapsed"><a href="' .$folder . '" rel="' . $dir . htmlentities($folder) . '/' . '">' . htmlentities($folder) . '</a></li>';
  		}
	    }
	    foreach ($ftp_nlist as $file) {
		
		//2. Size is not '-1' => file
  		if (!(@ftp_size($this->ftp->conn_id, $dir.$file) == '-1')) {
		    //output as file
		    $ext = preg_replace('/^.*\./', '', $file);
		    if (in_array($ext, $allowed_extentions)) {
	  		$output .= '<li class="file ext_' . $ext . '"><a href="' . htmlentities($file) . '" rel="' .$dir.htmlentities($file) . '">' . htmlentities($file) . '</a></li>';
	  	    }
  		}
	    }
	    echo $output . '</ul>';
	    $this->ftp->close();
	}else {
            show_404();
        }
    }
    function save_file($sid = null) {
	if ($this->input->is_ajax_request()) {
	    $site = $this->sites->get_site($sid);$site = $site[0];
	    $file = parse_url(trim($this->input->post('file'), PHP_URL_PATH));$file= $file['path'];
	    $ftp_server = trim($this->input->post('server'));
	    $ftp_user = trim($this->input->post('username'));
	    $ftp_password = trim($this->input->post('password'));
	    $port = trim($this->input->post('port'));
	    $dir = trim($this->input->post('dir'));
	    $sftp = $this->input->post('SFTP');
	    $this->_open_connection($ftp_server, $ftp_user, $ftp_password, $port, $sftp);
	    if ($this->pages->_account_folder($this->session->userdata('account'))) {
		if ($this->pages->_site_folder($sid)) {
		    if ($this->pages->_create_folder($sid, (substr($file, 0, 2) =='/./')?substr($file, 2):$file)) {
			$this->ftp->download($file, './CMS/' . $this->session->userdata('account') . '/' . $sid . $file);
			$this->session->set_flashdata('gritter', array($this->lang->line('gritter_add_page')));
			
			include('./application/third_party/parser/simple_html_dom.php');
			$html = read_file('./CMS/' . $this->session->userdata('account') . '/' . $sid . '/' . $file);
			if (!$html) {
			    echo 'read error';
			}
			$html = str_get_html($html);
			// find all link
			$path = dirname($site->path);
			foreach($html->find('link') as $e) {
			    $href = trim(dirname($e->href));
			    if (!empty($href)){
				if ($this->pages->_create_folder($sid, $path . '/' . $href . '/index.html')) {
				    $this->ftp->download($path . '/' . $e->href, './CMS/' . $this->session->userdata('account') . '/' . $sid . '/' . $path . '/' . $e->href);
				}
			    }
			}
			foreach($html->find('img, script') as $e) {
			    $src = trim(dirname($e->src));
			    if (!empty($src)){
				if ($this->pages->_create_folder($sid, $path . '/' . $src . '/index.html')) {
				    $this->ftp->download($path . '/' . $e->src, './CMS/' . $this->session->userdata('account') . '/' . $sid . '/' . $path . '/' . $e->src);
				}
			    }
			}
		    }
		}
	    }
	    $this->ftp->close();
	}else {
            show_404();
        }
    }
    private function _open_connection($server, $user, $password, $port, $sftp) {
	$config['hostname'] = $server;
	$config['username'] = $user;
	$config['password'] = $password;
	$config['port']     = 21;
	$config['passive']  = TRUE;
	$config['debug']    = TRUE;
	
	$this->ftp->connect($config);
    }
}