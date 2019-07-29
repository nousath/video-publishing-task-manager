<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comments extends App_Controller
{
    function __construct()
    {
		parent::__construct();
		
		
    }

    public function index()
    {
      
    }

    
    public function create_action() 
    {
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype == 1 ){
			$this->_rules();
			if ($this->form_validation->run() == FALSE) {
				redirect(site_url('topics'));
			} else {
				$data = array(
					'comment_from' => $user->id,
					'media_type' => $this->input->post('media_type',TRUE),
					'media_id' => $this->input->post('media_id',TRUE),
					'topic_id' => $this->input->post('topic_id',TRUE),
					'comment' => $this->input->post('comment',TRUE),
					'created_at' => time(),
				);

				$topic_id   = $this->input->post('topic_id',TRUE);
				$media_id   = $this->input->post('media_id',TRUE);
				$media_type = $this->input->post('media_type',TRUE);
	
				$this->Comments_model->insert($data);
				switch ($media_type) {
					case 1:
						redirect(site_url("topics/doc/$topic_id/$media_id"));
						break;

					case 2:
						redirect(site_url("topics/audio/$topic_id/$media_id"));
						break;

					case 3:
						redirect(site_url("topics/video/$topic_id/$media_id"));
						break;
					
					default:
						redirect(site_url("topics"));
						break;
				}
			}
				
		}else {
			$this->_rules();

			if ($this->form_validation->run() == FALSE) {
				redirect(site_url('topics/doc'));
			} else {
				$data = array(
					'comment_from' => $user->id,
					'media_type' => $this->input->post('media_type',TRUE),
					'media_id' => $this->input->post('media_id',TRUE),
					'topic_id' => $this->input->post('topic_id',TRUE),
					'comment' => $this->input->post('comment',TRUE),
					'created_at' => time(),
				);

				$media_id = $this->input->post('media_id',TRUE);
				$media_type = $this->input->post('media_type',TRUE);
				$this->Comments_model->insert($data);
				switch ($media_type) {
					case 1:
						redirect(site_url("scripts/index/$media_id"));
						break;

					case 2:
						redirect(site_url("audios/index/$media_id"));
						break;

					case 3:
						redirect(site_url("videos/index/$media_id"));
						break;
					
					default:
						redirect(site_url("dashboard"));
						break;
				}

			}
		}

       
    }
    
    public function update($id) 
    {
        $row = $this->Comments_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('comments/update_action'),
				'id' => set_value('id', $row->id),
				'comment_from' => set_value('comment_from', $row->comment_from),
				'media_type' => set_value('media_type', $row->media_type),
				'media_id' => set_value('media_id', $row->media_id),
				'topic_id' => set_value('topic_id', $row->topic_id),
				'comment' => set_value('comment', $row->comment),
				'created_at' => set_value('created_at', $row->created_at),
				);
            $this->load->view('comments/comments_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('comments'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
			'comment_from' => $this->input->post('comment_from',TRUE),
			'media_type' => $this->input->post('media_type',TRUE),
			'media_id' => $this->input->post('media_id',TRUE),
			'topic_id' => $this->input->post('topic_id',TRUE),
			'comment' => $this->input->post('comment',TRUE),
			'created_at' => $this->input->post('created_at',TRUE),
			);

            $this->Comments_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('comments'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Comments_model->get_by_id($id);

        if ($row) {
            $this->Comments_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('comments'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('comments'));
        }
    }

    public function _rules() 
    {
		$this->form_validation->set_rules('comment', 'comment', 'trim|required');

		$this->form_validation->set_rules('id', 'id', 'trim');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

