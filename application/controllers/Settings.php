<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends App_Controller
{
    function __construct()
    {
		parent::__construct();
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 && $user->usertype != 7){
			
			redirect(base_url('dashboard'),'refresh');
				
		}
        
    }

    public function index(){        
		$data = array(
			'name' => set_value('name'),
			'content' => 'settings/index',
			'content_header' => 'Settings',
			'title' => 'System Settings',
			'settings' => $this->Settings_model->get_by_id(1),
		);

		$this->load->view('layouts/main', $data);
    }

    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
				'system_name_prefix' => $this->input->post('system_name_prefix',TRUE),
				'system_name' => $this->input->post('system_name',TRUE),
				'header' => $this->input->post('header',TRUE),
				'footer' => $this->input->post('footer',TRUE),
				'tagline' => $this->input->post('tagline',TRUE),
				'delete_docs_in' => $this->input->post('delete_docs_in',TRUE),
				'delete_audios_in' => $this->input->post('delete_audios_in',TRUE),
				'delete_videos_in' => $this->input->post('delete_videos_in',TRUE),
				'backup_in' => $this->input->post('backup_in',TRUE),
				'delete_notifications_in' => $this->input->post('delete_notifications_in',TRUE),
			);

            $this->Settings_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Settings Updated!');
            redirect(site_url('settings'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Settings_model->get_by_id($id);

        if ($row) {
            $this->Settings_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('settings'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('settings'));
        }
    }

    public function _rules() {
		$this->form_validation->set_rules('system_name', 'system name', 'trim|required');
		$this->form_validation->set_rules('header', 'header', 'trim|required');
		$this->form_validation->set_rules('footer', 'footer', 'trim|required');
		$this->form_validation->set_rules('tagline', 'tagline', 'trim|required');


	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

