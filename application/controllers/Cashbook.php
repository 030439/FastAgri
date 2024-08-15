<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbook extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Cashbook_model');
		$this->load->model('Employee_model');
		$this->load->model('Jamandar_model');
		$this->load->model('Supplier_model');
		$this->load->model('Common_model');
		$this->load->model('ShareHolder_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/cashbook/add"]);
	}
	public function editCash($id)
	{
		$data['record']= $this->Cashbook_model->getCashRecord($id);
		//dd($data['record']);
		foreach($data['record'] as $d){
			if($d['cash_s']=="cash-in"){
                if($d['case_sT']=="customer"){
					$page="customer";
					$data['cutomers']= $this->Customer_model->customerDetailInfo();
                }
                elseif ($d['case_sT']=="shareholder") {
					$page="shareholder";
					$data['shareholders']= $this->ShareHolder_model->getshareholders();
                }
            }elseif($d['cash_s']=="cash-out"){
                if($d['case_sT']=="supplier"){
					$page="supplier";
					$data['suplliers']=$this->Supplier_model->getSuppliers();
                }
                elseif ($d['case_sT']=="shareholder") {
					$page="shareholder-out";
					$data['shareholders']= $this->ShareHolder_model->getshareholders();
                }
                elseif ($d['case_sT']=="pay") {
					$page="employee-pay";
					$data['tunnels']=$this->Common_model->getAll('tunnels');
					$data['employees']= $this->Employee_model->getEmployees();
                }
				elseif ($d['case_sT']=="advance") {
					$page="employee-advance";
					$data['tunnels']=$this->Common_model->getAll('tunnels');
					$data['employees']= $this->Employee_model->getEmployees();
                }
                elseif ($d['case_sT']=="jamandari") {
					$page="jamandar-pay";
					$data['jamandars']=$this->Jamandar_model->getAll();
                }
                elseif ($d['case_sT']=="jamandariAdvance") {
					$page="jamandar-advance";
					$data['jamandars']=$this->Jamandar_model->getAll();
                }
                elseif ($d['case_sT']=="expense") {
					$page="expense";
					$data['heads']=$this->Cashbook_model->getAccountHead();
					$data['tunnels']=$this->Common_model->getAll('tunnels');
                }
            }
		}
		$this->load->view('layout/parts',['page'=>"pages/cashbook/".$page,'data'=>$data]);
	}
	public function updateCashbookPay() {
        $data = $this->input->post(NULL, TRUE);
		$id=$data['id'];
        $this->form_validation->set_rules('cash-selection-party', 'Cash Selection Party', 'required');
        $this->form_validation->set_rules('amount', 'Amount ', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->editCash($id);
        }
		 else {
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Cashbook_model->updateCashbookPay($id,$data);
		$this->response($res,'report',"Data Updated Successfully");
		
        }
    }
	public function cashFlow(){
			try{
				$draw = intval($this->input->post("draw"));
				$start = intval($this->input->post("start"));
				$length = intval($this->input->post("length"));
				$search = $this->input->post('search')['value'];
				$startDate = $this->input->post('startDate');
				$endDate = $this->input->post('endDate');
				$res=$this->Cashbook_model->cashbookList_($startDate, $endDate,$draw,$start , $length ,$search);
				echo jsonOutPut($res);
			} catch (Exception $e) {
				log_message('error', $e->getMessage());
				show_error('An unexpected error occurred. Please try again later.');
			}

	}
	public function invoice($id){
		$res=$this->Cashbook_model->invoice($id);
		if($res[0]['cash_s']=="cash-out"){
			$this->load->view("pages/cashbook/credit",['data'=>$res]);
		}else{
			$this->load->view("pages/cashbook/debit",['data'=>$res]);
		}
	}
	public function customerDetail($id){
		try {
			$data=$this->Customer_model->customerDetail($id);
			$this->load->view('layout/parts',['page'=>"pages/customer/detail",'data'=>$data]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}

	}
	public function cashbookPay() {
        $data = $this->input->post(NULL, TRUE);
        $this->form_validation->set_rules('cash-selection', 'Cash Selection', 'required');
        $this->form_validation->set_rules('cash-selection-type', 'Cash Selection Type', 'required');
        $this->form_validation->set_rules('cash-selection-party', 'Cash Selection Party', 'required');
        $this->form_validation->set_rules('amount', 'Amount ', 'required');
		$this->form_validation->set_rules('cdate', 'cdate ', 'required');
        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('layout/parts',['page'=>"pages/cashbook/add"]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Cashbook_model->cashbookPay($data);
		//    if ($res) {
        //     $printUrl = base_url('cashbook/print/' . $res); // assuming you have a print method to handle printing

        //     // Load a view with JavaScript to open the print page and then redirect
        //     echo "<script type='text/javascript'>
        //             window.open('{$printUrl}', '_blank');
                   
        //           </script>";
        //     return;
        // }
		$this->response($res,'report',"Data Inserted Successfully");
		
        }
    }
	public function printSlip($id){
		try {
			$data=$this->Customer_model->cashbookById($id);
			$this->load->view('layout/parts',['page'=>"pages/cashbook/print",'data'=>$data]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function response($res,$route,$msg){
		if($res){
			$this->session->set_flashdata('success', $msg);
            redirect($route);
		   }
		   else{
			$this->session->set_flashdata('error', 'Something went Wrong.');
            redirect($route);
		   }
	}
}