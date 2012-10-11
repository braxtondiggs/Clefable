<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller{
    function __construct() {
        parent::__construct();
    }
    function index(){
        $this->template->title('Simple &amp; Free CMS for Web Designers');
	$this->template->build('site/index');
    }
}