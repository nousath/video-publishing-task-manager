<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Topics_model extends CI_Model
{

    public $table = 'topics';
    public $id = 'id';
    public $order = 'DESC';
    public $stage_id = 'stage_id';
    public $user_id = 'user_id';
    public $user2_id = 'user2_id';
    public $user3_id = 'user3_id';
    public $assigned = 'assigned';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all(){
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
	}
	
    function get_num_all(){
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->num_rows();
    }

    // get data by id
    function get_by_id($id){
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}
	
	function get_by_writer_assigned($writer_id){
        $this->db->where($this->user_id, $writer_id);
        return $this->db->get($this->table)->result();
	}
	
	function get_by_artist_assigned($artist_id){
        $this->db->where($this->user2_id, $artist_id);
        return $this->db->get($this->table)->result();
	}
	
	function get_by_editor_assigned($editor_id){
        $this->db->where($this->user3_id, $editor_id);
        return $this->db->get($this->table)->result();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
		$this->db->or_like('topic', $q);
		$this->db->or_like('stage_id', $q);
		$this->db->or_like('user_id', $q);
		$this->db->or_like('assigned', $q);
		$this->db->or_like('script', $q);
		$this->db->or_like('doc', $q);
		$this->db->or_like('audio', $q);
		$this->db->or_like('video', $q);
		$this->db->or_like('created_by', $q);
		$this->db->or_like('created_at', $q);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
		$this->db->or_like('topic', $q);
		$this->db->or_like('stage_id', $q);
		$this->db->or_like('user_id', $q);
		$this->db->or_like('assigned', $q);
		$this->db->or_like('script', $q);
		$this->db->or_like('doc', $q);
		$this->db->or_like('audio', $q);
		$this->db->or_like('video', $q);
		$this->db->or_like('created_by', $q);
		$this->db->or_like('created_at', $q);
		$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data){
        $this->db->where($this->id, $id);
		$this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
	}
	
	function get_by_stage_and_assigned($stage, $assigned){
		$this->db->where($this->stage_id, $stage);
		$this->db->where($this->assigned, $assigned);
        return $this->db->get($this->table)->result();
	}

}
