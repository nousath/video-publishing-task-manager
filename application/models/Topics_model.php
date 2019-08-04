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
    public $is_reserved = 'is_reserved';
    public $channel_id = 'channel_id';

    function __construct()
    {
        parent::__construct();
	}

    // get all
    function get_all($stage_id = '',  $is_equal_to = ''){
		if($stage_id == '' && $is_equal_to == ''){
			$this->db->order_by($this->id, $this->order);
			return $this->db->get($this->table)->result();
		}else{
			if($is_equal_to == true){
				$this->db->where($this->stage_id, $stage_id);
				$this->db->where($this->is_reserved, 1);
				$this->db->order_by($this->id, $this->order);
				return $this->db->get($this->table)->result();
			}elseif($is_equal_to == false){
				$this->db->where("stage_id != $stage_id");
				$this->db->order_by($this->id, $this->order);
				return $this->db->get($this->table)->result();
			}
			
		}
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

	function get_by_channel($channel_id){
        $this->db->where($this->channel_id, $channel_id);
        return $this->db->get($this->table)->result();
	}

	function num_by_channel($channel_id){
        $this->db->where($this->channel_id, $channel_id);
        return $this->db->get($this->table)->num_rows();
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

