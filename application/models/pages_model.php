<?php
class Pages_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	$this->load->database();
	$this->load->helper('date');
    }
    function get_pages($sid = null, $path = '/') {
	$this->db->select('pages.*');
        $this->db->from('pages');
        //$this->db->where('sites.account', $this->session->userdata('account'));
	$this->db->where('pages.sid', $sid);
	$this->db->like('pages.path', $path);
        $this->db->order_by("created_date", "desc"); 
	$query = $this->db->get();

	return $query->result();
    }
    
    function get_page($id = null) {
        if ($id != null) {
            $this->db->select('sites.*');
            $this->db->from('sites');
            //$this->db->where('sites.account', $this->session->userdata('account'));
            $this->db->where('sites.sid', $id);
            $this->db->limit(1);
            $query = $this->db->get();
    
            if ($query->num_rows() > 0) {
                return $query->result();;
            }else {
                return FALSE;
            }
        }else {
            return FALSE;
        }
    }
    function _site_folder($qid = null) {
	if(!is_dir('./CMS/'.$qid)) {	
	    if(@mkdir('./CMS/'.$qid , 0777)) {
		return TRUE;
	    }else{
		return FALSE;
	    }
	}else {
	    return TRUE;
	}
    }
    function _create_file($sid = null, $folder = null) {
	if(!is_dir('./CMS/' . $sid . $folder)) {
	    $path = dirname((substr($folder, 0 ,1) === "/")?substr($folder, 1):$folder);
	    if(!is_dir('./CMS/' . $sid . $path)) {
		if (write_file('./CMS/' . $sid . '/' . $path, 'empty')) {
		    return TRUE;
		}else {
		    return FALSE;
		}
	    }else {
		return TRUE;
	    }
	}else {
	    return TRUE;
	}
    } 
    function _create_folder($sid = null, $folder = null) {
	if(!is_dir('./CMS/' . $sid . $folder)) {
	    $path = dirname((substr($folder, 0 ,1) === "/")?substr($folder, 1):$folder);
	    if(!is_dir('./CMS/' . $sid . '/' . $path)) {
		if (@mkdir('./CMS/' . $sid . '/' . $path, 0777, true)) {
		    return TRUE;
		}else {
		    return FALSE;
		}
	    }else {
		return TRUE;
	    }
	}else {
	    return TRUE;
	}
    }
}