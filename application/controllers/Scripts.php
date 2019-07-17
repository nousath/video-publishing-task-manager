<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scripts extends App_Controller
{
    function __construct(){
		parent::__construct();
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 && $user->usertype != 2){
			
			redirect(base_url('dashboard'),'refresh');
				
		}
    }

    public function index(){

		$user = $this->ion_auth->user()->row(); 

		if($user->usertype == 1){
			// admin view
			$data = array(
				'scripts' => $this->Scripts_model->get_all(),
				'content' => 'scripts/admin_scripts_view',
				'content_header' => 'Manage Scripts',
				'title' => 'Manage Scripts',
			);
	
			$this->load->view('layouts/main', $data);


		}elseif($user->usertype == 2){
			// writer view
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

   public function toggle_approve($script_id = ''){

		$user = $this->ion_auth->user()->row(); 

		if($user->usertype == 1){
			redirect(base_url('dashboard'),'refresh');
		}


	   if($script_id == ''){
		   
		   redirect(base_url('scripts'),'refresh');
		   
	   }else{
			// update aproval status for script
			$script = $this->Scripts_model->get_by_id($script_id);

			$approved = ($script->approved == 0) ? 1 : 0;
			
			$data = array(
				'approved' => $approved,
			);

			if($this->Scripts_model->update($script_id, $data)){
				// send notification to user
				$notification_template = $this->Notifications_templates_model->get_by_type('admin_response_script');
				
				$data = array(
					'send_to' => $script->submitted_by,
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

				
				if($approved == 1){
					// assign topic to voice over artist
					$voice_artists_off_projects = $this->User_model->get_by_usertype_and_project_status(3, 0);
					if($voice_artists_off_projects == null){
						// all voice artist have ongoing projects
						$all_voice_artists = $this->User_model->get_by_usertype(3);
						foreach ($all_voice_artists as $voice_artist ) {
							$data = array(
								'topic_id' => $script->topic_id,
								'user_id' => $voice_artist->id,
								'stage_id' => 3, // writing stage
							);
							$this->Assignment_model->insert($data);
	
							// indicate user as currently on project
							$data = array(
								'on_project' => 1,
							);
							$this->User_model->update_user($voice_artist->id, $data);

							// set user in charge of topic
							$data = array(
								'user2_id' => $voice_artist->id,
							);
							$this->Topics_model->update($script->topic_id, $data);
	
							// get notification template to send
							$notification_template = $this->Notifications_templates_model->get_by_type('new_script');
							
							$data = array(
								'send_to' => $voice_artist->id,
								'body'    => $notification_template->message,
								'created_at' => time(),
							);
							$this->Notifications_model->insert($data);
	
							break;
						}
	
					}else{
						// at least one voice artist is without task
						foreach ($voice_artists_off_projects as $voice_artist ) {
	
							$data = array(
								'topic_id' => $script->topic_id,
								'user_id' => $voice_artist->id,
								'stage_id' => 3, // writing stage
							);
							$this->Assignment_model->insert($data);
	
							// indicate user as currently on project
							$data = array(
								'on_project' => 1,
							);
							$this->User_model->update_user($voice_artist->id, $data);

							// set user in charge of topic
							$data = array(
								'user2_id' => $voice_artist->id,
							);
							$this->Topics_model->update($script->topic_id, $data);
	
							// get notification template to send
							$notification_template = $this->Notifications_templates_model->get_by_type('new_script');
							
							$data = array(
								'send_to' => $voice_artist->id,
								'body'    => $notification_template->message,
								'created_at' => time(),
							);
							$this->Notifications_model->insert($data);
	
							break;
							
						}
					}
				}


				// redirect admin back to scriipts page with an alert
				$this->session->set_flashdata('toggle_success', 'Approval status updated!');
				redirect(site_url('scripts'));
			}
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
	

}
