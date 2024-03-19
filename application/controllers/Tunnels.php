<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tunnels extends CI_Controller{
   
	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Tunnel_model');
		$this->load->model('ShareHolder_model');
        $this->load->library('form_validation');
    }
    public function index(){
        $this->load->view('layout/parts',['page'=>"pages/tunnels/list-tunnel"]);
    }
    public function add(){
        $data['products']=$this->Common_model->getAll('crops');
        $data['shareholders']= $this->ShareHolder_model->getshareholders();
        $this->load->view('layout/parts',['page'=>"pages/tunnels/add-tunnel",'data'=>$data]);
    }
    public function save(){
        $data = $this->input->post(NULL, TRUE);
	    $res= $this->Tunnel_model->createTunnel($data);
        if($res){
            print_r($res);
        }
        else{
            print_r('asd');
        }
        die;

        try{
			$this->form_validation->set_rules('Name', 'Name', 'required');
			$this->form_validation->set_rules('company_name', 'Company ', 'required');
			$this->form_validation->set_rules('contact', 'Contact ', 'required');
			$this->form_validation->set_rules('Address', 'Address ', 'required');
			$this->form_validation->set_rules('cnic', 'CNIC ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->add();
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			
			   $res= $this->Common_model->createRecord($data,'suppliers');
			   response($res,'supplier/add',"Data Inserted Successfully");
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    }
    
    
    
}
?>