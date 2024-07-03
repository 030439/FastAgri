<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountHeads extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Customer_model');
        $this->load->model('Cashbook_model');
        $this->load->model('ShareHolder_model');
        $this->load->library('form_validation');
		// if (!is_authorized()) {
		// 	redirect('auth/login');
		// }
    }

    public function index()
    {
        $data= $this->Cashbook_model->getAccountHead();
        $this->load->view('layout/parts', ['page' => "pages/accounts/acoount-heads",'data'=>$data]);
    }
    public function OtherExpense(){
        $data= $this->Cashbook_model->getAccountHead();
		$html="";
		$html.='<option value="default" selected disabled>Select an option</option>';
		foreach($data as $d){
			$html.="<option value='$d->id'>";
			$html.=$d->name;
			$html.="</option>";
		}
		echo $html;
    }
    public function addAccountHead(){
        $this->form_validation->set_rules('name', 'Name ', 'required');
        if ($this->form_validation->run() == FALSE) {
            
            $data= $this->Cashbook_model->getAccountHead();
            $this->load->view('layout/parts', ['page' => "pages/accounts/acoount-heads",'data'=>$data]);
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Cashbook_model->addAccountHead($data);
		   $this->response($res,'AccountHeads',"Data Inserted Successfully");
        }
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

    public function addAsset(){
        $data['shareholders']= $this->ShareHolder_model->getshareholders();
        $this->load->view('layout/parts',['page'=>"pages/asset/add",'data'=>$data]);
    }
    
    public function saveAsset(){
        try{
			$this->form_validation->set_rules('shares[]', 'Shares', 'required');
			$this->form_validation->set_rules('shareholder[]', 'Shareholder ', 'required');
			$this->form_validation->set_rules('area', 'Asset Cost ', 'required');
			$this->form_validation->set_rules('name', 'Asset Name ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->add();
			}

            else {
				$data = $this->input->post(NULL, TRUE);
                $data['shareholder'];
                $t_share=0;
                foreach($data['shares'] as $share){
                    $t_share+=$share;
                }
                if($t_share>100){
                    $res=false;
                    response($res,'asset/add','',"shares can't be greater then 100");
                }elseif($t_share<100){
                    $res=false;
                    response($res,'asset/add','',"shares can't be less then 100");
                }
			
                $res= $this->ShareHolder_model->saveAsset($data);
                if($res){
                    response($res,'asset/list',"Data Inserted Successfully");
                   }
                   else{
                    response($res,'asset/list',"Something went Wrong");
                   }
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
    }
    
    public function asset(){
        $this->load->view('layout/parts',['page'=>"pages/asset/list"]);
    }

    public function assetJsList(){
        try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
            
			$res=$this->ShareHolder_model->assetJsList($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
    }
    public function getAssetShares(){
        $id=$this->input->post('id');
		$result=$this->ShareHolder_model->getAssetShares($id);
		$html="";
		foreach ($result as $key => $res) {
            $html.="<tr>";
            $html.="<td colspan='4' style='text-align:center'>".$key."</td>";
			$html.="<td colspan='4' style='text-align:center'>".$res->Name."</td>";
            $html.="<td colspan='4' style='text-align:center'>".$res->shares_values."</td>";
            $html.="</tr>";
		}
		echo $html;
	}

}
