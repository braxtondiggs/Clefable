<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ftp extends CI_Controller{
    function __construct() {
        parent::__construct();
	$this->load->library(array('ftp'));
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    $this->output->enable_profiler(TRUE);
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
    function browse_index() {
	if ($this->input->is_ajax_request()) {
	    $ftp_server = trim($this->input->post('server'));
	    $ftp_user = trim($this->input->post('username'));
	    $ftp_password = trim($this->input->post('password'));
	    $port = trim($this->input->post('port'));
	    $dir = trim($this->input->post('dir'));
	    $sftp = $this->input->post('SFTP');
	    
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
		    $allowed_extentions = array("htm", "html", "php");
		    if (in_array($ext, $allowed_extentions)) {
	  		$output .= '<li class="file ext_' . $ext . '"><a href="' . htmlentities($file) . '" rel="' .$dir.htmlentities($file) . '">' . htmlentities($file) . '</a></li>';
	  	    }
  		}
	    }
	    echo $output . '</ul>';
	    //print_r($this->ftp->list_files());
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
	$config['passive']  = FALSE;
	$config['debug']    = TRUE;
	
	$this->ftp->connect($config);
    }
}