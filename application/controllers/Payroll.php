<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
		$this->load->model('Common_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
    }

    public function index(){
        $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/list-payroll"]);
    }
    public function generate(){
        try{
			$this->load->library('pagination');

        // Pagination configuration
        $config['base_url'] = base_url('employees');
        $config['total_rows'] = $this->Employee_model->count_records(); // Get total number of records from your model
        $config['per_page'] = 10; // Number of records per page
        $config['uri_segment'] = 3; // URI segment containing the page number

        // Customize pagination styling if needed
        $config['attributes'] = array('class' => 'pagination-link');

        // Initialize pagination
        $this->pagination->initialize($config);

        // Fetch data with pagination
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $data['records']=$this->Employee_model->permanentEmployee($config['per_page'], $offset);
        //  dd($data);
            $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/generate-payroll",'data'=>$data,'listing'=>"employee-list"]);
			//$this->load->view('layout/parts',['page'=>"pages/human-resource/list-employee",'data'=>$data,'listing'=>"employee-list"]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
        
    }
    public function add(){
        $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/add-payroll"]);
    }
    
}