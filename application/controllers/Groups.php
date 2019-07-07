<?php

 
class Groups extends App_Controller{
    // function __construct()
    // {
    //     parent::__construct();
    // } 

    /*
     * Listing of groups
     */
    function index(){		

		$data = array(
			'title' => 'Groups',
			'groups' => $this->ion_auth->groups()->result(),
			'content' => 'groups/index'
		);
        
        
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new group
     */
    function add(){   
        if(isset($_POST) && count($_POST) > 0) {   
            $params = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
            );
            
            $group_id = $this->Group_model->add_group($params);
            redirect('groups/index');
        }else{       

            $data = array(
				'title' => 'Groups',
				'content' => 'groups/add'
			);
			
			
			$this->load->view('layouts/main',$data);
        }
    }  

    /*
     * Editing a group
     */
    function edit($id)
    {   
        // check if the group exists before trying to edit it
        $data['group'] = $this->Group_model->get_group($id);
        
        if(isset($data['group']['id']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
                );

                $this->Group_model->update_group($id,$params);            
                redirect('groups/index');
            }
            else
            {
                $data = array(
					'content' => 'groups/edit',
					'title'   => 'Edit Group',
					'group'   => $this->Group_model->get_group($id)
				);
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The group you are trying to edit does not exist.');
    } 

    /*
     * Deleting group
     */
    function remove($id)
    {
        $group = $this->Group_model->get_group($id);

        // check if the group exists before trying to delete it
        if(isset($group['id']))
        {
            $this->Group_model->delete_group($id);
            redirect('groups/index');
        }
        else
            show_error('The group you are trying to delete does not exist.');
    }
    
}
