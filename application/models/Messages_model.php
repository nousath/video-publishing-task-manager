<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages_model extends CI_Model
{

    public $table = 'messages';
    public $id = 'id';
    public $read_status = 'read_status';
    public $send_to = 'send_to';
    public $send_from = 'send_from';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
	}
	

	function get_by_user($user_id, $limit = '')
    {
		if($limit == ''){
			$this->db->where($this->send_to, $user_id);
			$this->db->order_by($this->id, $this->order);
			return $this->db->get($this->table)->result();
		}else{
			$this->db->where($this->send_to, $user_id);
			$this->db->order_by($this->id, $this->order)->limit($limit);
			return $this->db->get($this->table)->result();
		}
		
	}

	function count_unread_messages($user_id, $read_status)
    {
		$this->db->where($this->send_to, $user_id);
		$this->db->where($this->read_status, $read_status);
		$this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->num_rows();
	}
	
	function number_of_messages_to_user($user_id){
		$this->db->where($this->send_to, $user_id);
		$this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->num_rows();
	}
	
	function number_of_messages_from_user($send_from){
		$this->db->where($this->send_from, $send_from);
		$this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->num_rows();
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


    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
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
	
	function delete_by_tofrom($id){
		$this->db->where($this->send_to, $id);
		$this->db->where($this->send_from, $id);
        $this->db->delete($this->table);
	}

}
