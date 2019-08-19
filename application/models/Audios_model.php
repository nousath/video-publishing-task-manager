<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Audios_model extends CI_Model
{

    public $table = 'audios';
    public $id = 'id';
    public $submitted_by = 'submitted_by';
	public $submitted_at = 'submitted_at';
	public $is_reserved = 'is_reserved';
	public $is_draft = 'is_draft';
	
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
	
	function get_by_user($user_id){
		$this->db->where($this->submitted_by, $user_id);
        return $this->db->get($this->table)->result();
	}
	

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
	}
	
    function get_by_days($days){
		// $query = $this->db->query("SELECT * FROM audios WHERE DATEDIFF(NOW(), FROM_UNIXTIME(submitted_at)) >= 30");
		$this->db->where("DATEDIFF(NOW(), FROM_UNIXTIME(submitted_at)) >= $days");
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
