<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assignment_model extends CI_Model
{

    public $table = 'assignment';
    public $id = 'id';
    public $user_id = 'user_id';
    public $stage_id = 'stage_id';
    public $topic_id = 'topic_id';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}
	

	function get_by_user_and_stage($user_id, $stage_id){
		$this->db->where($this->user_id, $user_id);
		$this->db->where($this->stage_id, $stage_id);
        return $this->db->get($this->table)->result();
    }
    
    function get_by_user_and_topic($user_id, $topic_id){
		$this->db->where($this->user_id, $user_id);
		$this->db->where($this->topic_id, $topic_id);
        return $this->db->get($this->table)->row();
    }
    
    function get_by_topic($topic_id){
		$this->db->where($this->topic_id, $topic_id);
        return $this->db->get($this->table)->row();
	}

	function get_by_user($user_id){
		$this->db->where($this->user_id, $user_id);
        return $this->db->get($this->table)->result();
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
	
	function delete_by_user($id)
    {
        $this->db->where($this->user_id, $id);
        $this->db->delete($this->table);
    }

}
