<?php

 
class Users extends App_Controller{
    // function __construct()
    // {
    //     parent::__construct();
    // } 

    /*
     * Listing of users
     */
    function index(){        
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
        $this->load->library('form_validation');

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
									'job_describtion' => $this->input->post('job_describtion'),
									'usertype' => $this->input->post('group'),
                                    );

            $group = array($this->input->post('group')); // Sets user to admin.

            $this->ion_auth->register($username, $password, $email, $additional_data, $group);

            redirect('users/index');
        }
        else
        {            
            $data = array(
				'content' => 'users/add',
				'title' => 'New User',
				'groups' => $this->Group_model->get_all_groups(),
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

		if (!$this->ion_auth->is_admin()){
			// check if the user exists before trying to edit it
			$user_data = $this->User_model->get_user($id);
        
			if(isset($user_data->id)){
				$this->load->library('form_validation');
	
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
					redirect('users/index');
	
					// $this->User_model->update_user($id, $data);            
					// redirect('users/index');
				}
				else{
					$data = array(
						'title' => 'Edit User',
						'content' => 'users/edit',
						'user'  => $this->User_model->get_user($id),
						'content_header' => 'Edit User',
					);
					$this->load->view('layouts/main',$data);
				}
			}
			else
				show_error('The user you are trying to edit does not exist.');

		}else {
			// --------------------------------
			// check if logged in user is admin
			// --------------------------------
		


			// check if the user exists before trying to edit it
			$user_data = $this->User_model->get_user($id);
        
			if(isset($user_data->id)){
				$this->load->library('form_validation');
	
				$this->form_validation->set_rules('password','Password','required|min_length[6]');
				$this->form_validation->set_rules('username','Username','required|min_length[6]');
				$this->form_validation->set_rules('email','Email','required|valid_emails');
			
				if($this->form_validation->run())     
				{   
					$params = array(
						'username' => $this->input->post('username'),
						'email' => $this->input->post('email'),
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'employed_on' => $this->input->post('employed_on'),
						'salary' => $this->input->post('salary'),
						'dob' => $this->input->post('dob'),
						'photo' => $this->upload_image(),
						'phone' => $this->input->post('phone'),
					);
	
					$this->User_model->update_user($id,$params);            
					redirect('users/index');
				}
				else{
					$data = array(
						'title' => 'Edit User',
						'content' => 'users/edit',
						'user'  => $this->User_model->get_user($id)
					);
					$this->load->view('layouts/main',$data);
				}
			}
			else
				show_error('The user you are trying to edit does not exist.');	
		}
    } 

    /*
     * Deleting user
     */
    function remove($id){
        $user = $this->User_model->get_user($id);

        // check if the user exists before trying to delete it
        if(isset($user['id']))
        {
            $this->User_model->delete_user($id);
            redirect('users/index');
        }
        else
            show_error('The user you are trying to delete does not exist.');
    }
    
}
