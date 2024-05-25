<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbook extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Cashbook_model');
        $this->load->library('form_validation');
		// if (!is_authorized()) {
		// 	redirect('auth/login');
		// }
    }
	public function add()
	{
		$data= $this->Customer_model->getCustomers();
		$this->load->view('layout/parts',['page'=>"pages/cashbook/add"]);
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
        if ($this->form_validation->run() == FALSE) {
            
            $this->load->view('layout/parts',['page'=>"pages/cashbook/add"]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Cashbook_model->cashbookPay($data);
		   $this->response($res,'cashbook',"Data Inserted Successfully");
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