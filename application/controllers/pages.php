<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	//public function view($page = 'home') {
	public function __construct()
	{
		parent::__construct();
	}
	public function home() {		
		$this->template->title('Simple &amp; Free CMS for Web Designers');
		$this->template->build('pages/home');
	}
	public function tour() {
		$this->template->title('Tour Page');
		$this->template->build('pages/tour');
	}
	public function privacy() {
		$this->template->title('Privacy Policy');
		$this->template->build('pages/privacy');
	}
	public function terms() {
		$this->template->title('Terms of Service');
		$this->template->build('pages/terms');
	}
}
