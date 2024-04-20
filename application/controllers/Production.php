<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$data['units'] = $this->Setup_model->getunit();
		$this->load->view('layout/parts',['page'=>"pages/production/fasal",'data'=>$data]);
	}
	
	public function proready()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/production-ready"]);
	}
	public function ready(){
		
	}
	public function prodetail()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/detail-production"]);
	}
}