<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Notifications_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'notifications/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'notifications/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'notifications/index.html';
            $config['first_url'] = base_url() . 'notifications/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Notifications_model->total_rows($q);
        $notifications = $this->Notifications_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'notifications_data' => $notifications,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('notifications/notifications_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Notifications_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'send_to' => $row->send_to,
		'body' => $row->body,
		'read_status' => $row->read_status,
		'created_at' => $row->created_at,
	    );
            $this->load->view('notifications/notifications_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('notifications'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('notifications/create_action'),
	    'id' => set_value('id'),
	    'send_to' => set_value('send_to'),
	    'body' => set_value('body'),
	    'read_status' => set_value('read_status'),
	    'created_at' => set_value('created_at'),
	);
        $this->load->view('notifications/notifications_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'send_to' => $this->input->post('send_to',TRUE),
		'body' => $this->input->post('body',TRUE),
		'read_status' => $this->input->post('read_status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->Notifications_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('notifications'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Notifications_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('notifications/update_action'),
		'id' => set_value('id', $row->id),
		'send_to' => set_value('send_to', $row->send_to),
		'body' => set_value('body', $row->body),
		'read_status' => set_value('read_status', $row->read_status),
		'created_at' => set_value('created_at', $row->created_at),
	    );
            $this->load->view('notifications/notifications_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('notifications'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'send_to' => $this->input->post('send_to',TRUE),
		'body' => $this->input->post('body',TRUE),
		'read_status' => $this->input->post('read_status',TRUE),
		'created_at' => $this->input->post('created_at',TRUE),
	    );

            $this->Notifications_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('notifications'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Notifications_model->get_by_id($id);

        if ($row) {
            $this->Notifications_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('notifications'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('notifications'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('send_to', 'send to', 'trim|required');
	$this->form_validation->set_rules('body', 'body', 'trim|required');
	$this->form_validation->set_rules('read_status', 'read status', 'trim|required');
	$this->form_validation->set_rules('created_at', 'created at', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Notifications.php */
/* Location: ./application/controllers/Notifications.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-07-11 15:55:04 */
/* http://harviacode.com */