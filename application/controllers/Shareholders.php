<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shareholders extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/shareholders/list-shareholders"]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/shareholders/add-shareholders"]);
	}
	public function save(){
       
    }
}