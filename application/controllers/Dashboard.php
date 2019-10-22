<?php
 
class Dashboard extends App_Controller{

    // function __construct(){
    //     parent::__construct();
        
    // }

    public function index($topic_id = ""){
		$user = $this->ion_auth->user()->row(); 

		switch ($user->usertype) {
			// admin
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

			// voice artist
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

			// video editor
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

			// proof reader
			case 5:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/proofreader',
					'topic_id' => $topic_id,
					'content_header' => 'Dashboard',
					'scripts' => $this->Scripts_model->get_all(),
				);
				
				$this->load->view('layouts/main',$data);
				break;
			
			default:
				
				redirect('auth/login','refresh');
				
				break;
		}

		
	}
	
	public function upload_proofread_doc($topic_id, $doc_id){
		$data = array(
			'title' => 'SS Media Staff - Upload',
			'content' => 'dashboard/upload_proofread_doc',
			'topic_id' => $topic_id,
			'doc_id' => $doc_id,
			'content_header' => 'Dashboard',
			'scripts' => $this->Scripts_model->get_all(),
		);
		
		$this->load->view('layouts/main',$data);
	}
}
