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
}