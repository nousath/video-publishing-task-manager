<?php

 
class User_model extends CI_Model
{
	public $id = 'id';
	public $usertype = 'usertype';
	public $table = 'users';
	public $channel_id = 'channel_id';
	public $on_project = 'on_project';


    function __construct()
    {
        parent::__construct();
	}

	// get data by state
    function get_by_channel($channel_id, $usertype = ''){
        if($usertype != ''){
			$this->db->where($this->channel_id, $channel_id);
			$this->db->where($this->usertype, $usertype);
			$query = $this->db->get($this->table);
			$output = '<option value=""> </option>';

			foreach ($query->result() as $row) {
				$output .= '<option value="'.$row->id.'">'.$row->username.'</option>';
			}

			return $output;
		}else{
			$this->db->where($this->channel_id, $channel_id);
			$query = $this->db->get($this->table);
			$output = '<option value=""> </option>';

			foreach ($query->result() as $row) {
				$output .= '<option value="'.$row->id.'">'.$row->username.'</option>';
			}

			return $output;
		}
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

	function get_by_usertype_and_channel($usertype, $channel_id){
		$this->db->where($this->usertype, $usertype);
		$this->db->where($this->channel_id, $channel_id);
        return $this->db->get($this->table)->result();
	}

	function get_num_all(){
        return $this->db->get($this->table)->num_rows();
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
