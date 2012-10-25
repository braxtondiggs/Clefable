<?php
class Sites_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	$this->load->database();
	$this->load->helper('date');
    }
    function create($additional_data = array()) {
        $sid = $this->_id_generator('sites', 'sid');
        $data = array(
            'created_by'    => $this->session->userdata("QID"),
	    'account'       => $this->session->userdata("account"),
            'sid'           => $sid,
	    'active'        => 1,
	    'modified_user' => $this->session->userdata("QID"),
	    'created_date' => time()
	);
        $site_data = array_merge($this->_filter_data('sites', $additional_data), $data);
        $this->db->insert('sites', $site_data);
        return TRUE;
        
    }
    function get_sites() {
	$this->db->select('sites.url, sites.name, sites.active, sites.sid');
        $this->db->from('sites');
        $this->db->where('sites.account', $this->session->userdata('account'));
        $this->db->order_by("active", "desc");
        $this->db->order_by("created_date", "desc"); 
	$query = $this->db->get();

	return $query->result();
    }
    
    function get_site($id = null) {
        if ($id != null) {
            $this->db->select('sites.*');
            $this->db->from('sites');
            $this->db->where('sites.account', $this->session->userdata('account'));
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
    function update($id = null, $data = array()) {
        if ($id != null) {
            $this->db->update('sites', $data, array('sites.sid' => $id, 'sites.account' => $this->session->userdata('account')));
            return TRUE;
        }else {
            return FALSE;
        }
    }
    function delete($id = null) {
        if ($id != null) {
            $this->db->delete('sites', array('sites.sid' => $id, 'sites.account' => $this->session->userdata('account')));
            return TRUE;
        }else {
            return FALSE;
        }
    }
    function get_num_sites($id = FALSE) {
        $id || $id = $this->session->userdata('account');
        $query = $this->db->get_where('sites', array('account' => $id));
        return $query->num_rows();
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
}