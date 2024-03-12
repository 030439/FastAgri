<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setup_model');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->load->view('layout/parts', ['page' => "pages/setup/unit"]);
    }
    public function create()
    {
        $this->form_validation->set_rules('Name', 'Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/parts', ['page' => "pages/setup/unit"]);
        } else {
            // XSS cleaning for input data
            $data['Name'] = $this->input->post('Name');
            $res = $this->Setup_model->createUnit($data);
            if ($res) {
                $this->response($res, 'units/list', '"Data Inserted Successfully');
            } else {
                $this->response($res, 'units/list', 'Something went wrong');
            }

        }
    }
    public function response($res, $route, $msg)
    {
        if ($res) {
            $this->session->set_flashdata('success', $msg);
            redirect($route);
        } else {
            $this->session->set_flashdata('error', 'Something went Wrong.');
            redirect($route);
        }
    }
}
