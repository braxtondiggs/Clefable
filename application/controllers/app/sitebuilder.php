<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sitebuilder extends CI_Controller{
    
    function __construct() {
        parent::__construct();
	$this->load->model('Sites_model', 'sites');
	$this->load->model('Pages_model', 'pages');
	if (!$this->ion_auth->logged_in()) {
	    redirect('login');
	}
	if (!$this->input->is_ajax_request()) {
	    //$this->output->enable_profiler(TRUE);
	}
    }
    function pages($sid = null, $path = null) {
	$site = $this->sites->get_site($sid);
	$this->template->set('site', $site);
	$this->template->set_layout('default_sitebuilder')->build('app/sitebuilder/index');
    }
    function source ($sid = null, $path = null) {
	$site = $this->sites->get_site($sid);$site = $site[0];
	include('./application/third_party/parser/simple_html_dom.php');
	include('./application/third_party/parser/url_to_absolute.php');
	$decoded_path = base64_decode(urldecode($path));
	$html = read_file('./CMS/' . $this->session->userdata('account') . '/' . $sid . '/' . $decoded_path);
	if (!$html) {
	    echo 'read error';
	}
	$html = str_get_html($html);
	// find all link
	foreach($html->find('link') as $e) {
		$e->href = url_to_absolute($site->url, dirname($site->path) . '/' . $e->href);
	}
	// find all link
	foreach($html->find('img, script') as $e) {
		$e->src = url_to_absolute($site->url,  dirname($site->path) . '/' . $e->src);
	}
	//$html->find('title', 0)->innertext = $_SESSION['PTitle'][$p];
	echo $html;
    }
}