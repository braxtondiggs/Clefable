<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Folders extends CI_Controller{
    
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
                $folder = trim($this->input->post('folder'));
                $path = base64_decode(urldecode($path));
                $path = (empty($path)?'/':((substr($path, -1, 1) == "/"))?$path:$path.'/');
                $path .= '/' . $folder . '/index.php';
                if ($this->pages->_site_folder($sid)) {
                    if ($this->pages->_create_folder($sid, $path)) {
                        $this->session->set_flashdata('gritter', array($this->lang->line('gritter_add_folder')));
                    }
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
                $output = array('status' => "success", 'dialog' => 'confirm', 'modal_redirect' => base_url('app/folders/delete/' . $sid . '/'  . $path . '/approved'), 'output' => array('title' => 'Are you sure?', 'text' => 'Are you sure you want to delete this Folder? All the information related to this Folder will be removed.<p>&nbsp;</p><p><strong>*Note</strong>: Nothing on your site will be deleted.'));
	    }else if ($approved === "approved") {
                $path = base64_decode(urldecode($path));
                $this->_deleteDirectory('./CMS/' . $sid  . $path);
                $this->session->set_flashdata('gritter', array($this->lang->line('gritter_delete_folder')));
                $output = array('status' => 'reload');
	    }
            echo json_encode($output);
	}else {
	    show_404();
	}
    }
    function download() {
        
    }
    function edit($sid = null, $path = null, $name= null, $approved = null) {
        if ($this->input->is_ajax_request()) {
            header('Content-Type: application/json',true);
	    if ($approved === null) {
                $output = $this->_edit_alert('edit', $sid, $path, $name);
            }else if ($approved === "approved") {
                $folder = trim($this->input->post('folder'));
                $path = base64_decode(urldecode($path));
                $path = (empty($path)?'/':((substr($path, -1, 1) == "/"))?$path:$path.'/');
                if ($this->pages->_site_folder($sid)) {
                    rename('./CMS/' . $sid  . $path . base64_decode(urldecode($name)), './CMS/' . $sid  . $path . $folder);
                    $this->session->set_flashdata('gritter', array($this->lang->line('gritter_rename_folder')));
                    $output = array('status' => 'reload');
                }
            }
            echo json_encode($output);
        }else {
            show_404();
        }
    }
    function upload() {
        
    }
    private function _edit_alert($action = 'create', $sid = null, $path = null, $input = null) {
        return array('status' => "success", 'dialog' => 'confirm', 'modal_redirect' => base_url('app/folders/' . $action . '/' . $sid . '/' . $path . (!empty($input)?'/'.$input:$input) . '/approved'), 'output' => array('title' => 'Create New Folder?', 'text' => '<p>The best practice is to create folder names with lower case letters, and to use dashes (-) instead of spaces in your folder names. For example: about-us</p><form id="new_folder_form" class="formular"><div class="form-item Form_Block"><label for="folder"><span>*</span> Folder Name</label><input id="folder" name="folder" type="text" class="validate[required] text-rounded txt-xl" value="' . base64_decode(urldecode($input)) . '"></div></form>'));
    }
    private function _deleteDirectory($dir) {
	system('rm -rf ' . escapeshellarg($dir), $retval);
	return $retval == 0; // UNIX commands return zero on success
    }
}