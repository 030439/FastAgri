<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jamandar extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
		$this->load->model('Common_model');
        $this->load->model('Jamandar_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
    }
    public function index(){
        $data=$this->Jamandar_model->getAll();
        
        $this->load->view('layout/parts',['page'=>"pages/human-resource/jamandar",'data'=>$data]);
    }
    public function getJamandars(){
		$result=$this->Jamandar_model->getAll();
		$html="";
		foreach ($result as $key => $res) {
			$html.="<option value='".$res->id."'>";
			$html.=$res->name;
			$html.="</option>";
		}
		echo $html;
	}
    public function detail($id){
        $data=$this->Jamandar_model->labourListByJamandar($id);
        $this->load->view('layout/parts',['page'=>"pages/human-resource/jamandar-issue-labour-list",'data'=>$data]);
    }

    public function add(){
        $this->load->view('layout/parts',['page'=>"pages/human-resource/add-jamandar"]);
    }
    public function save(){
		try {
			$this->form_validation->set_rules('name', 'Name ', 'required');
            $this->form_validation->set_rules('cnic', 'CNIC ', 'required');
            $this->form_validation->set_rules('contact', 'Contact ', 'required');
            $this->form_validation->set_rules('address', 'Address ', 'required');
			if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/parts',['page'=>"pages/human-resource/add-jamandar"]);
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Jamandar_model->saveJamandar($data);
			   if($res){
				response($res,'jamandars',"Data Inserted Successfully");
			   }
			   else{
              
				response($res,'jamandars',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
    
}