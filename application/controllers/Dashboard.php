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
					'content' => 'dashboard/dashboard.php',
					'content_header' => 'Dashboard',
				);
				
				$this->load->view('layouts/main',$data);
				break;
			
			default:
				# code...
				break;
		}

		
    }
}
