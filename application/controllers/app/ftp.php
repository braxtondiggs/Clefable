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
            $ftp_server = trim($this->input->post('address'));
            $ftp_user = trim($this->input->post('user'));
            $ftp_password = trim($this->input->post('password'));
            $port = trim($this->input->post('port'));
            // set up basic connection
            if ($this->input->post('SFTP') == true) {
                if (!@ftp_ssl_connect($ftp_server, $port)) {
                    $output = array('status' => 'error', 'output' => '<span class="delete ftp-alert cmsicon"></span>&nbsp;Couldn\'t connect to ' . $ftp_server);
                }
            }else {
                if (!@ftp_connect($ftp_server, $port)) {
                    $output = array('status' => 'error', 'output' => '<span class="delete ftp-alert cmsicon"></span>&nbsp;Couldn\'t connect to ' . $ftp_server);
                }
            }
    
            // login with username and password
            if (@ftp_login($conn_id, $ftp_user, $ftp_password)) {
                $output = array('status' => 'error', 'output' => '<span class="delete ftp-alert cmsicon"></span>&nbsp;Username and Password is incorrect');
            }else {
                $output = array('status' => 'success', 'output' => '<span class="tick ftp-alert cmsicon"></span>&nbsp;Connection OK!');
            }
            
            ftp_close($conn_id);
            header('Content-Type: application/json',true);
            echo json_encode($output);
        }else {
            show_404();
        }
        
    }
}