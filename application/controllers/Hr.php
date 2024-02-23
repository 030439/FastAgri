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
	
	public function issuelabour()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/issue-labour"]);
	}
	public function Advance()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/advance"]);
	}
}