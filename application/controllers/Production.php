<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Production extends CI_Controller {

	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/index"]);
	}
}