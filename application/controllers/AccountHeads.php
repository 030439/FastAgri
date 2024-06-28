<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountHeads extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Cashbook_model');
        $this->load->model('ShareHolder_model');
        $this->load->library('form_validation');
		// if (!is_authorized()) {
		// 	redirect('auth/login');
		// }
    }

    public function index()
    {
        $data= $this->Cashbook_model->getAccountHead();
        $this->load->view('layout/parts', ['page' => "pages/accounts/acoount-heads",'data'=>$data]);
    }
    public function OtherExpense(){
        $data= $this->Cashbook_model->getAccountHead();
		$html="";
		$html.='<option value="default" selected disabled>Select an option</option>';
		foreach($data as $d){
			$html.="<option value='$d->id'>";
			$html.=$d->name;
			$html.="</option>";
		}
		echo $html;
    }
    public function addAccountHead(){
        $this->form_validation->set_rules('name', 'Name ', 'required');
        if ($this->form_validation->run() == FALSE) {
            
            $data= $this->Cashbook_model->getAccountHead();
            $this->load->view('layout/parts', ['page' => "pages/accounts/acoount-heads",'data'=>$data]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Cashbook_model->addAccountHead($data);
		   $this->response($res,'AccountHeads',"Data Inserted Successfully");
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

    public function addAsset(){
        $data['shareholders']= $this->ShareHolder_model->getshareholders();
        $this->load->view('layout/parts',['page'=>"pages/asset/add",'data'=>$data]);
    }

}
