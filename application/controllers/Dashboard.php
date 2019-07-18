<?php
 
class Dashboard extends App_Controller{

    // function __construct(){
    //     parent::__construct();
        
    // }

    function index(){
		$user = $this->ion_auth->user()->row(); 

		switch ($user->usertype) {
			case 1:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/dashboard',
					'content_header' => 'Dashboard',
					'number_of_topics' => $this->Topics_model->get_num_all(),
					'number_of_staff' => $this->User_model->get_num_all(),
					'number_of_messages' => $this->Messages_model->number_of_messages_to_user($user->id),
					'number_of_channels' => $this->Channels_model->get_num_all(),
				);
				
				$this->load->view('layouts/main',$data);
				break;

			// Writer
			case 2:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/writer',
					'content_header' => 'Dashboard',
					'scripts_by_user' => $this->Topics_model->get_by_writer_assigned($user->id),
					'messages' => $this->Messages_model->get_by_user($user->id),
				);
				
				$this->load->view('layouts/main',$data);
				break;

			case 3:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/voiceartist',
					'content_header' => 'Dashboard',
					'audios_by_user' => $this->Topics_model->get_by_artist_assigned($user->id),
					'messages' => $this->Messages_model->get_by_user($user->id),
				);
				
				$this->load->view('layouts/main',$data);
				break;


			case 4:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/videoeditor',
					'content_header' => 'Dashboard',
					'videos_by_user' => $this->Topics_model->get_by_editor_assigned($user->id),
					'messages' => $this->Messages_model->get_by_user($user->id),
				);
				
				$this->load->view('layouts/main',$data);
				break;
			
			default:
				
				redirect('auth/login','refresh');
				
				break;
		}

		
    }
}
