<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();    
    }
    
    public function getAll() {         
        return $this->db->get('user_details')->result();
    }
         
    public function insert_user($table, $data) {
        return $this->db->insert($table, $data);
    }
    
    public function get($id) {
        $this->db->select('*');
        $this->db->where('id', $id);         
        return $this->db->get('user_details')->row_array();
        // return $this->db->get('users')->row();
    }   
    
    public function update_user($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('user_details', $data);
    }  
    
    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('user_details');
    }   
     
    
}

?>   