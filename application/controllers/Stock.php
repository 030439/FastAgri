<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Setup_model');
		$this->load->model('Stock_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$data=$this->Stock_model->getStock();
		$this->load->view('layout/parts',['page'=>"pages/stock/list-stock",'data'=>$data]);
	}
	
	public function add()
	{
		$data=$this->Setup_model->getunit();
		$this->load->view('layout/parts',['page'=>"pages/stock/add-stock",'data'=>$data]);
	}
	public function productList(){
		$data=$this->Stock_model->getProducts();
	
		$this->load->view('layout/parts',['page'=>"pages/stock/products",'data'=>$data]);
	}
	public function addProduct()
	{
		$data=$this->Setup_model->getunit();
		$this->load->view('layout/parts',['page'=>"pages/stock/add-product",'data'=>$data]);
	}
    public function insertProduct() {
		
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit ', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->addProduct();
        }
		 else {
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Stock_model->insertProduct($data);
		   $this->response($res,'stock/products',"Data Inserted Successfully");
        }
    }
    public function seedAdd()
	{
		try{
			$data=$this->Setup_model->getunit();
		$this->load->view('layout/parts',['page'=>"pages/stock/add-seed",'data'=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
    public function insertSeed() {
		
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit ', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->seedAdd();
        }
		 else {
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Stock_model->insertSeed($data);
		   $this->response($res,'stock/seeds',"Data Inserted Successfully");
        }
    }
	public function insertStock() {
		
        $this->form_validation->set_rules('Name', 'Name', 'required');
		$this->form_validation->set_rules('company', 'Company', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit ', 'required');
        $this->form_validation->set_rules('qunatity', 'quantity', 'required');
        $this->form_validation->set_rules('rate', 'Rate', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->add();
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Setup_model->createShareholder($data);
		   $this->response($res,'shareholders',"Data Inserted Successfully");
        }
    }
	public function issue()
	{
		$this->load->view('layout/parts',['page'=>"pages/stock/issue-stock"]);
	}
	public function listissue()
	{
		$this->load->view('layout/parts',['page'=>"pages/stock/list-issue-stock"]);
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
		
           $res= $this->Setup_model->createShareholder($data);
		   $this->response($res,'shareholders',"Data Inserted Successfully");
        }
    }
	public function edit($id) {
            $data = $this->Setup_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
       
    }

    public function update() {
		$id = $this->input->post('id');
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = $this->Setup_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $data = ($data);
            $res=$this->Setup_model->updateShareHolder($id, $data);
			$this->response($res,'shareholders' ,"Data Update Successfully");
        }
    }

    public function delete($id) {
        $this->Setup_model->deleteshareholder($id);
        $this->session->set_flashdata('success_message', 'Record deleted successfully.');
        redirect('shareholder');
    }

} 