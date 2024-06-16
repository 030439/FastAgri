<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Setup_model');
		$this->load->model('Common_model');
		$this->load->model('Stock_model');
		$this->load->model('Cashbook_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }	
	public function index()
	{
		$data= $this->Cashbook_model->cashbookList();
		$this->load->view('layout/parts',['page'=>"pages/reports/report-1",'data'=>$data]);
	}
	public function profitExpense(){
		$data['expenses']=$this->Stock_model->tunnelsExpensesList();
		$data['profit']=$this->Stock_model->tunnelProfit();
		$this->load->view('layout/parts',['page'=>"pages/reports/expense-profit",'data'=>$data]);
	}
	public function profit(){
		$this->load->view('layout/parts',['page'=>"pages/reports/profit"]);
	}
	public function expense(){
		$this->load->view('layout/parts',['page'=>"pages/reports/expense"]);
	}
	public function profitListing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			
			$res=$this->Stock_model->tunnelProfit($draw,$start , $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function expenseListing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Stock_model->tunnelsExpensesList($draw,$start = 0, $length = 10,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	
	
}