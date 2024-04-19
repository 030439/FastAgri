<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('labour_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
    }

	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/list-employee"]);
	}
	public function labourRate(){
		try{
		    $this->load->view('layout/parts',['page'=>"pages/human-resource/labour-rate"]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
	public function add()
	{
		
		$this->load->view('layout/parts',['page'=>"pages/human-resource/add-employee"]);
	}
	
	public function issuelabour()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/issue-labour"]);
	}
	public function Advance()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/advance"]);
	}
}