<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
class Jamandar extends CI_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
		$this->load->model('Common_model');
        $this->load->model('Jamandar_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }
    public function index(){
        $data=$this->Jamandar_model->getAll();
        $this->load->view('layout/parts',['page'=>"pages/human-resource/jamandar",'data'=>$data]);
    }

	public function listing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Jamandar_model->listing($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function issuedJamandarLabour(){
		$id=$this->input->post("id");
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Jamandar_model->issuedJamandarLabour($id,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
    public function jamandariAccount(){
        $data=$this->Jamandar_model->getAll();
		$html="";
		$html.='<option value="default" selected disabled>Select an option</option>';
		foreach($data as $d){
			$html.="<option value='$d->id'>";
			$html.=$d->name;
			$html.="</option>";
		}
		echo $html;
    }
    public function getJamandariById(){
		$id=$this->input->post('id');
		echo $this->Jamandar_model->getJamandariById($id);
	}
    public function advance() 
	{
        $jamandar=$this->Jamandar_model->getAll();
		$this->load->view('layout/parts',['page'=>"pages/human-resource/jamandar-advance",'jamandar'=>$jamandar]);
	}

	public function jamandarsLoanListing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Jamandar_model->jamandarsLoanListing($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}

    public function jamandarAdvanceAdd(){
		$data = $this->input->post(NULL, TRUE);
		try {
			$this->form_validation->set_rules('employee_id', 'Jamandar Name  ', 'required');
			$this->form_validation->set_rules('amount', 'Amount ', 'required');
			$this->form_validation->set_rules('installment', 'Installment ', 'required');
			$this->form_validation->set_rules('date_', 'Date ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$data=$this->Jamandar_model->getLoans();
        $jamandar=$this->Jamandar_model->getAll();
		$this->load->view('layout/parts',['page'=>"pages/human-resource/jamandar-advance",'data'=>$data,'jamandar'=>$jamandar]);
			}
			 else {
			  $data = $this->input->post(NULL, TRUE);
			  $res= $this->Jamandar_model->jamandarAdvanceAdd($data);
			   if($res){
				response($res,'jamandars/Advance',"Data Inserted Successfully");
			   }
			   else{
				response($res,'jamandars/Advance',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
	}
    public function getJmanadarsReports(){
        $data=$this->Jamandar_model->getJmanadarsReports();
        $organizedData = [];
        foreach ($data as $item) {
            $jamandar = $item->jamandar;
            $organizedData[$jamandar][] = $item;
        }
        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_bottom'=>0,
            'margin_left'=>0,
            'margin_right'=>0,
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $html=$this->load->view('pages/human-resource/jamandar-print',["data"=>$organizedData],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
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
        $this->load->view('layout/parts',['page'=>"pages/human-resource/jamandar-issue-labour-list",'data'=>$data,'id'=>$id]);
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