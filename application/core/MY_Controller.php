<?php 

class MY_Controller extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}
}

class App_Controller extends MY_Controller {

	public function __construct() {
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login');
		}

		// delete audios older than 30 days
		$get_days = $this->Settings_model->get_by_id(1);
		if($get_days->delete_audios_in != 0){
			$audios = $this->Audios_model->get_by_days($get_days->delete_audios_in);
			if($audios != null){
				foreach ($audios as $audio ) {
					$topic = $this->Topics_model->get_by_id($audio->topic_id);
					delete_files_from_server(base_url($topic->audio));
				}
			}
		}
		

		// delete scripts older than 30 days
		if($get_days->delete_docs_in != 0){
			$get_days = $this->Settings_model->get_by_id(1);
			$scripts = $this->Scripts_model->get_by_days($get_days->delete_docs_in);
			if($scripts != null){
				foreach ($scripts as $script ) {
					$topic = $this->Topics_model->get_by_id($script->topic_id);
					delete_files_from_server(base_url($topic->doc));
				}
			}
		}
		

		// delete videos older than 30 days
		if($get_days->delete_videos_in != 0){
			$get_days = $this->Settings_model->get_by_id(1);
			$videos = $this->Videos_model->get_by_days($get_days->delete_videos_in);
			if($videos != null){
				foreach ($videos as $video ) {
					$topic = $this->Topics_model->get_by_id($video->topic_id);
					delete_files_from_server(base_url($topic->audio));
				}
			}
		}


		

	}

	public function logged_in(){
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == TRUE) {
			redirect('dashboard', 'refresh');
		}
	}

	public function not_logged_in(){
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == FALSE) {
			redirect('auth/login', 'refresh');
		}
	}


	public function password_hash($pass = ''){
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	/*
    * This functions are invoked from another function to upload files like image, docs, vids and audios the uploads folder
    * and returns the file path
	*/
	
	public function upload_image(){
    	// uploads/users
        $config['upload_path'] = 'uploads/users';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';

        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('photo'))
        {
            $error = $this->upload->display_errors();
			// echo '<script>
			// 		alert('.$error.');
			// 	</script>';

			// echo $error;
			exit($error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['photo']['name']);
            $type = $type[count($type) - 1];
            
			$path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
	}

	public function upload_ducument(){
    	// uploads/users
        $config['upload_path'] = 'uploads/documents';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'docx|doc';
        $config['max_size'] = '1024';

        // $config['max_width']  = '1024';
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('document'))
        {
            $error = $this->upload->display_errors();
			return $error;

        }else{
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['document']['name']);
            $type = $type[count($type) - 1];
            
			$path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
	}

	public function upload_audio(){
    	// uploads/users
        $config['upload_path'] = 'uploads/audios';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'mp3';
        $config['max_size'] = '20000';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('audio'))
        {
            $error = $this->upload->display_errors();
			return $error;

        }else{
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['audio']['name']);
            $type = $type[count($type) - 1];
            
			$path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
	}

	public function upload_video(){
    	// uploads/video
        $config['upload_path'] = 'uploads/videos';
        $config['file_name'] =  uniqid();
        $config['allowed_types'] = 'mp4';
        $config['max_size'] = '3000000';

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('video'))
        {
            $error = $this->upload->display_errors();
			return $error;

        }else{
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['video']['name']);
            $type = $type[count($type) - 1];
            
			$path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
            return ($data == true) ? $path : false;            
        }
	}
	
	public function delete_files_from_server($files){
		// check if file(s) is present
		if($files != '' || $files != null){
			
			// delete file
			if (is_readable($files) && unlink($files)) {
				return true;
			} else {
				return "The file was not found or not readable and could not be deleted";
			}
			
		} 
		
	}

}

?>

