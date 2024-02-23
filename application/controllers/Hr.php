<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/list-employee"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/add-employee"]);
	}
	public function category()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/category"]);
	}
	public function labourlist()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/issue-labour-list"]);
	}
}