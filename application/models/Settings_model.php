<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings_model extends CI_Model
{

    public $table = 'settings';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('system_name', $q);
	$this->db->or_like('header', $q);
	$this->db->or_like('footer', $q);
	$this->db->or_like('tagline', $q);
	$this->db->or_like('app_mode', $q);
	$this->db->or_like('delete_docs_in', $q);
	$this->db->or_like('delete_audios_in', $q);
	$this->db->or_like('delete_videos_in', $q);
	$this->db->or_like('backup_in', $q);
	$this->db->or_like('delete_notifications_in', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
	$this->db->or_like('system_name', $q);
	$this->db->or_like('header', $q);
	$this->db->or_like('footer', $q);
	$this->db->or_like('tagline', $q);
	$this->db->or_like('app_mode', $q);
	$this->db->or_like('delete_docs_in', $q);
	$this->db->or_like('delete_audios_in', $q);
	$this->db->or_like('delete_videos_in', $q);
	$this->db->or_like('backup_in', $q);
	$this->db->or_like('delete_notifications_in', $q);
	$this->db->limit($limit, $start);
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

}

/* End of file Settings_model.php */
/* Location: ./application/models/Settings_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-19 11:21:50 */
/* http://harviacode.com */