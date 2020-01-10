<?php
 
class Dashboard extends App_Controller{

    // function __construct(){
    //     parent::__construct();
        
    // }

    public function index($topic_id = ""){
		$user = $this->ion_auth->user()->row(); 

		switch ($user->usertype) {
			// super admin
			case 1:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/dashboard',
					'content_header' => 'Dashboard',
					'number_of_topics' => $this->Topics_model->get_num_all(),
					'number_of_staff' => $this->User_model->get_num_all(),
					'number_of_channels' => $this->Channels_model->get_num_all(),
				);
				
				$this->load->view('layouts/main',$data);
				break;

			// Regular admin
			case 7:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/dashboard',
					'content_header' => 'Dashboard',
					'number_of_topics' => $this->Topics_model->get_num_all(),
					'number_of_staff' => $this->User_model->get_num_all(),
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
				);
				
				$this->load->view('layouts/main',$data);
				break;

			// proof reader 
			case 5:
				$data = array(
					'channel' => set_value('channel'),
					// 'topic' => set_value('topic'),
					'stage' => set_value('stage'),
					'assignto' => set_value('assignto'),
					'users' => $this->User_model->get_by_usertype(2),
					'stages' => $this->Stages_model->get_all(),
					'channels' => $this->Channels_model->get_all(),
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/proofreader',
					'topic_id' => $topic_id,
					'content_header' => 'Dashboard',
					'scripts' => $this->Scripts_model->get_all(),
					
				);
				
				$this->load->view('layouts/main',$data);
				break;

			// voice_editor
			case 6:
				$data = array(
					'title' => 'SS Media Staff - Dashboard',
					'content' => 'dashboard/voice_editor',
					'topic_id' => $topic_id,
					'content_header' => 'Dashboard',
					'audios' => $this->Audios_model->get_all(),
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

	public function upload_edited_audio($topic_id, $audio_id){
		$data = array(
			'title' => 'SS Media Staff - Upload',
			'content' => 'dashboard/upload_edited_audio',
			'topic_id' => $topic_id,
			'audio_id' => $audio_id,
			'content_header' => 'Dashboard',
			'scripts' => $this->Scripts_model->get_all(),
		);
		
		$this->load->view('layouts/main',$data);
	}
}
