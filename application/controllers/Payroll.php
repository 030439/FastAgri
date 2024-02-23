<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller{

    public function index(){
        $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/list-payroll"]);
    }
    public function add(){
        $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/add-payroll"]);
    }
    
}