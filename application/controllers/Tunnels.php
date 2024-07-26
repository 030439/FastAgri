<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
class Tunnels extends CI_Controller{
   
	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Tunnel_model');
		$this->load->model('ShareHolder_model');
        $this->load->library('form_validation');
        if (!is_authorized()) {
			redirect('auth/login');
		}
    }
    public function index(){
        $this->load->view('layout/parts',['page'=>"pages/tunnels/list-tunnel"]);
    }
    public function tunnelStatus(){
        $id=$this->input->post('id');
        return $this->Tunnel_model->tunnelStatus($id);
    }
    public function getTunnels(){
        $tunnels=$this->Common_model->getAll('tunnels');
        $html="";
    //     $html.='<label>
    //      <input type="checkbox" value="0" name="select-tunnel[]" class="ckkBox all" checked />
    //      <span>All </span>
    //    </label><br>';
        foreach($tunnels as $tunnel){
        
       $html.='
 
       <label>
         <input type="checkbox" name="select-tunnel[]" value="'.$tunnel->id.'" class="ckkBox val" />
        '.$tunnel->TName.'</span>
       </label><br>';
    }
         echo $html;
    }
    public function summary(){
        $data=$this->Tunnel_model->tunnelSummary();
        $this->load->view('layout/parts',['page'=>"pages/tunnels/summary",'data'=>$data]);
    }

    public function tunnelJsList(){
        try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
            
			$res=$this->Tunnel_model->tunnelJsList($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
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
                $data['shareholder'];
                $t_share=0;
                foreach($data['shares'] as $share){
                    $t_share+=$share;
                }
                if($t_share>100){
                    $res=false;
                    response($res,'tunnels/add','',"shares can't be greater then 100");
                }elseif($t_share<100){
                    $res=false;
                    response($res,'tunnels/add','',"shares can't be less then 100");
                }
			
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
    public function detail($id){
        
    }
    public function tunnleExpense($id){
         $data['expenses']=$this->Tunnel_model->getunnelsExpense($id);
        $this->load->view('layout/parts',['page'=>"pages/tunnels/expense",'data'=>$data]);
    }

    public function individualExpense($id){
        try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
            
			$res=$this->Tunnel_model->individualExpense($id,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
    }

    public function getunnelsExpenseList(){
        $id=$this->input->post('id');
        try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
            
			$res=$this->Tunnel_model->getunnelsExpenseList($id,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
    }
    public function tunnleLedger($id){
        $this->load->view('layout/parts',['page'=>"pages/tunnels/tunnle-ledger",'id'=>$id]);
    }
    public function tunnleLedgerListing($id){
        try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
            
			$res=$this->Tunnel_model->tunnelLedger($id,$draw, $start, $length, $search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
    }
    public function getunnelsProfitList(){
        $id=$this->input->post('id');
        try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
            
			$res=$this->Tunnel_model->getunnelsProfitList($id,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
    }
    public function tunnleProfit($id){
        $data['profits']=$this->Tunnel_model->tunnleProfit($id);
        $this->load->view('layout/parts',['page'=>"pages/tunnels/profits",'data'=>$data]);
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
    public function detailPdf($id){
        $data=$this->Tunnel_model->getunnelsExpense($id);
        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_bottom'=>0,
            'margin_left'=>0,
            'margin_right'=>0,
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $html=$this->load->view('pages/reports/stunnelpdf',["data"=>$data],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }
}
?>