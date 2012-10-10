<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
	$this->load->helper('form');
        $this->template->title('Contact Us');
	$this->template->set('css', array('rpx.css', 'validator/validationEngine.jquery.css'));
        $this->template->set('js', array('validator/jquery.validationEngine-en.js', 'validator/jquery.validationEngine.js'));
        $this->template->build('contact/index');
    }
    function submit() {
        if ($this->input->is_ajax_request()) {
            $this->load->library(array('form_validation', 'email'));
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('subject', 'Subject', 'required');
            $this->form_validation->set_rules('msg', 'Message', 'required');
            if ($this->form_validation->run() == FALSE) {
                $output = array('status' => "error", 'output' => "<strong>Error: </strong>".validation_errors());
                header('Content-Type: application/json',true);
                echo json_encode($output);
            }else{
                // set email data
                $this->email->from($this->input->post('email'), $this->input->post('name'));
                $this->email->to('admin@cymbit.com');
                $this->email->reply_to($this->input->post('email'), $this->input->post('name'));
                $this->email->subject($this->input->post('subject'));
                $this->email->message($this->input->post('message'));
                $this->email->send();
                $output = array('status' => "success", 'output' => $this->load->view('contact/submit', '', true));
                header('Content-Type: application/json',true);
                echo json_encode($output);
            }
        }else{
            show_404();    
        }
    }
}
?>