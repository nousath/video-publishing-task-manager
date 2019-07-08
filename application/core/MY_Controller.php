<?php 

class MY_Controller extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
	}
}

class App_Controller extends MY_Controller {
	// var $permission = array();

	public function __construct() {
		parent::__construct();
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login');
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


	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	/*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
	public function upload_image()
    {
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
			return $error;
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

}

?>
