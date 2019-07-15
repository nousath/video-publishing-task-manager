<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scripts extends App_Controller
{
    // function __construct(){
    //     parent::__construct();
    // }

    public function index(){
		
		$user = $this->ion_auth->user()->row(); 

       $data = array(
		'scripts_by_user' => $this->Assignment_model->get_by_user_and_stage($user->id, 2),
		'scripts' => $this->Scripts_model->get_by_user($user->id),
		'assigned_topics' => $this->Topics_model->get_by_writer_assigned($user->id),
		'content' => 'scripts/scripts_view',
		'content_header' => 'Manage Script',
		'title' => 'Manage Scripts',
	   );

	   $this->load->view('layouts/main', $data);
	}
	
	public function upload(){
		$this->_upload_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
			$upload = $this->upload_ducument();

			$arr = explode('/',trim($upload));
			if($arr[0] != 'uploads'){
				$this->session->set_flashdata('error_message', $upload);
				redirect(site_url('scripts'));
			}else{

				/* update topic table: insert document link
				---------------------------------------- */
				$data = array(
					'doc' => $upload
				);

				$topic_id = $this->input->post('selected_topic');

				$this->Topics_model->update($topic_id, $data);
				

				/* create row to scripts table, insert document details
				--------------------------------------------------- */

				$user = $this->ion_auth->user()->row(); 

				$data = array(
					'topic_id' => $topic_id,
					'submitted_by' => $user->id,
					'submitted_at' => time(),
				);

				$this->Scripts_model->insert($data);

				/* send notification to admin 
				--------------------------*/

				// get notification template to send
				$notification_template = $this->Notifications_templates_model->get_by_type('script_submitted');
				
				// get list of admins
				$admins = $this->User_model->get_by_usertype(1);

				// loop through admins and send notifications to all
				foreach ($admins as $admin ) {
					$data = array(
						'send_to' => $admin->id,
						'body'    => $user->username.' '.$notification_template->message,
						'created_at' => time(),
					);

					// send notification to user
					$this->Notifications_model->insert($data);
				}

				$this->session->set_flashdata('upload_success', 'Your script has been submitted');
				redirect(site_url('scripts'));
			}
		}
	}

    public function read($id) {
        $row = $this->Scripts_model->get_by_id($id);
        if ($row) {
            $data = array(
			'id' => $row->id,
			'topic_id' => $row->topic_id,
			'submitted_by' => $row->submitted_by,
			'submitted_at' => $row->submitted_at,
			'approved' => $row->approved,
			);
            $this->load->view('scripts/scripts_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('scripts'));
        }
    }

    
    
    public function delete($id) {
        $row = $this->Scripts_model->get_by_id($id);

        if ($row) {
            $this->Scripts_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('scripts'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('scripts'));
        }
    }

    public function _upload_rules() {
		$this->form_validation->set_rules('selected_topic', 'Topic', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
	

	public function _rules() {
		$this->form_validation->set_rules('topic_id', 'topic id', 'trim|required');
		$this->form_validation->set_rules('submitted_by', 'submitted by', 'trim|required');
		$this->form_validation->set_rules('submitted_at', 'submitted at', 'trim|required');
		$this->form_validation->set_rules('approved', 'approved', 'trim|required');

		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
