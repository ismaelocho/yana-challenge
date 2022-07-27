<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class UserActivities extends CI_Controller { 
     
    function __construct() { 
        parent::__construct(); 
         
        $this->load->library('session');
        $this->load->model('User_model'); 
        $this->load->model('User_activity_model');
        
        // User login status 
        $this->isUserLoggedIn = $this->session->userdata('isUserLoggedIn'); 
    } 




/* 
     * Fetch user_activities data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function get_conversations($response)
    {
        header('Content-Type: application/json');  
        if ($response) {
            $user_exists = $this->User_model->get_by($response);
            $res = array(
                "code" => 200,
                "payload" => array()
            );
            if ($user_exists) {
                $all_convos = $this->User_activity_model->get_by($response);
                $res["payload"] = $all_convos;
            } else {
            }
        } else {
        }
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }

}