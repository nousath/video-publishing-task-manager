<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comments_model extends CI_Model
{

    public $table = 'comments';
    public $comment_from = 'comment_from';
    public $comment_to = 'comment_to';
    public $media_type = 'media_type';
    public $media_id = 'media_id';
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
	
	function get_comments($media_type, $media_id){
        $this->db->where($this->media_type, $media_type);
        $this->db->where($this->media_id, $media_id);
		$this->db->order_by($this->id, $this->order);
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
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
