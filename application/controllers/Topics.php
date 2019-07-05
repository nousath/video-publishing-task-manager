<?php

class Topics extends App_Controller{

    function __construct(){
        parent::__construct();
        $this->load->model('Topic_model');
    } 

    /*
     * Listing of topics
     */
    function index(){
		$data = array(
			'title'   => 'Manage Topics',
			'content' => 'topic/index'
		);
      
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new topic
     */
    function add(){
		$data = array(
			'topic' => set_value('topic'),
			'content' => 'topic/add',
			'title'   => 'Add new topic'
		);

		$this->load->view('layouts/main',$data);
	} 
	
	function add_action(){
		$this->_rules();

		if($this->form_validation->run()){   
            $params = array(
				'topic' => $this->input->post('topic'),
			);
			
            $topic_id = $this->Topic_model->add_topic($params);
            redirect('topic/index');
        }else{
			
            $data['_view'] = 'topic/add';
            $this->load->view('layouts/main',$data);
        }
	}

    /*
     * Editing a topic
     */
    function edit($id)
    {   
        // check if the topic exists before trying to edit it
        $data['topic'] = $this->Topic_model->get_topic($id);
        
        if(isset($data['topic']['id']))
        {
            $this->load->library('form_validation');

			$this->form_validation->set_rules('topic','Topic','required|max_length[300]');
		
			if($this->form_validation->run())     
            {   
                $params = array(
					'stage_id' => $this->input->post('stage_id'),
					'topic' => $this->input->post('topic'),
					'assigned' => $this->input->post('assigned'),
					'doc' => $this->input->post('doc'),
					'audio' => $this->input->post('audio'),
					'video' => $this->input->post('video'),
					'created_by' => $this->input->post('created_by'),
					'created_at' => $this->input->post('created_at'),
					'script' => $this->input->post('script'),
                );

                $this->Topic_model->update_topic($id,$params);            
                redirect('topic/index');
            }
            else
            {				$data['all_topics'] = $this->Topic_model->get_all_topics();

                $data['_view'] = 'topic/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The topic you are trying to edit does not exist.');
    } 

    /*
     * Deleting topic
     */
    function remove($id){
        $topic = $this->Topic_model->get_topic($id);

        // check if the topic exists before trying to delete it
        if(isset($topic['id']))
        {
            $this->Topic_model->delete_topic($id);
            redirect('topic/index');
        }
        else
            show_error('The topic you are trying to delete does not exist.');
	}
	
	public function _rules() {
		// $this->form_validation->set_rules('contract_number', 'contract number', 'trim|required|is_unique[contract_data.contract_number]');
		// $this->form_validation->set_rules('pid', 'Project', 'trim|required|is_unique[contract_data.pid]',
		// 		array('is_unique' => 'Contract Data for this Project has already been entered!')
		// );
		$this->form_validation->set_rules('topic','Topic','required|max_length[300]');
		$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
	}
    
}
