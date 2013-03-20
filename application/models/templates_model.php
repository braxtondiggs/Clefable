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
    function create($sid, $additional_data = array()) {
        $tid = $this->_id_generator('templates', 'tid');
        $data = array(
            'created_by'    => $this->session->userdata("QID"),
            'sid'           => $sid,
	    'modified_user' => $this->session->userdata("QID"),
	    'created_date' => time(),
            'tid' => $tid
	);
        $template_data = array_merge($this->_filter_data('templates', $additional_data), $data);
        $this->db->insert('templates', $template_data);
        return $tid;
        
    }
    function update($id = null, $sid = null, $data = array()) {
        if ($id != null) {
            $this->db->update('templates', $data, array('templates.tid' => $id, 'templates.sid' => $sid));
            return TRUE;
        }else {
            return FALSE;
        }
    }
    protected function _id_generator($table, $var) {
	$length = 12;$UID = "";$possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz012345677689"; $i = 0; 
	// add random characters to $password until $length is reached
	while ($i < $length) { 
            $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);   
            // we don't want this character if it's already in the password
            if ($i == 0 && strpos("0123456789", $char) !== false) {
            }else{
                    $UID .= $char;
                    $i++;
                }
	}
	$UID = substr($var, 0 ,1).$UID;
	if ($table !== "null") {
            $this->db->select($var);
            $query = $this->db->where($var, $UID);
            $this->db->limit(1);
            $query = $this->db->get($table);
            if($query->num_rows() == 0) {
                return $UID;
            } else {
                return $this->id_generator($count, $start);
            }
        }
        return $UID;
    }
    protected function _filter_data($table, $data){
	$filtered_data = array();
	$columns = $this->db->list_fields($table);

	if (is_array($data)) {
		foreach ($columns as $column) {
		    if (array_key_exists($column, $data))
                        $filtered_data[$column] = $data[$column];
		}
	}

	return $filtered_data;
    }
}