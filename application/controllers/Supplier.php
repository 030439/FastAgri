<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Setup_model');
		$this->load->model('Common_model');
        $this->load->library('form_validation');
    }
	
	public function index()
	{
		$data=$this->Common_model->getAll('suppliers');
		$this->load->view('layout/parts',['page'=>"pages/supplier/list-supplier",'data'=>$data]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/supplier/add-supplier"]);
	}
	public function create() {
        try {
			$this->form_validation->set_rules('Name', 'Name', 'required');
			$this->form_validation->set_rules('company_name', 'Company ', 'required');
			$this->form_validation->set_rules('contact', 'Contact ', 'required');
			$this->form_validation->set_rules('Address', 'Address ', 'required');
			$this->form_validation->set_rules('cnic', 'CNIC ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->add();
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			
			   $res= $this->Common_model->createRecord($data,'suppliers');
			   response($res,'supplier/add',"Data Inserted Successfully");
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    }

	
}