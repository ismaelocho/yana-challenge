<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User_model extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'users'; 
        $this->load->model('User_activity_model');
    } 
     
    /* 
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function getRows($params = array()){ 
        $this->db->select('*'); 
        $this->db->from($this->table); 
         
        if(array_key_exists("conditions", $params)){ 
            foreach($params['conditions'] as $key => $val){ 
                $this->db->where($key, $val); 
            } 
        } 
         
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
            $result = $this->db->count_all_results(); 
        }
         
        // Return fetched data 
        return $result; 
    } 

    /* 
     * Fetch user data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function get_by($id){ 
        $this->db->from($this->table); 
        $this->db->where("id", $id); 

        $result = $this->db->count_all_results(); 
        // Return fetched data 
        return $result; 
    } 

    /* Login Process */
	function validLogin($email, $password) {
		global $loginConfig;
		$id = null;
		$password = md5($password);
		$this->db->select('*'); 
        $this->db->from($this->table); 
       	$this->db->where("email", $email);
        $this->db->where("password", $password);
        $query = $this->db->get(); 
        if($query->row_array() >= 1){
            foreach ($query->result() as $row)
            {
                $id = $row->id;
            }
            $action = "Nuevo Acceso";
            $data['uid'] = $id;
            $data['datetime'] = date("Y-m-d H:i:s"); 
            $data['timestamp'] = date("Y-m-d H:i:s"); 
            $this->User_activity_model->insert($data, $action);
        }

        return $id; 
	}
     
    /* 
     * Insert user data into the database 
     * @param $data data to be inserted 
     */ 
    public function insert($data = array()) { 
        if(!empty($data)){             
            // Insert member data 
            $insert = $this->db->insert($this->table, $data); 
            $action = "Nuevo Registro";
            $data['uid'] = $this->db->insert_id();
            unset($data["email"]);
            unset($data["password"]);
            $this->User_activity_model->insert($data, $action);
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    } 
}
