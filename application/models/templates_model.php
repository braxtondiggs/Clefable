<?php
class Templates_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	$this->load->database();
    }
    function get_templates($sid = null) {
	$this->db->select('templates.*');
        $this->db->from('templates');
	$this->db->where('templates.sid', $sid);
        $this->db->order_by("created_date", "desc"); 
	$query = $this->db->get();

	return $query->result();
    }
    
    function get_template($tid = null) {
        if ($tid != null) {
            $this->db->select('templates.*');
            $this->db->from('templates');
            $this->db->where('templates.tid', $tid);
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