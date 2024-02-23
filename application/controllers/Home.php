<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('pages/dashboard/index');
		// $this->load->view('pages/authentication/register');
	}
}