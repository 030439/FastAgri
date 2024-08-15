<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Setup_model');
		$this->load->model('Common_model');
		$this->load->model('Supplier_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
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

	public function listing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Supplier_model->suppliersList($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function supplierLedger($id){
		$this->load->view('layout/parts',['page'=>"pages/supplier/ledger",'id'=>$id]);
	}
	public function supplierLedgerList($id){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$res=$this->Supplier_model->get_supplier_ledger($id,$startDate, $endDate,$draw,$start, $length ,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function getSuppliers(){
		$data= $this->Supplier_model->getSuppliers();
		$html="";
		$html.='<option value="default" selected disabled>Select an option</option>';
		foreach($data as $d){
			$html.="<option value='$d->id'>";
			$html.=$d->Name.' - '.$d->closing;
			$html.="</option>";
		}
		echo $html;
	}

	public function detail($id){
		try {
			$data=$this->Supplier_model->detail($id);
			$this->load->view('layout/parts',['page'=>"pages/supplier/detail",'data'=>$data,'id'=>$id]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}

	public function detailListing($id){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$res=$this->Supplier_model->detailListing($id,$startDate, $endDate,$draw,$start, $length,$search);
			echo jsonOutPut($res);
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
	public function supplierEdit($id){
		try {
			$data=$this->Supplier_model->getSupplierrById($id);
			$this->load->view('layout/parts',['page'=>"pages/supplier/edit",'data'=>$data]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function updateSupplier() {
        try {
			$id=$this->input->post('id');
			$this->form_validation->set_rules('Name', 'Name', 'required');
			$this->form_validation->set_rules('company_name', 'Company ', 'required');
			$this->form_validation->set_rules('contact', 'Contact ', 'required');
			$this->form_validation->set_rules('Address', 'Address ', 'required');
			$this->form_validation->set_rules('cnic', 'CNIC ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->supplierEdit($id);
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			
			   $res= $this->Supplier_model->updateSupplier($id,$data);
			   response($res,'supplier',"Data Updated Successfully");
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    }
	
}