<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/stock/list-stock"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/stock/add-stock"]);
	}
	public function issue()
	{
		$this->load->view('layout/parts',['page'=>"pages/stock/issue-stock"]);
	}
	public function listissue()
	{
		$this->load->view('layout/parts',['page'=>"pages/stock/list-issue-stock"]);
	}
}