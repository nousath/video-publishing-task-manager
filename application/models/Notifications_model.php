<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications_model extends CI_Model
{

    public $table = 'notifications';
    public $id = 'id';
    public $send_to = 'send_to';
    public $read_status = 'read_status';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
	}

	function get_num_all(){
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->num_rows();
    }

	
	function get_by_user($user_id, $limit = 0)
    {
		if($limit == 0){
			$this->db->where($this->send_to, $user_id);
			$this->db->order_by($this->id, $this->order);
			return $this->db->get($this->table)->result();
		}else{
			$this->db->where($this->send_to, $user_id);
			$this->db->order_by($this->id, $this->order)->limit($limit);
			return $this->db->get($this->table)->result();
		}
		
	}
	
	function count_unread_notifications($user_id, $read_status)
    {
		$this->db->where($this->send_to, $user_id);
		$this->db->where($this->read_status, $read_status);
		$this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->num_rows();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}
	
	function number_of_notifications_to_user($user_id){
		$this->db->where($this->send_to, $user_id);
		$this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->num_rows();
	}
    
  

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
	}
	
	function delete_by_to($id){
		$this->db->where($this->send_to, $id);
        $this->db->delete($this->table);
	}

}
