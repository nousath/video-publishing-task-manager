<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Audios extends App_Controller
{
    function __construct()
    {
		parent::__construct();
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 && $user->usertype != 3){
			
			redirect(base_url('dashboard'),'refresh');
				
		}

    }

    public function index(){
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype == 1){
			// admin view
			$data = array(
				'audios' => $this->Audios_model->get_all(),
				'content' => 'audios/admin_audios_view',
				'content_header' => 'Manage Audios',
				'title' => 'Manage Audios',
			);
	
			$this->load->view('layouts/main', $data);


		}elseif($user->usertype == 3){
			// writer view
			$data = array(
				'audios_by_user' => $this->Assignment_model->get_by_user_and_stage($user->id, 3),
				'audios' => $this->Audios_model->get_by_user($user->id),
				'assigned_scripts' => $this->Topics_model->get_by_artist_assigned($user->id),
				'content' => 'audios/audios_view',
				'content_header' => 'Manage Script',
				'title' => 'Manage Scripts',
			);
	
			$this->load->view('layouts/main', $data);
		}
	}  

	public function assign($topic_id = ''){
		
		// ensure that only admin is allowed
		$user = $this->ion_auth->user()->row(); 
		if($user->usertype != 1){
			redirect(base_url('dashboard'),'refresh');
		}

		// ensure topic id is present
		if($topic_id == ''){
			redirect(base_url('audios'),'refresh');	
		}

		$topic = $this->Topics_model->get_by_id($topic_id);
		$data = array(
			'selected_topic' => $topic,
			'editors' => $this->User_model->get_by_usertype_and_channel(4, $topic->channel_id),
			'content' => 'audios/assign_form',
			'content_header' => 'Assign Audio',
			'title' => 'Assign Audios',
		);

		$this->load->view('layouts/main', $data);
	}
	
	public function assign_to_editor(){
		// ensure that only admin is allowed
		$user = $this->ion_auth->user()->row(); 
		if($user->usertype != 1){
			redirect(base_url('dashboard'),'refresh');
		}

		
		$this->_assignment_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->assign();
		} else {
			// insert into assignment table
			$data = array(
				'topic_id' => $this->input->post('topic_id',TRUE),
				'user_id' => $this->input->post('user',TRUE),
				'stage_id' => 4,
			);
			$this->Assignment_model->insert($data);

			// update user2_id in topics table
			$data =  array(
				'user3_id' => $this->input->post('user',TRUE),
			);
			$this->Topics_model->update($this->input->post('topic_id',TRUE), $data);

			// Send notification to user
			$notification_template = $this->Notifications_templates_model->get_by_type('new_audio');
		
			$data = array(
				'send_to' => $this->input->post('user',TRUE),
				'body'    => $notification_template->message,
				'created_at' => time(),
			);
			$this->Notifications_model->insert($data);

			$user_assigned = $this->ion_auth->user($this->input->post('user',TRUE))->row();
			$this->session->set_flashdata('assingment_success', 'Topic assigned to '.$user_assigned->username.' ');
			redirect(site_url('audios'));
		}
		
	}
	
	public function toggle_approve($audio_id = ''){
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1){
			redirect(base_url('dashboard'),'refresh');
		}


		
		if($audio_id == ''){
			
			redirect(base_url('audios'),'refresh');
			
		}else{
			 // update aproval status for script
			 $audio = $this->Audios_model->get_by_id($audio_id);
 
			 $approved = ($audio->approved == 0) ? 1 : 0;
			 
			 $data = array(
				 'approved' => $approved,
			 );
 
			 if($this->Audios_model->update($audio_id, $data)){
				 // send notification to user
				 $notification_template = $this->Notifications_templates_model->get_by_type('admin_response_audio');
				 
				 $data = array(
					 'send_to' => $audio->submitted_by,
					 'body'    => $notification_template->message,
					 'created_at' => time(),
				 );
				 $this->Notifications_model->insert($data);
 
 
				 // add to number of competed projects
				 $user = $this->ion_auth->user()->row();
				 $task_completed = ($approved == 1) ? $user->tasks_completed + 1 : 0;
				 $on_project = ($approved == 1) ? 0 : 1;
				 $data = array(
					 'tasks_completed' => $task_completed,
					 'on_project' => $on_project,
				 );
				 $this->User_model->update_user($user->id, $data);
 
				 
				//  if($approved == 1){
				// 	 // assign topic to video editor
				// 	 $video_editors_off_projects = $this->User_model->get_by_usertype_and_project_status(4, 0);
				// 	 if($video_editors_off_projects == null){
				// 		 // all video editors have ongoing projects
				// 		 $all_video_editors = $this->User_model->get_by_usertype(4);
				// 		 foreach ($all_video_editors as $editor ) {
				// 			 $data = array(
				// 				 'topic_id' => $audio->topic_id,
				// 				 'user_id' => $editor->id,
				// 				 'stage_id' => 4, // writing stage
				// 			 );
				// 			 $this->Assignment_model->insert($data);
	 
				// 			 // indicate user as currently on project
				// 			 $data = array(
				// 				 'on_project' => 1,
				// 			 );
				// 			 $this->User_model->update_user($editor->id, $data);
 
				// 			 // set user in charge of topic
				// 			 $data = array(
				// 				 'user3_id' => $editor->id,
				// 			 );
				// 			 $this->Topics_model->update($audio->topic_id, $data);
	 
				// 			 // get notification template to send
				// 			 $notification_template = $this->Notifications_templates_model->get_by_type('new_audio');
							 
				// 			 $data = array(
				// 				 'send_to' => $editor->id,
				// 				 'body'    => $notification_template->message,
				// 				 'created_at' => time(),
				// 			 );
				// 			 $this->Notifications_model->insert($data);
	 
				// 			 break;
				// 		 }
	 
				// 	 }else{
				// 		 // at least one voice artist is without task
				// 		 foreach ($video_editors_off_projects as $editor ) {
	 
				// 			 $data = array(
				// 				 'topic_id' => $audio->topic_id,
				// 				 'user_id' => $editor->id,
				// 				 'stage_id' => 4, // writing stage
				// 			 );
				// 			 $this->Assignment_model->insert($data);
	 
				// 			 // indicate user as currently on project
				// 			 $data = array(
				// 				 'on_project' => 1,
				// 			 );
				// 			 $this->User_model->update_user($editor->id, $data);
 
				// 			 // set user in charge of topic
				// 			 $data = array(
				// 				 'user3_id' => $editor->id,
				// 			 );
				// 			 $this->Topics_model->update($audio->topic_id, $data);
	 
				// 			 // get notification template to send
				// 			 $notification_template = $this->Notifications_templates_model->get_by_type('new_script');
							 
				// 			 $data = array(
				// 				 'send_to' => $editor->id,
				// 				 'body'    => $notification_template->message,
				// 				 'created_at' => time(),
				// 			 );
				// 			 $this->Notifications_model->insert($data);
	 
				// 			 break;
							 
				// 		 }
				// 	 }
				//  }
 
 
				 // redirect admin back to scriipts page with an alert
				 $this->session->set_flashdata('toggle_success', 'Approval status updated!');
				 redirect(site_url('audios'));
			 }
		}
	}
	
	public function delete($id) {
        $row = $this->Audios_model->get_by_id($id);

        if ($row) {
            $this->Audios_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('audios'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('audios'));
        }
	}
	
	public function upload(){
		$this->_upload_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
			$upload = $this->upload_audio();

			$arr = explode('/',trim($upload));
			if($arr[0] != 'uploads'){
				$this->session->set_flashdata('error_message', $upload);
				redirect(site_url('audios'));
			}else{

				/* update topic table: insert document link
				---------------------------------------- */
				$data = array(
					'audio' => $upload
				);

				$topic_id = $this->input->post('selected_topic');

				$this->Topics_model->update($topic_id, $data);
				

				/* create row to audios table, insert document details
				--------------------------------------------------- */

				$user = $this->ion_auth->user()->row(); 

				$data = array(
					'topic_id' => $topic_id,
					'submitted_by' => $user->id,
					'submitted_at' => time(),
				);

				$this->Audios_model->insert($data);

				/* send notification to admin 
				--------------------------*/

				// get notification template to send
				$notification_template = $this->Notifications_templates_model->get_by_type('audio_submitted');
				
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

				$this->session->set_flashdata('upload_success', 'Your audio has been submitted');
				redirect(site_url('audios'));
			}
		}
	}

	public function _upload_rules() {
		$this->form_validation->set_rules('selected_topic', 'Topic', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function _assignment_rules() {
		$this->form_validation->set_rules('topic', 'Topic', 'trim');
		$this->form_validation->set_rules('user', 'user', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
