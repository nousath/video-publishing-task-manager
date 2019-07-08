<?php
 
class Dashboard extends App_Controller{
    function __construct()
    {
        parent::__construct();
        
    }

    function index(){

		$data = array(
			'title' => 'SS Media Staff - Dashboard',
			'content' => 'dashboard/dashboard.php',
			'content_header' => 'Dashboard',
		);
		
        $this->load->view('layouts/main',$data);
    }
}
