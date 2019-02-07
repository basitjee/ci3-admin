<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }
    
    public function do_login($data) {         
        $this->db->select('id, username, password');
        $this->db->where('username', $data["username"]);
        $this->db->where('password', $data["password"]);
        return $this->db->get('users')->row_array();   
    }

}

?>   