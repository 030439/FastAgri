<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
class Shareholders extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('ShareHolder_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
		//$data= $this->ShareHolder_model->getshareholders();
		$this->load->view('layout/parts',['page'=>"pages/shareholders/list-shareholders"]);
	}
    public function getShareSolders(){
        $data= $this->ShareHolder_model->getshareholders();
        $html="";
		$html.='<option value="default" selected disabled>Select an option</option>';
		foreach($data as $d){
			$html.="<option value='$d->id'>";
			$html.=$d->Name;
			$html.="</option>";
		}
		echo $html;
    }
    public function jsList(){
        try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            
			$res=$this->ShareHolder_model->getshareholdersListing($draw,$start = 0, $length = 10);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
    }
	
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/shareholders/add-shareholders"]);
	}
	public function response($res,$route,$msg){
		if($res){
			$this->session->set_flashdata('success', $msg);
            redirect($route);
		   }
		   else{
			$this->session->set_flashdata('error', 'Something went Wrong.');
            redirect($route);
		   }
	}
 

    public function create() {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('capital_amount', 'Capital Amount', 'required');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout/parts',['page'=>"pages/shareholders/add-shareholders"]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->ShareHolder_model->createShareholder($data);
		   $this->response($res,'shareholders',"Data Inserted Successfully");
        }
    }
	public function edit($id) {
            $data = $this->ShareHolder_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
    }
    public function detail($id){
        $data=$this->ShareHolder_model->detail($id);
        $this->load->view('layout/parts',['page'=>"pages/shareholders/detail",'data'=>$data,'id'=>$id]);
    }
    public function detailPdf($id){
        $data=$this->ShareHolder_model->detail($id);
        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_bottom'=>0,
            'margin_left'=>0,
            'margin_right'=>0,
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $html=$this->load->view('pages/reports/shareholdersDetail',["data"=>$data],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    public function update() {
		$id = $this->input->post('id');
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = $this->ShareHolder_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $data = ($data);
            $res=$this->ShareHolder_model->updateShareHolder($id, $data);
			$this->response($res,'shareholders' ,"Data Update Successfully");
        }
    }

    public function delete($id) {
        $this->ShareHolder_model->deleteshareholder($id);
        $this->session->set_flashdata('success_message', 'Record deleted successfully.');
        redirect('shareholder');
    }
}