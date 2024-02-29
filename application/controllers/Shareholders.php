<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shareholders extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		$data['employees'] = $this->Employee_model->getEmployees();
        // XSS cleaning for output data
        $this->load->library('security');
        $data['employees'] = $this->security->xss_clean($data['employees']);
        $this->load->view('employees/index', $data);
		$this->load->view('layout/parts',['page'=>"pages/shareholders/list-shareholders",'data'=>$data]);
	}
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/shareholders/add-shareholders"]);
	}
	public function save(){
       
    }
 

    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('position', 'Position', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('employees/create');
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $this->load->library('security');
            $data = $this->security->xss_clean($data);
            $this->Employee_model->createEmployee($data);
            $this->session->set_flashdata('success_message', 'Employee created successfully.');
            redirect('employees');
        }
    }

    public function edit($id) {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('position', 'Position', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['employee'] = $this->Employee_model->getEmployeeById($id);
            // XSS cleaning for output data
            $this->load->library('security');
            $data['employee'] = $this->security->xss_clean($data['employee']);
            $this->load->view('employees/edit', $data);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $this->load->library('security');
            $data = $this->security->xss_clean($data);
            $this->Employee_model->updateEmployee($id, $data);
            $this->session->set_flashdata('success_message', 'Employee updated successfully.');
            redirect('employees');
        }
    }

    public function delete($id) {
        $this->Employee_model->deleteEmployee($id);
        $this->session->set_flashdata('success_message', 'Employee deleted successfully.');
        redirect('employees');
    }
}