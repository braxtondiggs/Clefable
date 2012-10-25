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
	    'sid'           => $sid,
	    'active'        => 1,
	    'modified_user' => $this->session->userdata("QID"),
	    'modified_date' => time()
	);
        $site_data = array_merge($this->_filter_data('sites', $additional_data), $data);
        $this->db->insert('sites', $site_data);
        return TRUE;
        
    }
    function sites() {
	$this->db->select('sites.url, sites.name, sites.active, sites.sid');
	$this->db->from('sites, accounts, users');
	$this->db->where('accounts.account_id', $this->session->userdata('account'));
	$this->db->where('accounts.account_id = users.account');
	$this->db->where('sites.created_by = users.username');
	$query = $this->db->get();

	return $query->result();
    }
    function update($id, array $data)
    {
        //$data = $this->_filter_data($this->tables['sites'], $data);
        //$query = $this->db->get('entries', 10);
        return 2;
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