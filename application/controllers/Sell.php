<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/sell/list-sell"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/sell/add-sell"]);
	}
}