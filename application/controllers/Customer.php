<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/customer/list-customer"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/customer/add-customer"]);
	}
}