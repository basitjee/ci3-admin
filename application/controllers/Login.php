<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
private $data = array();
 
    public function __construct() {
        parent::__construct();         
        $this->load->library('form_validation');    
        $this->load->model('login_model');                
     }
    
    public function index()
    {         
        $this->load->view('login');
    }
    
    public function dashboard() {         
        if (! $this->session->userdata('id')) {
            $this->session->set_flashdata('error', 'You need to login to access this page');
            redirect('login', 'refresh');
        } else {
            $this->session->set_flashdata('loginSuccess', 'Welcome');    
            $this->_loadTemplate('dashboard');    
        }
        
    }
        
    public function dologin() {
        $this->form_validation->set_rules('username', 'username', 'trim|required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[5]|max_length[255]');  
            if ($this->form_validation->run() == FALSE) {
               $this->load->view('login');
            } else {
               $data    = [
                            'username'  => $this->input->post('username'),            
                            'password'  => $this->input->post('password'),
                          ];
                $data   = $this->security->xss_clean($data); 
                $user   = $this->login_model->do_login($data);        
                    if (isset($user["id"])) {
                        $this->session->set_userdata($user);
                        redirect('login/dashboard', 'refresh');              
                    } else {
                        $data = [
                            'error' => '1',
                        ];
                        $this->load->view('login', $data);
                    } 
            }  
    }

    public function logout() {
        session_destroy();
        redirect('login/index', 'refresh');
    }
    
    private function _loadTemplate($view) {
        $this->load->view('header');
        $this->load->view($view);
        $this->load->view('footer');
    }
    
}
