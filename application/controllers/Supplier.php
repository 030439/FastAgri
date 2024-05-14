<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Setup_model');
		$this->load->model('Common_model');
		$this->load->model('Supplier_model');
        $this->load->library('form_validation');
    }
	
	public function index()
	{ 
		try {
			$data=$this->Supplier_model->getAll('suppliers');
			$this->load->view('layout/parts',['page'=>"pages/supplier/list-supplier",'data'=>$data]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	
	public function supplierExport(){
		try {
			/* file name */
			$filename = 'users_' . date('Ymd') . '.csv';
			header("Content-Description: File Transfer");
			header("Content-Disposition: attachment; filename=$filename");
			header("Content-Type: application/csv; ");
		
			/* get data */
			$data = $this->Common_model->getAllInArray('suppliers');
			
			$file = fopen('php://output', 'w');
			$header = array("id","Name", "Company", "Contact No", "CNIC", "Address");
			fputcsv($file, $header);
			foreach ($data as $line) {
				fputcsv($file, $line);
			}
			fclose($file);
			exit;
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
		
		
	}

	public function fetchAll(){
		$data = $this->Common_model->getAll('suppliers');
		$filterValue = $this->input->post('filterValue');

		
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
			
			   $res= $this->Supplier_model->createRecord($data,'suppliers');
			   response($res,'supplier',"Data Inserted Successfully");
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    }

	
}