<?php
class Sites_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
	$this->load->database();
	$this->load->helper('date');
    }
    function activate($id = null, $type = 'update', $data = array()) {
        if ($type === 'create') {
            $data = array(
            'sid'            => $id,
	    'template'       => true,
            'gallery'        => true,
	    'document'       => false,
	    'history'        => false,
	    'rss'            => false,
            'seo'            => true,
            'navigation'     => false,
            'page_permission'=> false,
            'analytics'      => true,
            'optimiztion'    => true,
            'includes'       => false
	);
        $this->db->insert('activate', $site_data);
        return TRUE;
        }else if ($type === 'update') {
            $this->db->update('activate', $data, array('activate.sid' => $id));
            return TRUE;
        }
    }
    function create($additional_data = array()) {
        $sid = $this->_id_generator('sites', 'sid');
        $data = array(
            'created_by'    => $this->session->userdata("QID"),
	    'account'       => $this->session->userdata("account"),
            'sid'           => $sid,
	    'active'        => 1,
	    'modified_user' => $this->session->userdata("QID"),
	    'created_date'  => time()
	);
        $site_data = array_merge($this->_filter_data('sites', $additional_data), $data);
        $this->db->insert('sites', $site_data);
        return TRUE;
        
    }
    function get_sites($relative = FALSE) {
	$this->db->select('sites.url, sites.name, sites.active, sites.sid');
        $this->db->from('sites');
        $this->db->where('sites.account', $this->session->userdata('account'));
	if ($relative) {
	    $this->db->where('sites.active', 1);
	}
        $this->db->order_by("active", "desc");
        $this->db->order_by("created_date", "desc"); 
	$query = $this->db->get();

	return $query->result();
    }
    function get_features($id = null) {
        if ($id != null) {
            $this->db->select('activate.*');
            $this->db->from('activate');
            $this->db->where('activate.sid', $id);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return $query->result();;
            }else {
		$data = array(
		    'sid'    	    => $id,
		    'template'      => 1,
		    'gallery'       => 1,
		    'document'      => 1,
		    'seo          ' => 1
		);
		$this->db->insert('activate', $data);
		$this->get_features();
            }
        }else {
            return FALSE;
        }
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
	$this->db->select('sid');
	$this->db->where('account', $id);
	$query = $this->db->get('sites');
        return $query->num_rows();
    }
    function check_unique($input, $table, $sid) {
        $pieces = explode(".", $table);
        if ($sid != FALSE) {
            $query = $this->db->get_where($pieces[0], array($pieces[1] => $input,  'sid !=' => $sid), 1);
           
        }else {
            $query = $this->db->get_where($pieces[0], array($pieces[1] => $input), 1);
        }
        if ($query->num_rows() > 0) {
            return FALSE;
        }else {
            return TRUE;
        }
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
    function _account_type($type =  FALSE) {
	$type || $type = $this->session->userdata('account_type');
	switch ($type) {
	    case 1:
		return "Free";
	    break;
	    case 2:
		return "Undefined";
	    break;
	}
    }
}