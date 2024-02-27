<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Purchase extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/purchase/list-purchase"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/purchase/add-purchase"]);
	}
	public function save(){
       
    }
}