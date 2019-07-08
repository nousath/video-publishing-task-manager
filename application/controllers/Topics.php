<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Topics extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Topics_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'topics/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'topics/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'topics/index.html';
            $config['first_url'] = base_url() . 'topics/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Topics_model->total_rows($q);
        $topics = $this->Topics_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'topics_data' => $topics,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('topics/topics_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Topics_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'topic' => $row->topic,
		'stage_id' => $row->stage_id,
		'user_id' => $row->user_id,
		'assigned' => $row->assigned,
		'script' => $row->script,
		'doc' => $row->doc,
		'audio' => $row->audio,
		'video' => $row->video,
		'created_by' => $row->created_by,
		'created_at' => $row->created_at,
	    );
            $this->load->view('topics/topics_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('topics'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('topics/create_action'),
	    'id' => set_value('id'),
	    'topic' => set_value('topic'),
	    'stage_id' => set_value('stage_id'),
	    'user_id' => set_value('user_id'),
	    'assigned' => set_value('assigned'),
	    'script' => set_value('script'),
	    'doc' => set_value('doc'),
	    'audio' => set_value('audio'),
	    'video' => set_value('video'),
	    'created_by' => set_value('created_by'),
	    'created_at' => set_value('created_at'),
	);
        $this->load->view('topics/topics_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'topic' => $this->input->post('topic',TRUE),
		'stage_id' => $this->input->post('stage_id',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'assigned' => $this->input->post('assigned',TRUE),
		'script' => $this->input->post('script',TRUE),
		'doc' => $this->input->post('doc',TRUE),
		'audio' => $this->input->post('audio',TRUE),
		'video' => $this->input->post('video',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->Topics_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('topics'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Topics_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('topics/update_action'),
		'id' => set_value('id', $row->id),
		'topic' => set_value('topic', $row->topic),
		'stage_id' => set_value('stage_id', $row->stage_id),
		'user_id' => set_value('user_id', $row->user_id),
		'assigned' => set_value('assigned', $row->assigned),
		'script' => set_value('script', $row->script),
		'doc' => set_value('doc', $row->doc),
		'audio' => set_value('audio', $row->audio),
		'video' => set_value('video', $row->video),
		'created_by' => set_value('created_by', $row->created_by),
		'created_at' => set_value('created_at', $row->created_at),
	    );
            $this->load->view('topics/topics_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('topics'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'topic' => $this->input->post('topic',TRUE),
		'stage_id' => $this->input->post('stage_id',TRUE),
		'user_id' => $this->input->post('user_id',TRUE),
		'assigned' => $this->input->post('assigned',TRUE),
		'script' => $this->input->post('script',TRUE),
		'doc' => $this->input->post('doc',TRUE),
		'audio' => $this->input->post('audio',TRUE),
		'video' => $this->input->post('video',TRUE),
		'created_by' => $this->input->post('created_by',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->Topics_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('topics'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Topics_model->get_by_id($id);

        if ($row) {
            $this->Topics_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('topics'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('topics'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('topic', 'topic', 'trim|required');
	$this->form_validation->set_rules('stage_id', 'stage id', 'trim|required');
	$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
	$this->form_validation->set_rules('assigned', 'assigned', 'trim|required');
	$this->form_validation->set_rules('script', 'script', 'trim|required');
	$this->form_validation->set_rules('doc', 'doc', 'trim|required');
	$this->form_validation->set_rules('audio', 'audio', 'trim|required');
	$this->form_validation->set_rules('video', 'video', 'trim|required');
	$this->form_validation->set_rules('created_by', 'created by', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Topics.php */
/* Location: ./application/controllers/Topics.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-08 11:06:27 */
/* http://harviacode.com */