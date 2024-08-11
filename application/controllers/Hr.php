<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hr extends CI_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->model('Jamandar_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
		$this->load->model('Common_model');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }

	public function index()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/list-employee"]);
	}
	public function labourRate(){
		try{
			$data=$this->Jamandar_model->getRate();
		    $this->load->view('layout/parts',['page'=>"pages/human-resource/labour-rate",'data'=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
	public function getLabourRate(){
		$data=$this->Jamandar_model->getRate();
		echo $data['0']->amount;
	}
	public function updateRate(){
		$this->form_validation->set_rules('rate', 'rate', 'required');
        if ($this->form_validation->run() == FALSE) {
			$data=$this->Jamandar_model->getRate();
		    $this->load->view('layout/parts',['page'=>"pages/human-resource/labour-rate",'data'=>$data]);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $data = ($data);
            $res=$this->Jamandar_model->updateRate($data);
			response($res,'labour-rate' ,"Data Update Successfully");
        }
	}
	public function add()
	{
		
		$this->load->view('layout/parts',['page'=>"pages/human-resource/add-employee"]);
	}
	public function issuedLabourEdit($id)
	{  
		$data['labour']=$this->Jamandar_model->getIssuedLabour($id);
		$data['jamandars']=$this->Common_model->getAll('jamandars');
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$this->load->view('layout/parts',['page'=>"pages/human-resource/issue-labour-edit",'data'=>$data]);
	}
	public function updateLabourIssue(){
		$id=$this->input->post('id');
		$this->form_validation->set_rules('tunnel', 'tunnel', 'required');
		$this->form_validation->set_rules('jamandar', 'jamandar', 'required');
		$this->form_validation->set_rules('labour', 'labour', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->issuedLabourEdit($id);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $data = ($data);
            $res=$this->Jamandar_model->updateLabourIssue($id,$data);
			response($res,'issued-labour-list' ,"Data Update Successfully");
        }
	}
	public function issuelabour()
	{  
		// $data = $this->input->post(NULL, TRUE);
		$data['jamandars']=$this->Common_model->getAll('jamandars');
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$this->load->view('layout/parts',['page'=>"pages/human-resource/issue-labour",'data'=>$data]);
	}

	public function issuedLabourListing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Jamandar_model->issuedLabourListing($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}

	public function labourIssue(){
		$this->form_validation->set_rules('tunnel', 'tunnel', 'required');
		$this->form_validation->set_rules('jamandar', 'jamandar', 'required');
		$this->form_validation->set_rules('labour', 'labour', 'required');
		$this->form_validation->set_rules('ldate', 'ldate', 'required');
		$tunnels=$this->input->post('tunnel[]');
        if ($this->form_validation->run() == FALSE) {
			$data['jamandars']=$this->Common_model->getAll('jamandars');
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$this->load->view('layout/parts',['page'=>"pages/human-resource/issue-labour",'data'=>$data]);
        } else {
			if ($this->hasDuplicates($tunnels)) {
				// Return error response if duplicates found
				$this->session->set_flashdata('error', 'Duplicate tunnels are not allowed.');
				$data['jamandars'] = $this->Common_model->getAll('jamandars');
				$data['tunnels'] = $this->Common_model->getAll('tunnels');
				$this->load->view('layout/parts', ['page' => "pages/human-resource/issue-labour", 'data' => $data]);
			} else {
				// XSS cleaning for input data
				$data = $this->input->post(NULL, TRUE);
				$data = ($data);
				$res = $this->Jamandar_model->issuelabour($data);
				response($res, 'issued-labour-list', "Data Update Successfully");
			}
        }
	}
	private function hasDuplicates($array) {
		return count($array) !== count(array_unique($array));
	}
	public function labourList(){
		$data=$this->Jamandar_model->labourList();
		$this->load->view('layout/parts',['page'=>"pages/human-resource/issue-labour-list",'data'=>$data]);
		
	}
	public function Advance()
	{
		$this->load->view('layout/parts',['page'=>"pages/human-resource/advance"]);
	}
}