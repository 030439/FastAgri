<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
class Production extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
		$this->load->model('Setup_model');
		$this->load->model('Tunnel_model');
		$this->load->model('Stock_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }
	public function index()
	{
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$data['quality']=$this->Common_model->getAll('grades');
		$data['units'] = $this->Setup_model->getunit();
		$date=date('Y-m-d');
		$data['production']=$this->Stock_model->getProduction($date);
		$this->load->view('layout/parts',['page'=>"pages/production/fasal",'data'=>$data]);
	}
	public function getProductionListing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$res=$this->Stock_model->getProductionListing($startDate, $endDate,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function edit($id){
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$data['quality']=$this->Common_model->getAll('grades');
		$data['units'] = $this->Setup_model->getunit();
		//$date=date('Y-m-d');
		//$data['production']=$this->Stock_model->getProduction($date);
		$data['production']=$this->Stock_model->getProductionById($id);

		$this->load->view('layout/parts',['page'=>"pages/production/edit",'data'=>$data]);
	}
	public function dailyProductionReports(){
		$date=date('Y-m-d');
		$production=$this->Stock_model->getProduction($date);
		$mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_bottom'=>0,
            'margin_left'=>0,
            'margin_right'=>0,
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $html=$this->load->view('pages/reports/daily-production',["data"=>$production,'date'=>$date],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
	}
	public function stocks(){
		$data=$this->Stock_model->productionStocks();
		$this->load->view('layout/parts',['page'=>"pages/production/stock",'data'=>$data]);
	}
	public function sell(){
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$data['quality']=$this->Common_model->getAll('grades');
		$data['customers']=$this->Common_model->getAll('customers');
		$this->load->view('layout/parts',['page'=>"pages/sell/production-sell",'data'=>$data]);
	}
	public function readyQuantity(){
		$grade=$this->input->post('grade');
		$tunnel=$this->input->post('tunnel');
		echo $this->Stock_model->readyQuantity($grade,$tunnel);

	}
	public function proready()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/production-ready"]);
	}
	public function ready(){
		$this->form_validation->set_rules('tunnel', 'tunnel', 'required');
		$this->form_validation->set_rules('units', 'units', 'required');
		$this->form_validation->set_rules('quantity', 'quantity', 'required');
		$this->form_validation->set_rules('quality', 'quality', 'required');
        if ($this->form_validation->run() == false) {
			$data['tunnels']=$this->Common_model->getAll('tunnels');
			$data['quality']=$this->Common_model->getAll('grades');
			$data['units'] = $this->Setup_model->getunit();
			$date=date('Y-m-d');
		    $data['production']=$this->Stock_model->getProduction($date);
			$this->load->view('layout/parts',['page'=>"pages/production/fasal",'data'=>$data]);
        } else {
            // XSS cleaning for input data
			$data = $this->input->post(NULL, TRUE);
			$res=$this->Tunnel_model->tunnelProduct($data['tunnel']);
			$arr=[
				'TunnelId'  => $data['tunnel'],
				'UnitId'    => $data['units'],
				'CropId'    => $this->crop($res->product),
				'GradeId'   => $data['quality'],
				'Quantity'  => $data['quantity']
  			];
			if($data['quality']==1){
				$Qt=[
					'tunnel'  => $data['tunnel'],
					'pro'    => $this->crop($res->id),
					'ACQ'  => $data['quantity']
				  ];
			}
			else{
				$Qt=[
					'tunnel'  => $data['tunnel'],
					'pro'    => $this->crop($res->id),
					'BCQ'  => $data['quantity']
				  ];
			}
			
            $res = $this->Stock_model->readyProduct($arr,$Qt);
                response($res, 'Production', '"Data Inserted Successfully'); 
        }
	}
	public function readyProductUpdate(){
		$id=$this->input->post("id");
		$this->form_validation->set_rules('tunnel', 'tunnel', 'required');
		$this->form_validation->set_rules('units', 'units', 'required');
		$this->form_validation->set_rules('quantity', 'quantity', 'required');
		$this->form_validation->set_rules('quality', 'quality', 'required');
        if ($this->form_validation->run() == false) {
			$data['tunnels']=$this->Common_model->getAll('tunnels');
			$data['quality']=$this->Common_model->getAll('grades');
			$data['units'] = $this->Setup_model->getunit();
			$date=date('Y-m-d');
		    $data['production']=$this->Stock_model->getProduction($date);
			$this->load->view('layout/parts',['page'=>"pages/production/fasal",'data'=>$data]);
        } else {
            // XSS cleaning for input data
			$data = $this->input->post(NULL, TRUE);
			$res=$this->Tunnel_model->tunnelProduct($data['tunnel']);
			$arr=[
				'TunnelId'  => $data['tunnel'],
				'UnitId'    => $data['units'],
				'CropId'    => $this->crop($res->product),
				'GradeId'   => $data['quality'],
				'Quantity'  => $data['quantity']
  			];
			if($data['quality']==1){
				$Qt=[
					'tunnel'  => $data['tunnel'],
					'pro'    => $this->crop($res->id),
					'ACQ'  => $data['quantity']
				  ];
			}
			else{
				$Qt=[
					'tunnel'  => $data['tunnel'],
					'pro'    => $this->crop($res->id),
					'BCQ'  => $data['quantity']
				  ];
			}
			
            $res = $this->Stock_model->readyProductUpdate($id,$arr,$Qt);
                response($res, 'Production', '"Data Inserted Successfully'); 
        }
	}
	public function crop($fasal){
		return   $this->Tunnel_model->getCropId($fasal);
	}
	public function prodetail()
	{
		$this->load->view('layout/parts',['page'=>"pages/production/detail-production"]);
	}
}