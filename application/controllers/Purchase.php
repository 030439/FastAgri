<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_model');
		$this->load->model('Common_model');
        $this->load->library('form_validation');
    }
	
	public function index()
	{
		try{
			$res=$this->Purchase_model->getPurchaseDetails();
			$this->load->view('layout/parts',['page'=>"pages/purchase/list-purchase","data"=>$res]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	
	public function add()
	{
		try{
			$data['suppliers']=$this->Common_model->getAll('suppliers');
			$data['products']=$this->Common_model->getAll('products');
		    $this->load->view('layout/parts',['page'=>"pages/purchase/add-purchase","data"=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
	public function save(){
		try {
			$this->form_validation->set_rules('qty[]', 'Quantity', 'required');
			$this->form_validation->set_rules('product[]', 'Product ', 'required');
			$this->form_validation->set_rules('rate[]', 'Rate ', 'required');
			$this->form_validation->set_rules('supplier', 'Supplier ', 'required');
			$this->form_validation->set_rules('pdate', 'Date ', 'required');
			$this->form_validation->set_rules('charges', 'Charges ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->add();
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Purchase_model->createPurchase($data);
			   if($res){
				response($res,'purchase',"Data Inserted Successfully");
			   }
			   else{
				response($res,'purchase',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
}