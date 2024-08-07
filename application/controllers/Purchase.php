<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Purchase_model');
		$this->load->model('Common_model');
		$this->load->model('Stock_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }
	
	public function index()
	{
		try{
			//$res=$this->Purchase_model->getPurchaseDetails();
			$this->load->view('layout/parts',['page'=>"pages/purchase/list-purchase"]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function purchaseListJs(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$res=$this->Purchase_model->getPurchaseList($startDate, $endDate,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function detail($id)
	{
		try{
			//$res=$this->Purchase_model->getPurchaseDetails();
			$this->load->view('layout/parts',['page'=>"pages/purchase/detail",'id'=>$id]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function pdetail($id){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Purchase_model->getPurchaseDetail($id,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function purchasedSeedList()
	{
		try{
			$this->load->view('layout/parts',['page'=>"pages/purchase/list-seed"]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}

	public function purchasedSeedListJS()
	{
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
			$search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$res=$this->Purchase_model->getSeedDetailsJS($startDate,$endDate,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}

	
	public function add()
	{ 
		try{
			$data['suppliers']=$this->Common_model->getAll('suppliers');
			$data['products']=$this->Stock_model->getOnlyProducts();
		    $this->load->view('layout/parts',['page'=>"pages/purchase/add-purchase",'data'=>$data]);
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
			$this->form_validation->set_rules('bno', 'Bill Number ', 'required');
			$this->form_validation->set_rules('pa', 'Bill Number ', 'required');
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
	public function edit($id)
	{ 
		try{
			$data['suppliers']=$this->Common_model->getAll('suppliers');
			$data['products']=$this->Stock_model->getOnlyProducts();
			$data['purchase']=$this->Stock_model->getPurchase($id);
		    $this->load->view('layout/parts',['page'=>"pages/purchase/edit-purchase",'data'=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
	public function purchaseSeedFrom()
	{
		try{
			$data['suppliers']=$this->Common_model->getAll('suppliers');
			$data['products']=$this->Common_model->getAll('crops');
		    $this->load->view('layout/parts',['page'=>"pages/purchase/add-fasal","data"=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
	public function purchaseSeed(){
		try {
			$this->form_validation->set_rules('qty[]', 'Quantity', 'required');
			$this->form_validation->set_rules('quality', 'Quality', 'required');
			$this->form_validation->set_rules('product[]', 'Product ', 'required');
			$this->form_validation->set_rules('rate[]', 'Rate ', 'required');
			$this->form_validation->set_rules('supplier', 'Supplier ', 'required');
			$this->form_validation->set_rules('pdate', 'Date ', 'required');
			$this->form_validation->set_rules('charges', 'Charges ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->purchaseSeedFrom();
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Purchase_model->createPurchase($data);
			   if($res){
				response($res,'purchased/seed-list',"Data Inserted Successfully");
			   }
			   else{
				response($res,'purchased/seed-list',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
	public function seedPurchaseEdit($id){
		try{
		
			$data['suppliers']=$this->Common_model->getAll('suppliers');
			$data['products']=$this->Common_model->getAll('crops');
			$data['purchase']=$this->Purchase_model->getSeedPurchase($id);
			$data['id']=$id;
		    $this->load->view('layout/parts',['page'=>"pages/purchase/edit-fasal","data"=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }	
	}
	public function purchaseSeedUpdate(){
		try {
			$id=$this->input->post('id');
			$this->form_validation->set_rules('qty[]', 'Quantity', 'required');
			$this->form_validation->set_rules('quality', 'Quality', 'required');
			$this->form_validation->set_rules('product[]', 'Product ', 'required');
			$this->form_validation->set_rules('rate[]', 'Rate ', 'required');
			$this->form_validation->set_rules('supplier', 'Supplier ', 'required');
			$this->form_validation->set_rules('pdate', 'Date ', 'required');
			$this->form_validation->set_rules('charges', 'Charges ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->seedPurchaseEdit($id);
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Purchase_model->purchaseSeedUpdate($id,$data);
			   if($res){
				response($res,'purchased/seed-list',"Data Updated Successfully");
			   }
			   else{
				response($res,'purchased/seed-list',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
}