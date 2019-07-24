<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ratings extends App_Controller
{
    // function __construct()
    // {
    //     parent::__construct();
    // }

    public function index()
    {
        $data = array(
			'content_header' => 'Rating',
			'content' => 'ratings/index',
			'title' => 'Rate Staff',
		);

		$this->load->view('layouts/main', $data);
	}
	
	public function fetch(){
		echo $this->Ratings_model->html_output();
	}

	public function insert(){
		if($this->input->post('user_id')){
			$data = array(
				'user_id' => $this->input->post('user_id'),
				'rating'  => $this->input->post('index'),
			);
			$this->Ratings_model->insert_rating($data);
		}
	}

    
    public function delete($id) 
    {
        $row = $this->Ratings_model->get_by_id($id);

        if ($row) {
            $this->Ratings_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ratings'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ratings'));
        }
    }

    public function _rules() {
		$this->form_validation->set_rules('user_id', 'user id', 'trim|required');
		$this->form_validation->set_rules('rater_id', 'rater id', 'trim|required');
		$this->form_validation->set_rules('rating', 'rating', 'trim|required');
		$this->form_validation->set_rules('comment', 'comment', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}
