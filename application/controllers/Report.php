<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	
	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/reports/report-1"]);
	}
	
	
}