<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{

    public function index()
    {
        $this->load->view('layout/parts', ['page' => "pages/setup/category"]);
    }
    public function create()
    {  
        $res=true;
        response($res,'category/uint','"Data Inserted Successfully');
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('phone', 'phone', 'required');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/parts',['page'=>"pages/shareholders/add-shareholders"]);
            }
             else {
                // XSS cleaning for input data
                $data = $this->input->post(NULL, TRUE);
                $data['id']=6;
                $data = ($data);
               $res= $this->ShareHolder_model->createShareholder($data);
               response($res,'category/uint','"Data Inserted Successfully');
            }
        }
       // $this->load->view('layout/parts', ['page' => "pages/setup/unit"]);
  //  }

}
