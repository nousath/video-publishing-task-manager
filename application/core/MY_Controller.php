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

		$group_data = array();
		if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
		}
		else {
			$user_id = $this->session->userdata('id');
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

	// ====================================================================
	// Admin related
	// ====================================================================

	public function admin_logged_in(){
		$session_data = $this->session->userdata();
		if($session_data['admin_logged_in'] == TRUE) {
			redirect(site_url('dashboard'), 'refresh');
		}
	}

	public function admin_not_logged_in(){
		$session_data = $this->session->userdata();
		if($session_data['admin_logged_in'] == FALSE) {
			// redirect('auth/admin_login', 'refresh');
			echo '<script>window.location="'.base_url().'auth/admin_login";</script>';
		}
	}

}

?>
