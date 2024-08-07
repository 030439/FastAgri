<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
		$this->load->model('Common_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
		if (!is_authorized()) {
			redirect('auth/login');
		}
    }
	
	public function index()
	{
		try{
			$this->load->library('pagination');

        // Pagination configuration
        $config['base_url'] = base_url('employees');
        $config['total_rows'] = $this->Employee_model->count_records(); // Get total number of records from your model
        $config['per_page'] = 10; // Number of records per page
        $config['uri_segment'] = 3; // URI segment containing the page number

        // Customize pagination styling if needed
        $config['attributes'] = array('class' => 'pagination-link');

        // Initialize pagination
        $this->pagination->initialize($config);

        // Fetch data with pagination
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $data['records']=$this->Employee_model->getAll($config['per_page'], $offset);

			$this->load->view('layout/parts',['page'=>"pages/human-resource/list-employee",'data'=>$data,'listing'=>"employee-list"]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function listing()
	{
		$start = $this->input->post("start") ?? 0;
		$length = $this->input->post("length") ?? 10;
		$draw = $this->input->post("draw") ?? 0;

		$vendor = $this->input->post('vendor', TRUE);
		$this->load->database();
		
		$this->db->select('
			employees.id,employees.Name,employees.FatherName,
			employees.Nic,employees.Address,employees.ContactNo,
			employees.BasicSalary,employees.Allowances,employees.Medical,employees.status,
			designations.Name as designation,employeecategory.Name as category
		');
		$this->db->from('employees');
		$this->db->join('designations', 'employees.designation_id = designations.id', 'left');
		$this->db->join('employeecategory', 'employees.employee_cat_id = employeecategory.id', 'left');
		
		// $searchValue = $this->input->get("search")['value'] ?? '';
		// if ($searchValue) {
		// 	$this->db->group_start();
		// 	foreach ($this->getFieldNames() as $field) {
		// 		$this->db->or_like($field, $searchValue);
		// 	}
		// 	$this->db->group_end();
		// }

	

		$this->db->limit($length, $start);
		$query = $this->db->get();
		$result = $query->result_array();
		// $arr = [];
		// foreach ($result as $row) {
		// 	$arr[] = (array) $row;
		// }

		$filtered = count($result);
		$totalRows = $this->db->count_all_results('employees', false);
		$response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRows),
            "recordsFiltered" => intval($filtered),
            "data" => $result
        );
		echo jsonOutPut($response);
		exit();
	}
	public function employeeLedger($id){
		// $draw = 0;//intval($this->input->post("draw"));
		// 	$start = 0;//intval($this->input->post("start"));
		// 	$length =10;// intval($this->input->post("length"));
        //     $search ='';// $this->input->post('search')['value'];
		// 	$res=$this->Employee_model->getPaysListById($id,$draw,$start, $length,$search);
		// 	dd("SDF");
		$this->load->view('layout/parts',['page'=>"pages/human-resource/employee-ledger",'id'=>$id]);
	}
	public function employeeLedgerListing($id){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Employee_model->getPaysListById($id,$draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function getPermanentEmployees(){
		$result=$this->Employee_model->permanentEmployee(0,10);
		$html="";
		foreach ($result as $key => $res) {
			$html.="<option value='".$res->id."'>";
			$html.=$res->Name;
			$html.="</option>";
		}
		echo $html;
	}
	public function getDailyEmployees(){
		$result=$this->Employee_model->getDailyEmployees(0,10);
		$html="";
		foreach ($result as $key => $res) {
			$html.="<option value='".$res->id."'>";
			$html.=$res->Name;
			$html.="</option>";
		}
		echo $html;
	}
	public function getEmployees(){
		$result=$this->Employee_model->getEmployees();
		$html="";
		$html.="<option>Select Employee</option>";
		foreach ($result as $key => $res) {
			$html.="<option value='".$res->id."'>";
			$html.=$res->Name;
			$html.="</option>";
		}
		echo $html;
	}
	public function getEmployeePayById(){
		$id=$this->input->post('id');
		echo $this->Employee_model->getEmployeePayById($id);
	}
	public function getEmployeeInstallment(){
		$id=$this->input->post('id');

		echo getEmployeeInstallment($id);
	}
	public function employeEdit($id){
		try{
			$data['employee']=$this->Employee_model->getEmployeeById($id);
			$data['designation']=$this->Common_model->getAll('designations');
			$data['category']=$this->Common_model->getAll('employeecategory');
			$this->load->view('layout/parts',['page'=>"pages/human-resource/edit-employee",'data'=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
	public function updateEmployee(){
		
		try {
			$id=$this->input->post('id');
			$this->form_validation->set_rules('Name', 'Name ', 'required');
			$this->form_validation->set_rules('FatherName', 'Father Name ', 'required');
			$this->form_validation->set_rules('Nic', 'CNIC ', 'required');
			$this->form_validation->set_rules('Address', 'Address ', 'required');
			$this->form_validation->set_rules('ContactNo', 'Contact ', 'required');
			$this->form_validation->set_rules('employee_cat_id', 'Category ', 'required');
			$this->form_validation->set_rules('designation_id', 'Designation ', 'required');
			$this->form_validation->set_rules('BasicSalary', 'Basic Salary ', 'required');
			$this->form_validation->set_rules('Allowances', 'Allowance ', 'required');
			$this->form_validation->set_rules('Medical', 'Medical ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->employeEdit($id);
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Employee_model->updateEmployee($id,$data);
			   if($res){
				response($res,'employees',"Data Updated Successfully");
			   }
			   else{
				response($res,'employees',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
	public function employeeAdvanceAdd(){
		$data = $this->input->post(NULL, TRUE);
		try {
			$this->form_validation->set_rules('employee_type', 'Employee Type ', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name  ', 'required');
			$this->form_validation->set_rules('amount', 'Amount ', 'required');
			$this->form_validation->set_rules('installment', 'Installment ', 'required');
			$this->form_validation->set_rules('date_', 'Date ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('layout/parts',['page'=>"pages/human-resource/advance"]);
			}
			 else {
			  $data = $this->input->post(NULL, TRUE);
			  $res= $this->Employee_model->employeeAdvanceAdd($data);
			   if($res){
				response($res,'employee/Advance',"Data Inserted Successfully");
			   }
			   else{
				response($res,'employee/Advance',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
	}
	public function Advance()
	{
		// $data['loans']=$this->Employee_model->getLoans();
		$this->load->view('layout/parts',['page'=>"pages/human-resource/advance"]);
	}
	public function employeeLoanListing(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Employee_model->employeeLoanListing($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	public function generatePays(){
		try {
			   $data = $this->input->post(NULL, TRUE);
			   $res= $this->Employee_model->pays($data);
			  
			   if($res){
				response($res,'payroll',"Data Inserted Successfully");
			   }
			   else{
				response($res,'payroll',"Something went Wrong");
			   }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
	}
	public function purchasedSeedList()
	{
		try{
			$res=$this->Purchase_model->getSeedDetails();
			$this->load->view('layout/parts',['page'=>"pages/purchase/list-seed","data"=>$res]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
	
	
	public function add()
	{ 
		try{
			$data['designation']=$this->Common_model->getAll('designations');
			$data['category']=$this->Common_model->getAll('employeecategory');
			$this->load->view('layout/parts',['page'=>"pages/human-resource/add-employee",'data'=>$data]);
	    } catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
	   }
	}
	public function saveCategory(){
		try {
			$this->form_validation->set_rules('Name', 'Category ', 'required');
			if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/parts', ['page' => "pages/setup/category"]);
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Employee_model->saveCategory($data);
			   if($res){
				response($res,'category',"Data Inserted Successfully");
			   }
			   else{
				response($res,'category',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
	public function designation(){
		$data=$this->Employee_model->getDesignation();
        $this->load->view('layout/parts', ['page' => "pages/setup/desigantion",'data'=>$data]);
	}
	public function Savedesignation(){
		try {
			$this->form_validation->set_rules('name', 'Designation ', 'required');
			if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/parts', ['page' => "pages/setup/desigantion"]);
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Employee_model->saveDesignation($data);
			   if($res){
				response($res,'designation',"Data Inserted Successfully");
			   }
			   else{
				response($res,'designation',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
	public function saveEmployee(){
		
		try {
			$this->form_validation->set_rules('Name', 'Name ', 'required');
			$this->form_validation->set_rules('FatherName', 'Father Name ', 'required');
			$this->form_validation->set_rules('Nic', 'CNIC ', 'required');
			$this->form_validation->set_rules('Address', 'Address ', 'required');
			$this->form_validation->set_rules('ContactNo', 'Contact ', 'required');
			$this->form_validation->set_rules('employee_cat_id', 'Category ', 'required');
			$this->form_validation->set_rules('designation_id', 'Designation ', 'required');
			$this->form_validation->set_rules('BasicSalary', 'Basic Salary ', 'required');
			$this->form_validation->set_rules('Allowances', 'Allowance ', 'required');
			$this->form_validation->set_rules('Medical', 'Medical ', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->add();
			}
			 else {
				$data = $this->input->post(NULL, TRUE);
			   $res= $this->Employee_model->saveEmployee($data);
			   if($res){
				response($res,'employees',"Data Inserted Successfully");
			   }
			   else{
				response($res,'employees',"Something went Wrong");
			   }
			  
			}
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            show_error('An unexpected error occurred. Please try again later.');
        }
       
    }
}