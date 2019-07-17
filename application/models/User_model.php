<?php

 
class User_model extends CI_Model
{
	public $usertype = 'usertype';
	public $table = 'users';
	public $on_project = 'on_project';


    function __construct()
    {
        parent::__construct();
	}
	

	function get_by_usertype($usertype){
		$this->db->where($this->usertype, $usertype);
        return $this->db->get($this->table)->result();
	}

	function get_by_usertype_and_project_status($usertype, $on_project){
		$this->db->where($this->usertype, $usertype);
		$this->db->where($this->on_project, $on_project);
        return $this->db->get($this->table)->result();
	}

















    
    /*
     * Get user by id
     */
    function get_user($id)
    {
        return $this->db->get_where('users',array('id'=>$id))->row();
    }
        
    /*
     * Get all users
     */
    function get_all_users()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('users')->result();
    }
        
    /*
     * function to add new user
     */
    function add_user($params)
    {
        $this->db->insert('users',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update user
     */
    function update_user($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('users',$params);
    }
    
    /*
     * function to delete user
     */
    function delete_user($id)
    {
        return $this->db->delete('users',array('id'=>$id));
    }
}
