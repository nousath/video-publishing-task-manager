<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Topics extends App_Controller
{
    function __construct()
    {
        parent::__construct();
        $user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 ){
			
			redirect(base_url('dashboard'),'refresh');
				
		}
    }

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
	
	public function get_by_channel(){
		if ($this->input->post('channel_id')) {
			echo $this->User_model->get_by_channel($this->input->post('channel_id'), 2);
		}
	}

    public function doc($id = '', $doc_id = ''){
		if($id == '' ||  $doc_id == ''){
			
			redirect(base_url('topics'),'refresh');
			
		}else{
			$data = array(
				'title' => 'Document',
				'content' => 'topics/doc',
				'topic'  => $this->Topics_model->get_by_id($id),
				'doc_id' => $doc_id,
				'comments' => $this->Comments_model->get_comments(1, $doc_id),
				'user' => $this->ion_auth->user()->row(),
				'comment' => set_value('comment'),
				'content_header' => 'View Script',
			);
	
			$this->load->view('layouts/main', $data);
		}
       
	}
	

	public function audio($id = '', $audio_id){
		if($id == '' || $audio_id == ''){
			
			redirect(base_url('topics'),'refresh');
			
		}else{
			$data = array(
				'title' => 'Audio',
				'content' => 'topics/audio',
				'topic'  => $this->Topics_model->get_by_id($id),
				'content_header' => 'Audio',
				'audio_id' => $audio_id,
				'comments' => $this->Comments_model->get_comments(2, $audio_id),
				'user' => $this->ion_auth->user()->row(),
				'comment' => set_value('comment'),

			);
	
			$this->load->view('layouts/main', $data);
		}
       
	}

	public function video($id = '', $video_id = ''){
		if($id == '' || $video_id == ''){
			
			redirect(base_url('topics'),'refresh');
			
		}else{
			$data = array(
				'title' => 'Video',
				'content' => 'topics/video',
				'topic'  => $this->Topics_model->get_by_id($id),
				'content_header' => 'Video',
				'video_id' => $video_id,
				'comments' => $this->Comments_model->get_comments(3, $video_id),
				'user' => $this->ion_auth->user()->row(),
				'comment' => set_value('comment'),

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
			'users' => $this->User_model->get_by_usertype(2),
			'stages' => $this->Stages_model->get_all(),
			'channels' => $this->Channels_model->get_all(),
		);

        $this->load->view('layouts/main', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->add();
        } else {
			$user = $this->ion_auth->user()->row();
			// $assign = $this->input->post('assignto',TRUE);

			$data = array(
				'channel_id' => $this->input->post('channel',TRUE),
				'topic' => $this->input->post('topic',TRUE),
				'user_id' => $this->input->post('assignto',TRUE),
				'stage_id' => $this->input->post('stage',TRUE),
				'created_by' => $user->id,
				'created_at' => time(),
			);

			$this->Topics_model->insert($data);
			$inserted_topic_id = $this->db->insert_id();

			// register assignment of topic to writer
			$user_id = $this->input->post('assignto',TRUE);

			$data = array(
				'topic_id' => $inserted_topic_id,
				'user_id' => $user_id,
				'stage_id' => 2, // writing stage
			);

			// update -> add user's id to 
			$this->Assignment_model->insert($data);

			// indicate user as currently on project
			$data = array(
				'on_project' => 1,
			);
			$this->User_model->update_user($user_id, $data);

			// get notification template to send
			$notification_template = $this->Notifications_templates_model->get_by_type('new_topic');
			
			$data = array(
				'send_to' => $user_id,
				'body'    => $notification_template->message,
				'created_at' => time(),
			);

			// send notification to user
			$this->Notifications_model->insert($data);


            $this->session->set_flashdata('success_message', 'Topic has been created');
            redirect(site_url('topics'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Topics_model->get_by_id($id);

        if ($row) {
            $data = array(
                'action' => site_url('topics/update_action'),
				'id' => set_value('id', $row->id),
				'topic' => set_value('topic', $row->topic),
				'channels' => $this->Channels_model->get_all(),
				'content' => 'topics/edit_form',
				'content_header' => 'Topic',
				'title' => 'Edit Topic',
				);
            $this->load->view('layouts/main', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('topics'));
        }
    }
    
	public function update_action() 
	{
		if($this->input->post('topic',TRUE)){
			$data = array(
				'topic' => $this->input->post('topic',TRUE),
				'channel_id' => $this->input->post('channel',TRUE),
			);
	
			$this->Topics_model->update($this->input->post('id', TRUE), $data);
			$this->session->set_flashdata('message', 'Topic updated!');
			redirect(site_url('topics'));
		}else{
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
	
	// public function assign_to_writer(){
	// 	$topics = $this->Topics_model->get_by_stage_and_assigned(5, 0);
	// 	$writers = $this->User_model->get_by_usertype(4);
	// }

	// public function assign_to_voiceartist(){
		
	// }

	// public function assign_to_editor(){
		
	// }

    public function _rules() 
    {
		$this->form_validation->set_rules('topic', 'Topic', 'trim|required');
		$this->form_validation->set_rules('stage_id', 'stage id', 'trim');
		$this->form_validation->set_rules('assigned', 'assigned', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}



