<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reserves extends App_Controller
{
    function __construct()
    {
		parent::__construct();
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1){
			
			redirect(base_url('dashboard'),'refresh');
				
		}

    }

    public function index($topic_id = ''){
		if($topic_id == ''){
			// load all reserved topics
			$data = array(
				'topics'  => $this->Topics_model->get_all(1, true),
				'content' => 'reserves/index',
				'content_header' => 'Reserved Topics',
				'title' => 'Reserved Topics',
			);
		
			$this->load->view('layouts/main', $data);

		}else{
			// load single reserved topic.
		}
	} 
	
	public function do_reserve($media_id = '', $media_type = ''){
		if($media_id == ''){
			redirect(base_url('dashboard'),'refresh');
		}else{
			switch ($media_type) {
				case 1:
					$data = array(
						'is_reserved' => 1
					);
					$this->Scripts_model->update($media_id, $data);
					$this->session->set_flashdata('reserve_message', 'Script reserved');
					redirect(base_url('scripts'),'refresh');
					break;

				case 2:
					$data = array(
						'is_reserved' => 1
					);
					$this->Audios_model->update($media_id, $data);
					$this->session->set_flashdata('reserve_message', 'Audio reserved');
					redirect(base_url('audios'),'refresh');
					break;

					case 3:
					$data = array(
						'is_reserved' => 1
					);
					$this->Videos_model->update($media_id, $data);
					$this->session->set_flashdata('reserve_message', 'Video reserved');
					redirect(base_url('videos'),'refresh');
					break;
				
				default:
					redirect(base_url('dashboard'),'refresh');
					break;
			}
		}
	}

	public function scripts(){
		$data = array(
			'scripts' => $this->Scripts_model->get_by_reserved(1),
			'content' => 'scripts/reserved',
			'content_header' => 'Reserved Scripts',
			'title' => 'Reserved scripts',
		);

		$this->load->view('layouts/main', $data);
	}

	public function audios(){
		$data = array(
			'audios' => $this->Audios_model->get_by_reserved(1),
			'content' => 'audios/reserved',
			'content_header' => 'Reserved Audios',
			'title' => 'Manage Reserved Audios',
		);

		$this->load->view('layouts/main', $data);
	}

	public function videos(){
		$data = array(
			'videos' => $this->Videos_model->get_by_reserved(1),
			'content' => 'videos/reserved',
			'content_header' => 'Reserved Videos',
			'title' => 'Manage Reserved Videos',
		);

		$this->load->view('layouts/main', $data);
	}
	
	public function delete($id) {
        $row = $this->Topics_model->get_by_id($id);

        if ($row) {
            $this->Topics_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('reserves'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('reserves'));
        }
	}
	

}
