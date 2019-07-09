<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Topics extends CI_Controller
{
    // function __construct()
    // {
    //     parent::__construct();
    //     $this->load->model('Topics_model');
    //     $this->load->library('form_validation');
    // }

    public function index()
    {
		$data = array(
			'title' => 'Topics',
			'content' => 'topics/index',
			'topics'  => $this->Topics_model->get_all(),
			'content_header' => 'Topics List',
		);

        $this->load->view('layouts/main', $data);
    }

    public function doc($id = ''){
		if($id == ''){
			
			redirect(base_url('topics'),'refresh');
			
		}else{
			$data = array(
				'title' => 'Document',
				'content' => 'topics/doc',
				'topic'  => $this->Topics_model->get_by_id($id),
				'content_header' => 'Document',
			);
	
			$this->load->view('layouts/main', $data);
		}
       
	}
	

	public function audio($id = ''){
		if($id == ''){
			
			redirect(base_url('topics'),'refresh');
			
		}else{
			$data = array(
				'title' => 'Audio',
				'content' => 'topics/audio',
				'topic'  => $this->Topics_model->get_by_id($id),
				'content_header' => 'Audio',
			);
	
			$this->load->view('layouts/main', $data);
		}
       
	}

	public function video($id = ''){
		if($id == ''){
			
			redirect(base_url('topics'),'refresh');
			
		}else{
			$data = array(
				'title' => 'Video',
				'content' => 'topics/video',
				'topic'  => $this->Topics_model->get_by_id($id),
				'content_header' => 'Vedeo',
			);
	
			$this->load->view('layouts/main', $data);
		}
       
	}

    public function add() {
        $data = array(
			'topic' => set_value('topic'),
			'assignto' => set_value('assignto'),
			'content' => 'topics/topics_form',
			'content_header' => 'Topic',
			'title' => 'New Topic',
			'users' => $this->User_model->get_all_users(),
		);

        $this->load->view('layouts/main', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
			$user = $this->ion_auth->user()->row();
			$assign = $this->input->post('assingto',TRUE);

			$data = array(
				'topic' => $this->input->post('topic',TRUE),
				'user_id' => $this->input->post('assingto',TRUE),
				'stage_id' => 5,
				'created_by' => $user->id,
				'created_at' => time(),
			);

            $this->Topics_model->insert($data);
            $this->session->set_flashdata('success_message', 'Topic has been created');
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
            $this->session->set_flashdata('delete_message', 'Delete Record Success');
            redirect(site_url('topics'));
        } else {
            $this->session->set_flashdata('delete_message', 'Record Not Found');
            redirect(site_url('topics'));
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('topic', 'topic', 'trim|required');
		$this->form_validation->set_rules('stage_id', 'stage id', 'trim');
		$this->form_validation->set_rules('assigned', 'assigned', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Topics.php */
/* Location: ./application/controllers/Topics.php */
/* Please DO NOT modify this information : */

