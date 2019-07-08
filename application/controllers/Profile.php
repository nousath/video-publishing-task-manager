<?php 
	
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Profile extends App_Controller {
	
		public function index($id = ''){
			if ($id == '') {
				
				redirect(base_url('dashboard'),'refresh');
				
			}else{

				$data = array(
					'title' => 'My Profile',
					'user' => $this->User_model->get_user($id),
					'content' => 'users/profile',
					'content_header' => 'User Profile',
					'content_subheader' => ''
				);

				$this->load->view('layouts/main', $data);
			}
		}
	
	}
	
	/* End of file Profile.php */
	

?>
