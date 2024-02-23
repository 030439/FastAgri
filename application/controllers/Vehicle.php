<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/Vehicle/list-Vehicle"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/Vehicle/add-Vehicle"]);
	}

	public function issuelist()
	{
		$this->load->view('layout/parts',['page'=>"pages/Vehicle/issued-Vehicle-list"]);
	}
}