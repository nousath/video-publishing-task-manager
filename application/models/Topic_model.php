<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Topic_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get topic by id
     */
    function get_topic($id)
    {
        return $this->db->get_where('topics',array('id'=>$id))->row_array();
    }
    
    /*
     * Get all topics count
     */
    function get_all_topics_count()
    {
        $this->db->from('topics');
        return $this->db->count_all_results();
    }
        
    /*
     * Get all topics
     */
    function get_all_topics($params = array())
    {
        $this->db->order_by('id', 'desc');
        if(isset($params) && !empty($params))
        {
            $this->db->limit($params['limit'], $params['offset']);
        }
        return $this->db->get('topics')->result_array();
    }
        
    /*
     * function to add new topic
     */
    function add_topic($params)
    {
        $this->db->insert('topics',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update topic
     */
    function update_topic($id,$params)
    {
        $this->db->where('id',$id);
        return $this->db->update('topics',$params);
    }
    
    /*
     * function to delete topic
     */
    function delete_topic($id)
    {
        return $this->db->delete('topics',array('id'=>$id));
    }
}