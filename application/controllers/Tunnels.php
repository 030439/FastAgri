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
        $data=$this->Tunnel_model->getunnels();
        $this->load->view('layout/parts',['page'=>"pages/tunnels/list-tunnel",'data'=>$data]);
    }
    public function add(){
        $data['products']=$this->Common_model->getAll('crops');
        $data['shareholders']= $this->ShareHolder_model->getshareholders();
        $this->load->view('layout/parts',['page'=>"pages/tunnels/add-tunnel",'data'=>$data]);
    }
    public function save(){
        try{
			$this->form_validation->set_rules('shares[]', 'Shares', 'required');
			$this->form_validation->set_rules('shareholder[]', 'Shareholder ', 'required');
			$this->form_validation->set_rules('product', 'Product ', 'required');
			$this->form_validation->set_rules('area', 'Covered Area ', 'required');
            $this->form_validation->set_rules('cdate', 'Croping Date ', 'required');
			$this->form_validation->set_rules('name', 'Crop Name ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->add();
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			
                $res= $this->Tunnel_model->createTunnel($data);
                if($res){
                    response($res,'tunnels',"Data Inserted Successfully");
                   }
                   else{
                    response($res,'tunnels',"Something went Wrong");
                   }
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    }
    public function tunnelProduct(){
        try{
                $id = $this->input->post('id');
                $res= $this->Tunnel_model->tunnelProduct($id);
                echo $res->product;
			}
        catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    }
    
    
}
?>