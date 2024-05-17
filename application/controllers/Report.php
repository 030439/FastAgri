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
	
	
}