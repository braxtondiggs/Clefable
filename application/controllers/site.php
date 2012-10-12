<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->library('ion_auth');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
        $this->template->title('Simple &amp; Free CMS for Web Designers');
	$this->template->set_layout('default_app')->build('site/index');
    }
}