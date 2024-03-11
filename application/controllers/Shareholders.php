<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shareholders extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('ShareHolder_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$data= $this->ShareHolder_model->getshareholders();

      
   
		$this->load->view('layout/parts',['page'=>"pages/shareholders/list-shareholders",'data'=>$data]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/shareholders/add-shareholders"]);
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
 

    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('capital_amount', 'Capital Amount', 'required');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout/parts',['page'=>"pages/shareholders/add-shareholders"]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->ShareHolder_model->createShareholder($data);
		   $this->response($res,'shareholders',"Data Inserted Successfully");
        }
    }
	public function edit($id) {
            $data = $this->ShareHolder_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
       
    }

    public function update() {
		$id = $this->input->post('id');
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = $this->ShareHolder_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $data = ($data);
            $res=$this->ShareHolder_model->updateShareHolder($id, $data);
			$this->response($res,'shareholders' ,"Data Update Successfully");
        }
    }

    public function delete($id) {
        $this->ShareHolder_model->deleteshareholder($id);
        $this->session->set_flashdata('success_message', 'Record deleted successfully.');
        redirect('shareholder');
    }
}