<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backups_model extends CI_Model
{

    public $table = 'backups';
    public $id = 'id';
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
	
	function get_last_inserted_row(){
		$this->db->where("id = LAST_INSERT_ID()");
		$query = $this->db->query("SELECT * FROM backups ORDER BY id DESC LIMIT 1");
		return $query->row();
		// return $this->db->get($this->table)->row();
	}

	// function get_last_inserted_row($days = ''){
	// 	$this->db->where("DATEDIFF(NOW(), FROM_UNIXTIME(submitted_at)) >= $days");
	// 	return $this->db->get($this->table)->result();
	// }
	
	function get_days_from_last_inserted($date, $days){
		$this->db->where("DATEDIFF(NOW(), FROM_UNIXTIME($date)) >= $days");
		$result = $this->db->get($this->table)->result();
		if($result != '' && $result != null){
			return true;
		}else{return false;}
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // insert data
    function insert($data){
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

}


