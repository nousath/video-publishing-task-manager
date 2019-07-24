<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Channels extends App_Controller
{
    function __construct()
    {
		parent::__construct();
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 ){
			
			redirect(base_url('dashboard'),'refresh');
				
		}
       
    }

    public function index(){
	       
		$data = array(
			'name' => set_value('name'),
			'content' => 'channels/index',
			'content_header' => 'Channels',
			'title' => 'Manage Channels',
			'channels' => $this->Channels_model->get_all(),
		);

		$this->load->view('layouts/main', $data);

    }

    public function create(){
		$this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
			$user = $this->ion_auth->user()->row(); 

            $data = array(
				'name' => $this->input->post('name',TRUE),
				'created_by' => $user->id,
				'created_at' => time(),
			);
			
			$channel_name = $this->input->post('name',TRUE);
			$this->Channels_model->insert($data);
			$this->session->set_flashdata('channel_created', 'Channel '.$channel_name.' created!');
			redirect(site_url('channels'));
        }
	}
	
	public function edit($id = ''){
		if($id == ''){
			redirect(base_url('dashboard'),'refresh');
		}else{
			$this->_rules();

			if ($this->form_validation->run() == FALSE) {
				$this->index();
			} else {
				$data = array(
					'name' => $this->input->post('name',TRUE),
				);
				$this->Channels_model->update($id, $data);
				$this->session->set_flashdata('channel_updated', 'Channel has updated!');
				redirect(site_url('channels'));
			}
		}
	}
      
    public function delete($id) 
    {
        $channel = $this->Channels_model->get_by_id($id);

        if ($channel) {
			$result = $this->User_model->users_by_channel($channel->id);
			if(!empty($result)){
				$this->session->set_flashdata('delete_fail', 'Cannot delete channel '.strtoupper($channel->name).', because there are users/employees under it');
				redirect('channels');
			}else{
				$result = $this->Topics_model->get_by_channel($channel->id);
				if(!empty($result)){
					$this->session->set_flashdata('delete_fail', 'Cannot delete channel '.strtoupper($channel->name).', because there are Topics/Scripts, Audios or Videos under it');
					redirect('channels');
				}else{
					$this->Channels_model->delete($id);
            		$this->session->set_flashdata('delete_successful', 'Channel Deleted!');
            		redirect(site_url('channels'));
				}
			}
            
        } else {
            $this->session->set_flashdata('delete_fail', 'Record Not Found');
            redirect(site_url('channels'));
		}
		
    }

    public function _rules() {
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
