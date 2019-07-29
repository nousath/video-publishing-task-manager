<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Videos extends App_Controller
{
    function __construct(){
		parent::__construct();
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 && $user->usertype != 4){
			
			redirect(base_url('dashboard'),'refresh');
				
		}
    }

    public function index($video_id = ''){
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype == 1){
			// admin view
			$data = array(
				'videos' => $this->Videos_model->get_all(),
				'content' => 'videos/admin_videos_view',
				'content_header' => 'Manage Videos',
				'title' => 'Manage Videos',
			);
	
			$this->load->view('layouts/main', $data);


		}elseif($user->usertype == 4){
			// writer view

			if($video_id == ''){
				$data = array(
					'videos_by_user' => $this->Assignment_model->get_by_user_and_stage($user->id, 4),
					'videos' => $this->Videos_model->get_by_user($user->id),
					'assigned_audios' => $this->Topics_model->get_by_editor_assigned($user->id),
					'content' => 'videos/videos_view',
					'content_header' => 'Manage Videos',
					'title' => 'Manage Videos',
				);
		
				$this->load->view('layouts/main', $data);
			}else{
				$data = array(
					'content' => 'videos/comments',
					'content_header' => 'Comments',
					'video' => $this->Videos_model->get_by_id($video_id),
					'user' => $this->ion_auth->user()->row(),
					'video_id' => $video_id,
					'comments' => $this->Comments_model->get_comments(3, $video_id),
					'title' => 'Comments on this video',
				);
		
				$this->load->view('layouts/main', $data);
			}
			
		}
	}
	
	public function upload(){
		$this->_upload_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {

			$upload = $this->upload_video();

			$arr = explode('/',trim($upload));
			if($arr[0] != 'uploads'){
				$this->session->set_flashdata('error_message', $upload);
				redirect(site_url('videos'));
			}else{

				/* update topic table: insert document link
				---------------------------------------- */
				$data = array(
					'video' => $upload
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

				$this->Videos_model->insert($data);

				/* send notification to admin 
				--------------------------*/

				// get notification template to send
				$notification_template = $this->Notifications_templates_model->get_by_type('video_submitted');
				
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
				redirect(site_url('videos'));
			}
		}
	}

	public function toggle_approve($video_id = ''){
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1){
			redirect(base_url('dashboard'),'refresh');
		}

		if($video_id == ''){
			
			redirect(base_url('videos'),'refresh');
			
		}else{
			 // update aproval status for script
			 $video = $this->Videos_model->get_by_id($video_id);
 
			 $approved = ($video->approved == 0) ? 1 : 0;
			 
			 $data = array(
				 'approved' => $approved,
			 );
 
			 if($this->Videos_model->update($video_id, $data)){
				 // send notification to user
				 $notification_template = $this->Notifications_templates_model->get_by_type('admin_response_video');
				 
				 $data = array(
					 'send_to' => $video->submitted_by,
					 'body'    => $notification_template->message,
					 'created_at' => time(),
				 );
				 $this->Notifications_model->insert($data);
 
 
				 // add to number of competed projects
				 $user = $this->ion_auth->user()->row();
				 $task_completed = ($approved == 1) ? $user->tasks_completed + 1 : 0;
				 $data = array(
					 'tasks_completed' => $task_completed,
				 );
				 $this->User_model->update_user($user->id, $data);
 
				 
				 if($approved == 1){
					$data = array(
						'on_project' => 0,
					);
					$this->User_model->update_user($video->submitted_by, $data);
				 }
 
 
				 // redirect admin back to scriipts page with an alert
				 $this->session->set_flashdata('toggle_success', 'Approval status updated!');
				 redirect(site_url('videos'));
			 }
		}
	}

	public function publish($topic_id = ''){
		$user = $this->ion_auth->user()->row(); 
		if($user->usertype != 1){
			redirect(base_url('dashboard'),'refresh');
		}

		if($topic_id == ''){
			redirect(base_url('videos'),'refresh');
		}else{
			$data = array(
				'stage_id' => 5,
			);
			$this->Topics_model->update($topic_id, $data);
			$this->session->set_flashdata('video_published', 'Video marked as Published');
			redirect(site_url('videos'));
		}
	}

	public function reserve($topic_id = ''){
		$user = $this->ion_auth->user()->row(); 
		if($user->usertype != 1){
			redirect(base_url('dashboard'),'refresh');
		}

		if($topic_id == ''){
			redirect(base_url('videos'),'refresh');
		}else{
			$data = array(
				'stage_id' => 1,
			);
			$this->Topics_model->update($topic_id, $data);
			$this->session->set_flashdata('video_reserved', 'Video Reserved');
			redirect(site_url('videos'));
		}
	}

    public function delete($id) {
        $row = $this->Videos_model->get_by_id($id);

        if ($row) {
            $this->Videos_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('videos'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('videos'));
        }
    }

	public function _upload_rules() {
		$this->form_validation->set_rules('selected_topic', 'Topic', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}

	public function manual(){
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1){
			redirect(base_url('dashboard'),'refresh');
		}else{
			$data = array(
				'content' => 'videos/manual',
				'content_header' => 'Manual',
				'title' => 'Watch video guides',
			);
	
			$this->load->view('layouts/main', $data);
		}
	}

}
