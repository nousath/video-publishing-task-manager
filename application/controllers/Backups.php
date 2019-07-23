<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Backups extends App_Controller
{
    function __construct(){
		parent::__construct();
		
		$user = $this->ion_auth->user()->row(); 

		if($user->usertype != 1 ){
			
			redirect(base_url('dashboard'),'refresh');
				
		}
    }

    public function index(){
		$data = array(
			'name' => set_value('name'),
			'content' => 'backups/index',
			'content_header' => 'Backups',
			'title' => 'Manage Backups',
			'backups' => $this->Backups_model->get_all(),
		);

		$this->load->view('layouts/main', $data);
	}
	
	public function built_backup(){
        $this->load->helper('file');
		$this->load->dbutil();
		$backup = $this->dbutil->backup();
		$date = time();
		if(write_file(FCPATH.'/uploads/backups/BACKUP-'.$date.'.sql.zip', $backup)){
			$data = array(
				'name' => 'BACKUP-'.$date,
				'path' => 'uploads/backups/BACKUP-'.$date.'.sql.zip',
				'created_at' => time(),
			);
			$this->Backups_model->insert($data);
			$this->session->set_flashdata('backup_success', 'Database backup successful!');
			redirect(site_url('backups'));

		}else{
			$this->session->set_flashdata('backup_unsuccessful', 'Backup unsuccessful or File could not be written');
			redirect(site_url('backups'));
		}
	}

	public function download($id = ''){
		if($id == ''){
			redirect(base_url('backups'));
		}else{
			$row = $this->Backups_model->get_by_id($id);
			if($row){
				// download
				$this->load->helper('download');
				force_download(FCPATH.$row->path, NULL);
				redirect(site_url('backups'));
			}else{
				// row not found
				$this->session->set_flashdata('file_absent', 'Backup file not found on server');
				redirect(site_url('backups'));
			}
			
		}
	}

    public function delete($id) {
        $row = $this->Backups_model->get_by_id($id);

        if ($row) {

			$file = FCPATH.$row->path;
			
			if($file != '' || $file != null){
				// delete file
				if (is_readable($file) && unlink($file)) {
					$this->Backups_model->delete($id);
            		$this->session->set_flashdata('delete_success', 'Backup deleted successfully!');
            		redirect(site_url('backups'));
				} else {
					$this->session->set_flashdata('delete_fail', 'Backup file was not found or not readable and could not be deleted');
            		redirect(site_url('backups'));
				}
				
			} 
			
        } else {
            $this->session->set_flashdata('delete_fail', 'Record Not Found');
            redirect(site_url('backups'));
        }
    }


}
