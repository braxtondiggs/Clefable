<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->load->library('ion_auth');
        $this->template->title('Login');
	$this->template->set('css', array('oneall.css', 'validator/validationEngine.jquery.css'));
        $this->template->set('js', array('validator/jquery.validationEngine-en.js', 'validator/jquery.validationEngine.js'));
        $this->template->set_layout('default_wide')->build('login/index');
    }
}
?>