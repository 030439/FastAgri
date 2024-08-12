<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DirectParty extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Direct_model');
        $this->load->library('form_validation');
        $this->load->model('Stock_model');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/direct/list-party"]);
	}
	public function listing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Direct_model->directList($draw,$start, $length ,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function customerLedger($id){
        $this->load->view('layout/parts',['page'=>"pages/direct/ledger",'id'=>$id]);
	}
	public function customerLedgerList($id){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$res=$this->Direct_model->get_customer_ledger($id,$startDate, $endDate,$draw,$start, $length ,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function getcustomers(){
		$data= $this->Customer_model->customerDetailInfo();
		$html="";
		$html.='<option value="default" selected disabled>Select an option</option>';
		foreach($data as $d){
			$html.="<option value='$d->id'>";
			$html.=$d->Name.' - '.$d->opening;
			$html.="</option>";
		}
		echo $html;
	}
    public function getDirects(){
        $data= $this->Direct_model->getDirects();
        $html="";
		$html.='<option value="default" selected disabled>Select an option</option>';
		foreach($data as $d){
			$html.="<option value='$d->id'>";
			$html.=$d->Name . "  - ";
            $html.= getPartyTotal($d->id);
			$html.="</option>";
		}
		echo $html;
    }
    
	public function directIssueStockJs($id){
		//$id=$this->input->post('id');
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
            $res=$this->Stock_model->directissueList($startDate, $endDate,$draw,$start, $length,$search);
			//$res=$this->Stock_model->directissueListId($id,$startDate, $endDate,$draw,$start, $length ,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function customerDetail($id){
		try {
			$data=$this->Customer_model->customerDetail($id);
			$this->load->view('layout/parts',['page'=>"pages/direct/detail",'data'=>$data,'id'=>$id]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}

	}
	// public function customerDetailList($id){
	// 	try{
	// 		$draw = intval($this->input->post("draw"));
	// 		$start = intval($this->input->post("start"));
	// 		$length = intval($this->input->post("length"));
    //         $search = $this->input->post('search')['value'];
	// 		$res=$this->Customer_model->customerDetailList($draw,$start = 0, $length = 10,$search,$id);
	// 		echo jsonOutPut($res);
	// 	} catch (Exception $e) {
	// 		log_message('error', $e->getMessage());
	// 		show_error('An unexpected error occurred. Please try again later.');
	// 	}
	// }
	
	public function add()
	{ 
		$this->load->view('layout/parts',['page'=>"pages/direct/add-party"]);
	}
	public function create() {
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('contact', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required');
        if ($this->form_validation->run() == FALSE) {
			
			$this->load->view('layout/parts',['page'=>"pages/direct/add-party"]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Direct_model->createDirect($data);
		   $this->response($res,'direct-parties',"Data Inserted Successfully");
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
	public function directEdit($id){
		try {
			$data=$this->Direct_model->getcustomerById($id);
			$this->load->view('layout/parts',['page'=>"pages/direct/edit",'data'=>$data]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function updateDirect() {
		$id=$this->input->post('id');
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('contact', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required');
        if ($this->form_validation->run() == FALSE) {
			
			$this->directEdit($id);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Direct_model->updatecustomer($id,$data);
		   $this->response($res,'direct-parties',"Data Updated Successfully");
        }
    }
}