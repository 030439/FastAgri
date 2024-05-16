<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->library('form_validation');
		// if (!is_authorized()) {
		// 	redirect('auth/login');
		// }
    }
	public function index()
	{
		$data= $this->Customer_model->getCustomers();
		$this->load->view('layout/parts',['page'=>"pages/customer/list-customer",'data'=>$data]);
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
	public function customerDetail($id){
		try {
			$data=$this->Customer_model->customerDetail($id);
			$this->load->view('layout/parts',['page'=>"pages/customer/detail",'data'=>$data]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}

	}
	
	public function add()
	{ 
		$this->load->view('layout/parts',['page'=>"pages/customer/add-customer"]);
	}
	public function create() {
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('contact', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('company', 'Company ', 'required');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required');
        if ($this->form_validation->run() == FALSE) {
			
			$this->load->view('layout/parts',['page'=>"pages/customer/add-customer"]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Customer_model->createCustomer($data);
		   $this->response($res,'customer',"Data Inserted Successfully");
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