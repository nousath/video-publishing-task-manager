<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages extends App_Controller
{
    // function __construct()
    // {
    //     parent::__construct();
    // }

    public function index(){
		$user = $this->ion_auth->user()->row();

		// when user lands on notifications page, set unread to 0
		$data = array(
			'read_status' => 1,
		);

		$messages = $this->Messages_model->get_by_user($user->id);
		foreach ($messages as $message ) {
			$this->Messages_model->update($message->id, $data);
		}

		$data = array(
			'title' => 'Message Box',
			'messages' => $this->Messages_model->get_by_user($user->id),
			'number_of_inbox' => $this->Messages_model->number_of_messages_to_user($user->id),
			'number_of_outbox' => $this->Messages_model->number_of_messages_from_user($user->id),
			'content_header' => 'Message Box',
			'content' => 'messages/index',
		);

		$this->load->view('layouts/main', $data);

	}
	
	// public function multiple_delete(){
	// 	if
	// }

    public function read($id = '') {
       if($id == ''){
			
			redirect(base_url('messages'),'refresh');

	   }else{

			$user = $this->ion_auth->user()->row();

			$data = array(
				'title' => 'Message Box',
				'messages' => $this->Messages_model->get_by_user($user->id),
				'selected_message' => $this->Messages_model->get_by_id($id),
				'number_of_inbox' => $this->Messages_model->number_of_messages_to_user($user->id),
				'number_of_outbox' => $this->Messages_model->number_of_messages_from_user($user->id),
				'content_header' => 'Read Message',
				'content' => 'messages/read',
			);

			$this->load->view('layouts/main', $data);

	   }
    }

    public function compose() {
		$user = $this->ion_auth->user()->row();

        $data = array(
			'send_to' => set_value('send_to'),
			'subject' => set_value('subject'),
			'body' => set_value('body'),
			'title' => 'Compose Message',
			'number_of_inbox' => $this->Messages_model->number_of_messages_to_user($user->id),
			'number_of_outbox' => $this->Messages_model->number_of_messages_from_user($user->id),
			'users' => $this->User_model->get_all_users(),
			'content_header' => 'Read Message',
			'content' => 'messages/compose',
		);

        $this->load->view('layouts/main', $data);
    }
    
    public function compose_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->compose();
        } else {
			$user = $this->ion_auth->user()->row();
            $data = array(
			'send_to' => $this->input->post('send_to',TRUE),
			'send_from' => $user->id,
			'subject' => $this->input->post('subject',TRUE),
			'body' => $this->input->post('body',TRUE),
			'send_at' => time(),
	    );

            $this->Messages_model->insert($data);
            $this->session->set_flashdata('message_send', 'Message Send');
            redirect(site_url('messages'));
        }
    }
    
    
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
				'send_to' => $this->input->post('send_to',TRUE),
				'send_from' => $this->input->post('send_from',TRUE),
				'subject' => $this->input->post('subject',TRUE),
				'body' => $this->input->post('body',TRUE),
				'read_status' => $this->input->post('read_status',TRUE),
				'send_at' => $this->input->post('send_at',TRUE),
			);

            $this->Messages_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('messages'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Messages_model->get_by_id($id);

        if ($row) {
            $this->Messages_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('messages'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('messages'));
        }
    }

    public function _rules() {
		$this->form_validation->set_rules('send_to', 'Send to', 'trim|required');
		$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
		$this->form_validation->set_rules('body', 'Body', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
