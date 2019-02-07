<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {
private $data = array();
 
    public function __construct() 
    {
        parent::__construct();         
        $this->load->library('form_validation');   
        $this->load->model('user_model');             
    }
    
    public function getall() 
    {         
        $users            = $this->user_model->getall('posts');
        $data['users']    = $users; 
        $this->_loadTemplate('user_listing', $data['users']);
    }
    
    public function new_user() 
    {
        $this->_loadTemplate('add_new_user');
    }
    
    public function insert_user() 
    {         
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[25]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[25]');  
        $this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[2]|max_length[25]');  
        $this->form_validation->set_rules('roll_number', 'Roll Number', 'trim|required|min_length[1]|max_length[255]');  
            if ($this->form_validation->run() == FALSE) {                 
                $this->_loadTemplate('add_new_user');
            } else {
                $data    = [
                            'first_name'    => $this->input->post('first_name'),            
                            'last_name'     => $this->input->post('last_name'),
                            'country'       => $this->input->post('country'),
                            'roll_number'   => $this->input->post('roll_number'),
                          ];
                $data   = $this->security->xss_clean($data);                  
                $user   = $this->user_model->insert_user('user_details', $data);
                $this->session->set_flashdata('success', 'User Successfully Added');
                $this->_loadTemplate('add_new_user');
            }   
    }
    
    public function load_edit() 
    {
        $user_id    = $this->input->get('id', TRUE);    
        $user       = $this->user_model->get($user_id);         
            if ($user) {     
                $this->_loadTemplate('edit_user', $user); 
            } else {
                show_404();
            }       
        // echo $this->db->last_query();         
    }
    
    public function update_user() 
    {
        // echo $this->input->post('id');
        // die("i am in update_user");
        $user_id = $this->input->post('id');
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]|max_length[25]');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]|max_length[25]');  
        $this->form_validation->set_rules('country', 'Country', 'trim|required|min_length[2]|max_length[25]');  
        $this->form_validation->set_rules('roll_number', 'Roll Number', 'trim|required|min_length[1]|max_length[255]');      
            if ($this->form_validation->run() == FALSE) {
                $user       = $this->user_model->get($user_id);         
                    if ($user) {     
                        $this->_loadTemplate('edit_user', $user); 
                    } else {
                        show_404();
                    }       
            } else {
                $data    = [
                            'first_name'    => $this->input->post('first_name'),            
                            'last_name'     => $this->input->post('last_name'),
                            'country'       => $this->input->post('country'),
                            'roll_number'   => $this->input->post('roll_number'),
                          ];
                $data   = $this->security->xss_clean($data);                  
                $user   = $this->user_model->update_user($user_id, $data);
                $this->session->set_flashdata('success', 'User Successfully Updated');
                $this->getall();
            }    
    }
    
    public function delete_user() 
    {
        $user_id    = $this->input->get('id', TRUE);            
        $user       = $this->user_model->delete($user_id);
        $this->session->set_flashdata('success', 'User Successfully Deleted');
        $this->getall();        
    }
    
    private function _loadTemplate($view, $user_info=array()) 
    {
        $this->load->view('header');
        $data["users"] = $user_info;         
        $this->load->view($view, $data);
        $this->load->view('footer');
    }
    
}

?>