<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/supplier/list-supplier"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/supplier/add-supplier"]);
	}
}