<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
		$this->load->model('Setup_model');
		$this->load->model('Tunnel_model');
		$this->load->model('Stock_model');
        $this->load->library('form_validation');
    }
	public function index()
	{
	    $data=$this->Stock_model->sellList();
		$this->load->view('layout/parts',['page'=>"pages/sell/list-sell",'data'=>$data]);
	}
	public function detail($id){
		$data= $this->Stock_model->sellDetail($id);
		$this->load->view('layout/parts',['page'=>"pages/sell/sell-detail",'data'=>$data]);
	}
	public function sellBillDetail($id){
		$data= $this->Stock_model->sellBillDetail($id);
		$this->load->view('layout/parts',['page'=>"pages/sell/bill-detail",'data'=>$data]);
	}
	public function getPass($id){
		$data= $this->Stock_model->getPassBysellDetailId($id);
		
// Initialize an empty array to hold tunnel-wise data
		$tunnelWiseData = [];

		// Loop through the data and categorize it by tunnel
		foreach ($data as $item) {
			$tunnel = $item['tunnel'];
			unset($item['tunnel']); // Remove 'tunnel' key from the item

			if (!isset($tunnelWiseData[$tunnel])) {
				$tunnelWiseData[$tunnel] = [];
			}

			$tunnelWiseData[$tunnel][] = $item;
		}

		$tunnelD=[];
		$c=0;
		// Sort each tunnel's data by grade
		foreach ($tunnelWiseData as &$tunnelData) {
			usort($tunnelData, function ($a, $b) {
				return strcmp($a['grade'], $b['grade']);
			});
		}
		foreach($tunnelWiseData as $tunnel=> $dd){
			$tunnelD[$c]['tunnel']=[$tunnel];
			$tunnelD[$c]['data']=$dd;
			$c++;
		}
		$this->load->view("pages/gatepass/index",['data'=>$tunnelD]);
	}
	public function loadForSale(){
		$data = $this->input->post(NULL, TRUE);
		echo $this->Stock_model->loadForSale($data);
		redirect('sell');
	}
	public function add()
	{
		$this->load->view('layout/parts',['page'=>"pages/sell/add-sell"]);
	}
}