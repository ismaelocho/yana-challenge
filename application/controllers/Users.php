<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Users extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        $this->load->library('session');
        $this->load->library('form_validation'); 
        $this->load->model('User_model'); 
        $this->load->model('User_activity_model');
        
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    } 
     
    public function index(){ 
        if($this->isUserLoggedIn){ 
            redirect('admin'); 
        }else{ 
            $this->load->view('login'); 
        } 
    } 
 
    public function login(){ 
        $data = array(); 
         
        if($this->session->userdata('success_msg')){ 
            $data['success_msg'] = $this->session->userdata('success_msg'); 
            $this->session->unset_userdata('success_msg'); 
        } 
        if($this->session->userdata('error_msg')){ 
            $data['error_msg'] = $this->session->userdata('error_msg'); 
            $this->session->unset_userdata('error_msg'); 
        } 
         
        if($this->input->post('email')){ 
            //Review mandtorie inputs
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
             
            if($this->form_validation->run() == true){ 
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $checkLogin = $this->User_model->validLogin($email, $password); 
                if($checkLogin){ 
                    $this->session->set_userdata('isUserLoggedIn', TRUE); 
                    $this->session->set_userdata('userId', $checkLogin); 
                    $this->session->set_userdata('userEmail', $email); 
                    $data['success_msg'] = $checkLogin; 
                    redirect('admin'); 
                }else{ 
                    $data['error_msg'] = 'Correo electrónico o contraseña incorrectos, por favor inténtalo de nuevo.'.$checkLogin; 
                } 
            }else{ 
                $data['error_msg'] = 'Por favor llene todos los campos obligatorios.'; 
            } 
        } 
         
        // Load view 
        $this->load->view('login', $data); 
    } 
 
    public function registration(){ 
        $data = $userData = array(); 
         
        // If registration request is submitted 
        if($this->input->post('email')){ 
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check'); 
            $this->form_validation->set_rules('password', 'password', 'required'); 
            $this->form_validation->set_rules('conf_password', 'confirm password', 'required|matches[password]'); 
 
            $userData = array( 
                'email' => strip_tags($this->input->post('email')), 
                'password' => md5($this->input->post('password')), 
            ); 
 
            if($this->form_validation->run() == true){ 
                $insert = $this->User_model->insert($userData); 
                if($insert){ 
                    $this->session->set_userdata('success_msg', 'El registro de su cuenta ha sido exitoso. Por favor, ingrese a su cuenta.'); 
                    redirect('users/login'); 
                }else{ 
                    $data['error_msg'] = 'Ocurrieron algunos problemas, inténtalo de nuevo.'; 
                } 
            }else{ 
                $data['error_msg'] = 'Por favor llene todos los campos obligatorios.'; 
            } 
        } 
        
        $data['user'] = $userData; 
         
        $this->load->view('registration', $data); 
    } 
     
    public function logout(){ 
        $this->session->unset_userdata('isUserLoggedIn'); 
        $this->session->unset_userdata('userId'); 
        $this->session->sess_destroy(); 
        redirect('users/login/'); 
    } 
     
     
    // Prevent duplicate email
    public function email_check($str){ 
        $con = array( 
            'returnType' => 'count', 
            'conditions' => array( 
                'email' => $str 
            ) 
        ); 
        $checkEmail = $this->User_model->getRows($con); 
        if($checkEmail > 0){ 
            $this->form_validation->set_message('email_check', 'El correo electrónico dado ya existe.'); 
            $data['error_msg'] = 'El correo electrónico dado ya existe.'; 
            return FALSE; 
        }else{ 
            return TRUE; 
        } 
    } 
}
