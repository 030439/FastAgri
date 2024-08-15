<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
		$this->load->model('Common_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
        if (!is_authorized()) {
			redirect('auth/login');
		}
    }
    public function index()
    {
        $data=$this->Employee_model->getCategory();
        $this->load->view('layout/parts', ['page' => "pages/setup/category",'data'=>$data]);
    }
    public function unit()
    {
        $this->load->view('layout/parts', ['page' => "pages/setup/unit"]);
    }

}
