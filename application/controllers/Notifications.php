<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notifications extends App_Controller
{
    // function __construct()
    // {
    //     parent::__construct();
    // }

    public function index(){
		$user = $this->ion_auth->user()->row();

		// when user lands on notifications page, set unread to 0
		$data = array(
			'read_status' => 1,
		);

		$notifications = $this->Notifications_model->get_by_user($user->id);
		foreach ($notifications as $notification ) {
			$this->Notifications_model->update($notification->id, $data);
		}


        $data = array(
			'title' => 'Notifications',
			'notifications' => $this->Notifications_model->get_by_user($user->id),
			'content_header' => 'Read all notifications',
			'content' => 'notifications/index',
		);

		$this->load->view('layouts/main', $data);

    }

    
    public function delete($id) 
    {
        $row = $this->Notifications_model->get_by_id($id);

        if ($row) {
            $this->Notifications_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('notifications'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('notifications'));
        }
    }

   

}

/* End of file Notifications.php */

