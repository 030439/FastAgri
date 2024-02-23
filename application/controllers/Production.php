<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/fasal"]);
	}
	
	public function proready()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/production-ready"]);
	}
	public function prodetail()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/detail-production"]);
	}
}