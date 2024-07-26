<?php
require FCPATH.'vendor/autoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Setup_model');
		$this->load->model('Common_model');
		$this->load->model('Stock_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }
	public function index()
	{
		$data=$this->Stock_model->getStockProductList();
		$this->load->view('layout/parts',['page'=>"pages/stock/list-stock",'data'=>$data]);
	}
	public function productListJs(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Stock_model->productListJs($draw,$start , $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function add()
	{
		$data=$this->Setup_model->getunit();
		$this->load->view('layout/parts',['page'=>"pages/stock/add-stock",'data'=>$data]);
	}
	public function productList(){
		$data=$this->Stock_model->getProducts();
		$this->load->view('layout/parts',['page'=>"pages/stock/products",'data'=>$data]);
	}

	public function productLedger($id){
		$this->load->view('layout/parts',['page'=>"pages/stock/product-ledger",'id'=>$id]);
	}
	public function productLederList($id){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$res= $this->Stock_model->productLedgerDetail($id,$startDate, $endDate,$draw,$start , $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function addProduct()
	{
		$data=$this->Setup_model->getunit();
		$this->load->view('layout/parts',['page'=>"pages/stock/add-product",'data'=>$data]);
	}
    public function insertProduct() {
		
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit ', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->addProduct();
        }
		 else {
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Stock_model->insertProduct($data);
		   $this->response($res,'stock/products',"Data Inserted Successfully");
        }
    }
    public function seedList()
	{
		try{
            $data=$this->Stock_model->getSeed();
            $this->load->view('layout/parts',['page'=>"pages/stock/list-seed",'data'=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
    public function seedAdd()
	{
		try{
			$data=$this->Setup_model->getunit();
		$this->load->view('layout/parts',['page'=>"pages/stock/add-seed",'data'=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
    public function insertSeed() {
		
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit ', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->seedAdd();
        }
		 else {
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Stock_model->insertSeed($data);
		   $this->response($res,'stock/products',"Data Inserted Successfully");
        }
    }
	public function insertStock() {
		
        $this->form_validation->set_rules('Name', 'Name', 'required');
		$this->form_validation->set_rules('company', 'Company', 'required');
        $this->form_validation->set_rules('unit_id', 'Unit ', 'required');
        $this->form_validation->set_rules('qunatity', 'quantity', 'required');
        $this->form_validation->set_rules('rate', 'Rate', 'required');
        if ($this->form_validation->run() == FALSE) {
			$this->add();
        }
		 else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
		
           $res= $this->Setup_model->createShareholder($data);
		   $this->response($res,'shareholders',"Data Inserted Successfully");
        }
    }
	public function createAlgo(){
		$data=$this->Stock_model->createAlgo();
	}
	public function issue()
	{
		$data['employees']=$this->Common_model->getAll('employees');
		$data['products']=$this->Common_model->getAll('products');//$this->Stock_model->getStockProduct();
		$data['tunnels']=$this->Common_model->getAll('tunnels');
		$this->load->view('layout/parts',['page'=>"pages/stock/issue-stock",'data'=>$data]);
	}
	public function issueProduct(){
		$data = $this->input->post(NULL, TRUE);
		$this->form_validation->set_rules('tunnel', 'tunnel', 'required');
        $this->form_validation->set_rules('issueDate', 'issueDate', 'required');
		$this->form_validation->set_rules('product', 'product', 'required');
        $this->form_validation->set_rules('pqid', 'pqid', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('person', 'Employee', 'required');
		$this->form_validation->set_rules('issueDate', 'Issue date', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['employees']=$this->Common_model->getAll('employees');
			$data['products']=$this->Common_model->getAll('products');//$this->Stock_model->getStockProduct();
			$data['tunnels']=$this->Common_model->getAll('tunnels');
			$this->load->view('layout/parts',['page'=>"pages/stock/issue-stock",'data'=>$data]);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $res=$this->Stock_model->issueProduct($data);
			$this->response($res,'stock/listissue' ,"Data Update Successfully");
        }
	}
	public function listissue()
	{
		//$data=$this->Stock_model->issueList();
		$data=[];
		$this->load->view('layout/parts',['page'=>"pages/stock/list-issue-stock",'data'=>$data]);
	}
	public function issueStockJs(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$startDate = $this->input->post('startDate');
			$endDate = $this->input->post('endDate');
			$data=$this->Stock_model->issueList($startDate, $endDate,$draw,$start, $length,$search);
			echo jsonOutPut($data);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function issuePdf(){
		$data=$this->Stock_model->issueListPdf();
        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_bottom'=>0,
            'margin_left'=>0,
            'margin_right'=>0,
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $html=$this->load->view('pages/reports/listIssueStockPdf',["data"=>$data],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();
	}
	public function getStockRate(){
		$id=$this->input->post('id');
		$res=$this->Stock_model->getStockRate($id);
		$html="";
		if($res){
			$html.="<option selected='selected' disabled>Select price wise Stock </option>";
			foreach($res as $e){
				$stock=$e['stock'];
				$purchase_id=$e['purchase_id'];
				$price=$e['price'];
				$html.="<option title='".$stock."'  value='".$purchase_id."'>".$price."</option>";
			}
			echo $html;
		}
		else{
			$html.="<option></option>";
			echo $html;
		}

	}
	public function getStockQty(){
		$id=$this->input->post('id');
		$res=$this->Stock_model->getStockQty($id);
		echo $res;
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
		
           $res= $this->Setup_model->createShareholder($data);
		   $this->response($res,'shareholders',"Data Inserted Successfully");
        }
    }
	public function edit($id) {
            $data = $this->Setup_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
       
    }

    public function update() {
		$id = $this->input->post('id');
        $this->form_validation->set_rules('Name', 'Name', 'required');
        $this->form_validation->set_rules('phone', 'phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data = $this->Setup_model->getshareholderById($id);
			$this->load->view('layout/parts',['page'=>"pages/shareholders/edit",'edit'=>$data]);
        } else {
            // XSS cleaning for input data
            $data = $this->input->post(NULL, TRUE);
            $data = ($data);
            $res=$this->Setup_model->updateShareHolder($id, $data);
			$this->response($res,'shareholders' ,"Data Update Successfully");
        }
    }

    public function delete($id) {
        $this->Setup_model->deleteshareholder($id);
        $this->session->set_flashdata('success_message', 'Record deleted successfully.');
        redirect('shareholder');
    }

	

} 