<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
    function create($sid = null, $path = null, $approved = null) {
	if ($this->input->is_ajax_request()) {
	    header('Content-Type: application/json',true);
	    if ($approved === null) {
		$output = $this->_edit_alert('create', $sid, $path);
	    }else if ($approved === "approved") {
                $file = trim($this->input->post('file'));
                $path = base64_decode(urldecode($path));
                $path = (empty($path)?'/':((substr($path, -1, 1) == "/"))?$path:$path.'/');
                $path .= $file;
		if ($this->pages->_site_folder($sid)) {
		    $this->pages->_create_folder($sid, $path);
		    write_file('./CMS/' . $sid . '/' . $path, 'empty');
                    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_add_file')));
                }
                $output = array('status' => 'reload');
	    }
	    echo json_encode($output);
	}else {
            show_404();
	}
    }
    function delete($sid = null, $path = null, $approved = null) {
        if ($this->input->is_ajax_request()) {
	    header('Content-Type: application/json',true);
            if ($approved === null) {
                $output = array('status' => "success", 'dialog' => 'confirm', 'modal_redirect' => base_url('app/pages/delete/' . $sid . '/'  . $path . '/approved'), 'output' => array('title' => 'Are you sure?', 'text' => 'Are you sure you want to delete this File? All the information related to this Folder will be removed.<p>&nbsp;</p><p><strong>*Note</strong>: Nothing on your site will be deleted.'));
	    }else if ($approved === "approved") {
                $path = base64_decode(urldecode($path));
                unlink('./CMS/' . $sid  . $path);
                $this->session->set_flashdata('gritter', array($this->lang->line('gritter_delete_file')));
                $output = array('status' => 'reload');
	    }
            echo json_encode($output);
	}else {
	    show_404();
	}
    }
    function edit($sid = null, $path = null, $name= null, $approved = null) {
	if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json',true);
	    if ($approved === null) {
                $output = $this->_edit_alert('edit', $sid, $path, $name);
            }else if ($approved === "approved") {
                $file = trim($this->input->post('file'));
                $path = base64_decode(urldecode($path));
                $path = (empty($path)?'/':((substr($path, -1, 1) == "/"))?$path:$path.'/');
                if ($this->pages->_site_folder($sid)) {
                    rename('./CMS/' . $sid  . $path . base64_decode(urldecode($name)), './CMS/' . $sid  . $path . $file);
                    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_rename_file')));
                    $output = array('status' => 'reload');
                }
            }
            echo json_encode($output);
        }else {
            show_404();
        }
    }
    function manage($sid = null, $path = null) {
	if ($sid !== null) {
	    $sites = $this->sites->get_site($sid);
	    $this->template->title('Site Pages');
	    $this->template->set('sidebar', array('app/page_actions', 'app/help'));
	    $this->template->set('site', $sites);
	    $dir = dirname($sites[0]->path);
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
	    $map = directory_map('./CMS/' . $sid . $dir . $path, 2);
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
	    }else {
		$this->template->set('gritter_instant', array($this->lang->line('gritter_empty_page')));
	    }
	    $this->template->set('paths', $path_output);
	    $this->template->set('directories', $directories);
	    $this->template->set('files', $files);
	    $this->template->set('url_path', (($path == '/' || $path == $dir)?'/':$path. '/'));
	    $this->template->set('dir', $dir);
	    $this->template->set_layout('default_app')->build('app/pages/index');
	}else {
	    show_404();
	}
    }
    private function _edit_alert($action = 'create', $sid = null, $path = null, $input = null) {
	$data = array('input' => $input, 'sid' => $sid, 'action' => $action);
        $html = $this->load->view('app/pages/include/modal/create_new', $data, true);
	return array('status' => "success", 'dialog' => 'confirm', 'modal_redirect' => base_url('app/pages/' . $action . '/' . $sid . '/' . $path . (!empty($input)?'/'.$input:$input) . '/approved'), 'output' => array('title' => 'Create New File?', 'text' => $html));
    }
}