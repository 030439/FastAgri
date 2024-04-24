<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
		$this->load->model('Setup_model');
		$this->load->model('Tunnel_model');
		$this->load->model('Stock_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
	    $data=$this->Stock_model->sellList();
		$this->load->view('layout/parts',['page'=>"pages/sell/list-sell",'data'=>$data]);
	}
	public function detail($id){
		$data= $this->Stock_model->sellDetail($id);
		$this->load->view('layout/parts',['page'=>"pages/sell/sell-detail",'data'=>$data]);
	}
	public function getPass($id){
		$data= $this->Stock_model->getPassBysellDetailId($id);
		$this->load->view("pages/gatepass/index",['data'=>$data]);
	}
	public function loadForSale(){
		$data = $this->input->post(NULL, TRUE);
		echo $this->Stock_model->loadForSale($data);
		redirect('sell');
	}
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/sell/add-sell"]);
	}
}