<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class User_activity_model extends CI_Model{ 
    function __construct() { 
        // Set table name 
        $this->table = 'user_activities'; 
    } 

    /* 
     * Fetch user activity by ID data from the database 
     * @param array filter data based on the passed parameters 
     */ 
    function get_by($id){ 
        $this->db->select('*'); 
        $this->db->from($this->table); 
        $this->db->where("uid", $id); 
        $query = $this->db->get(); 
        $arr = [];
        $i = 0;
        if($query->row_array() >= 1){
            foreach ($query->result() as $row)
            {
                $arr[$i]['id'] = $row->id;
                $arr[$i]["messageFrom"] = $row->message_from;
                $arr[$i]["value"] = $row->message_text;
                $arr[$i]["timestamp"] = $row->timestamp;
                $i++;
            }
        }
        $result = $arr; 
        return $result; 
    } 
     
    /* 
     * Insert user_activities data into the database 
     * @param $data data to be inserted 
     */ 
    public function insert($data = array(), $action) { 
        if(!empty($data)){ 
            // Add created and modified date if not included 
            if(!array_key_exists("datetime", $data)){ 
                $data['datetime'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists("timestamp", $data)){ 
                $data['timestamp'] = date("Y-m-d H:i:s"); 
            } 
            if(!array_key_exists("message_from", $data)){ 
                $data['message_from'] = "system"; 
            }
            if(!array_key_exists("message_text", $data)){ 
                $data['message_text'] = $action; 
            } 
            
            // Insert user activity data 
            $insert = $this->db->insert($this->table, $data); 
             
            // Return ID record
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    } 
}