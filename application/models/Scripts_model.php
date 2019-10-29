<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scripts_model extends CI_Model
{

    public $table = 'scripts';
    public $id = 'id';
    public $is_reserved = 'is_reserved';
    public $submitted_by = 'submitted_by';
	public $order = 'DESC';
	public $is_draft = 'is_draft';
	public $topic_id = 'topic_id';

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
    
    // get the number of rows
    function get_num_rows($id = ""){
        if($id == ""){
            return $this->db->get($this->table)->num_rows();
        }else{
            $this->db->where($this->id, $id);
            return $this->db->get($this->table)->num_rows();
        }
        
    }
    
    // get the number of rows
    function get_num_rows_by_topic($topic_id = ""){
        if($topic_id == ""){
            return $this->db->get($this->table)->num_rows();
        }else{
            $this->db->where($this->topic_id, $topic_id);
            return $this->db->get($this->table)->num_rows();
        }
        
	}

	function get_by_user($user_id){
		$this->db->where($this->submitted_by, $user_id);
        return $this->db->get($this->table)->result();
	}

	function get_by_reserved($is_reserved){
		$this->db->where($this->is_reserved, $is_reserved);
        return $this->db->get($this->table)->result();
	}

	function get_by_reserved_and_draft($is_reserved, $is_draft){
		$this->db->where($this->is_reserved, $is_reserved);
		$this->db->where($this->is_draft, $is_draft);
        return $this->db->get($this->table)->result();
	}

	function get_drafts($drafts_id){
		$this->db->where($this->is_draft, $drafts_id);
		return $this->db->get($this->table)->result();
	}

	function get_by_days($days){
		// $query = $this->db->query("SELECT * FROM audios WHERE DATEDIFF(NOW(), FROM_UNIXTIME(submitted_at)) >= 30");
		$this->db->where("DATEDIFF(NOW(), FROM_UNIXTIME(submitted_at)) >= $days");
		return $this->db->get($this->table)->result();
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
		return true;
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

