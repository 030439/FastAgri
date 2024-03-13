<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Setup_model');
		$this->load->model('Stock_model');
        $this->load->library('form_validation');
    }
	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/supplier/list-supplier"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/supplier/add-supplier"]);
	}
	public function create() {
		
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('company', 'Unit ', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->add();
        }
		 else {
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Stock_model->insertProduct($data);
		   $this->response($res,'stock/products',"Data Inserted Successfully");
        }
    }
}