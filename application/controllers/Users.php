<?php

 
class Users extends App_Controller{
    // function __construct()
    // {
	// 	parent::__construct();
		
    // } 

    /*
     * Listing of users
     */
    function index(){ 
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1){
			
			redirect(base_url('dashboard'),'refresh');
				
		}
		
		
        $data = array(
			'title' => 'Staffs',
			'content' => 'users/index',
			'users'  => $this->User_model->get_all_users(),
			'content_header' => 'Users List',
		);
		
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new user
     */
    function add(){  
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1){
			
			redirect(base_url('dashboard'),'refresh');
				
		}

		
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('username','Username','required|min_length[6]');
		$this->form_validation->set_rules('email','Email','required|valid_emails');
		
		if($this->form_validation->run()) {   


            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
			$group = $this->Group_model->get_group($this->input->post('group'));
            $additional_data = array(
                                    'created_on' => time(),
                                    'job_title' => $group->name,
                                    'salary' => $this->input->post('salary'),
                                    'channel_id' => $this->input->post('channel'),
									'job_describtion' => $this->input->post('job_describtion'),
									'usertype' => $this->input->post('group'),
                                    );

            $group = array($this->input->post('group')); // Sets user to admin.

            $this->ion_auth->register($username, $password, $email, $additional_data, $group);
			$this->session->set_flashdata('message', 'New user '.$username.' created!');
            redirect('users');
        }
        else
        {            
            $data = array(
				'content' => 'users/add',
				'title' => 'New User',
				'content_header' => 'Create User',
				'groups' => $this->Group_model->get_all_groups(),
				'channels' => $this->Channels_model->get_all(),
			); 
            $this->load->view('layouts/main',$data);
        }
	}
	  

    /*
     * Editing a user
     */
    function edit($id){   
		// --------------------------------
		// check if logged in user is admin
		// --------------------------------
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 ){
			// check if the user exists before trying to edit it
			$user_data = $this->User_model->get_user($id);
        
			if(isset($user_data->id)){	
				$this->form_validation->set_rules('first_name','First name','trim');
				$this->form_validation->set_rules('last_name','Last name','trim');
				$this->form_validation->set_rules('phone','Phone number','trim');
				$this->form_validation->set_rules('email','Email','trim');
				$this->form_validation->set_rules('employed_on','Employed on','trim');
			
				if($this->form_validation->run())     {  
					

					$data = array(
						'email' => $this->input->post('email'),
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'employed_on' => $this->input->post('employed_on'),
						'dob' => $this->input->post('dob'),
						'phone' => $this->input->post('phone'),
					);

					if($_FILES['photo']['size'] > 0) {

						$upload_image = $this->upload_image();
						$upload_image = array('photo' => $upload_image);
						$this->User_model->update_user($id,$upload_image);
					}
		
	
					$this->User_model->update_user($id,$data);            
					$this->session->set_flashdata('message', 'User updated!');
            		redirect('users');
				}
				else{
					$data = array(
						'title' => 'Edit User',
						'content' => 'users/edit',
						'user'  => $this->User_model->get_user($id),
						'content_header' => 'Edit User',
						'channels' => $this->Channels_model->get_all(),
					);
					$this->load->view('layouts/main',$data);
				}
			}
			else
				show_error('The user you are trying to edit does not exist.');

		}else {
			$user = $this->ion_auth->user($id)->row();
			if ($user) {
				$data = array(
					'id' => set_value('id', $user->id),
					'username' => set_value('username', $user->username),
					'email' => set_value('email', $user->email),
					'first_name' => set_value('first_name', $user->first_name),
					'last_name' => set_value('last_name', $user->last_name),
					'job_title' => set_value('job_title', $user->job_title),
					'employed_on' => set_value('employed_on', $user->employed_on),
					'salary' => set_value('salary', $user->salary),
					'dob' => set_value('dob', $user->dob),
					'phone' => set_value('phone', $user->phone),
					'channels' => $this->Channels_model->get_all(),
					'content' => 'users/edit',
					'content_header' => 'Edit',
					'title' => 'Edit User',
					);
				$this->load->view('layouts/main', $data);
			} else {
				$this->session->set_flashdata('message', 'Record Not Found');
				redirect(site_url('users'));
			}
				
		}
	} 
	
	function edit_action(){
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 ){
			// user
			if (!$this->input->post('id')) {
				$this->edit($this->input->post('id',TRUE));
			} else {
				$data = array(
					'email' => $this->input->post('email'),
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'employed_on' => $this->input->post('employed_on'),
					'dob' => $this->input->post('dob'),
					'phone' => $this->input->post('phone'),
				);

				if($_FILES['photo']['size'] > 0) {

					$upload_image = $this->upload_image();
					$upload_image = array('photo' => $upload_image);
					$this->User_model->update_user($this->input->post('id'),$upload_image);
				}
	
				
				$this->User_model->update_user($this->input->post('id'),$data);            
				$this->session->set_flashdata('message', 'Profile!');
				redirect(base_url('dashboard'));
			}
		}else{
			// admin
			if (!$this->input->post('id')) {
				$this->edit($this->input->post('id',TRUE));
			} else {
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'job_title' => $this->input->post('job_title'),
					'salary' => $this->input->post('salary'),
					'channel_id' => $this->input->post('channel'),
					'job_describtion' => $this->input->post('job_describtion'),
					'employed_on' => $this->input->post('employed_on'),
					'salary' => $this->input->post('salary'),
					'dob' => $this->input->post('dob'),
					'phone' => $this->input->post('phone'),
				);
				$this->User_model->update_user($this->input->post('id'),$data);            
				$this->session->set_flashdata('message', 'User updated!');
				redirect(base_url('users'));
			}
		}
	}

    /*
     * Deleting user
     */
    function remove($id){
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user->id))
        {
			switch ($user->usertype) {
				case 2:
					$result = $this->Topics_model->get_by_writer_assigned($user->id);
					
					if(!empty($result)){
						$this->session->set_flashdata('delete_fail', 'Delete unsuccesful because '.strtoupper($user->username).' has been assigned a topic');
            			redirect('users/index');
					}else{
						// delete assignent to user
						$this->Assignment_model->delete_by_user($user->id);

						// delete messages to and from user
						$this->Messages_model->delete_by_tofrom($user->id);

						// delete notifications to and from user
						$this->Notifications_model->delete_by_to($user->id);

						// delete user
						$this->User_model->delete_user($id);
						$this->session->set_flashdata('delete_success', 'Staff Deleted!');
            			redirect('users/index');
					}
					break;

				case 3:
					$result = $this->Topics_model->get_by_artist_assigned($user->id);
					if(!empty($result)){
						$this->session->set_flashdata('delete_fail', 'Delete unsuccesful because '.strtoupper($user->username).' has been assigned a script');
						redirect('users/index');
					}else{
						// delete assignent to user
						$this->Assignment_model->delete_by_user($user->id);

						// delete messages to and from user
						$this->Messages_model->delete_by_tofrom($user->id);

						// delete notifications to and from user
						$this->Notifications_model->delete_by_to($user->id);
						
						// delete user
						$this->User_model->delete_user($id);
						$this->session->set_flashdata('delete_success', 'Staff Deleted!');
						redirect('users/index');
					}
					break;

				case 4:
						$result = $this->Topics_model->get_by_editor_assigned($user->id);
						if(!empty($result)){
							$this->session->set_flashdata('delete_fail', 'Delete unsuccesful because '.strtoupper($user->username).' has been assigned a voice over');
							redirect('users/index');
						}else{
							// delete assignent to user
							$this->Assignment_model->delete_by_user($user->id);

							// delete messages to and from user
							$this->Messages_model->delete_by_tofrom($user->id);

							// delete notifications to and from user
							$this->Notifications_model->delete_by_to($user->id);
							
							// delete user
							$this->User_model->delete_user($id);
							$this->session->set_flashdata('delete_success', 'Staff Deleted!');
							redirect('users/index');
						}
					break;
				
				default:
					redirect('users/index');
					break;
			}
			
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }
    
}
