<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
		$this->load->model('Common_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
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
		$vendor = $this->input->get('vendor', TRUE);
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
		
		$searchValue = $this->input->get("search")['value'] ?? '';
		if ($searchValue) {
			$this->db->group_start();
			foreach ($this->getFieldNames() as $field) {
				$this->db->or_like($field, $searchValue);
			}
			$this->db->group_end();
		}

		$start = $this->input->get("start") ?? 0;
		$length = $this->input->get("length") ?? 10;
		$draw = $this->input->get("draw") ?? 0;

		$this->db->limit($length, $start);
		$query = $this->db->get();
		$result = $query->result();

		$arr = [];
		foreach ($result as $row) {
			$arr[] = (array) $row;
		}

		$filtered = count($arr);
		$totalRows = $this->db->count_all_results('employees', false);

		$data = [
			"draw" => $draw,
			"recordsTotal" => $totalRows,
			"recordsFiltered" => $totalRows,
			"data" => $arr,
		];

		echo json_encode($data);
		exit();
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