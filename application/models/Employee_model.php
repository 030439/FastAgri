<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function count_records()
    {
        // Example query to count total records in your database table
        return $this->db->count_all('employees');
    }
    public function getAll($limit, $offset) {
        $this->db->select('
        employees.id,employees.Name,employees.FatherName,
        employees.Nic,employees.Address,employees.ContactNo,
        employees.BasicSalary,employees.Allowances,employees.Medical,employees.status,

        designations.Name as designation,employeecategory.Name as category
       ');
        $this->db->from('employees');
        $this->db->join('designations', 'employees.designation_id = designations.id', 'left');
        $this->db->join('employeecategory', 'employees.employee_cat_id = employeecategory.id', 'left');
        $this->db->limit($limit, $offset);
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function generatePayroll() {
        $this->db->select('
        employees.id as eid,employees.Name,employees.FatherName,
        employees.Nic,employees.Address,employees.ContactNo,
        employees.BasicSalary,employees.Allowances,employees.Medical,employees.status,
        loans.loan,loans.installment,

        designations.Name as designation,employeecategory.Name as category
       ');
        $this->db->from('employees');
        $this->db->join('loans', 'employees.id = loans.employee_id', 'left');
        $this->db->join('designations', 'employees.designation_id = designations.id', 'left');
        $this->db->join('employeecategory', 'employees.employee_cat_id = employeecategory.id', 'left');
        $this->db->where('employeecategory.id', 1);
        // $this->db->limit($limit, $offset);
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function permanentEmployee($limit, $offset) {
        $this->db->select('
        employees.id,employees.Name,employees.FatherName,
        employees.Nic,employees.Address,employees.ContactNo,
        employees.BasicSalary,employees.Allowances,employees.Medical,employees.status,
        designations.Name as designation,employeecategory.Name as category
       ');
        $this->db->from('employees');
        $this->db->join('designations', 'employees.designation_id = designations.id', 'left');
        $this->db->join('employeecategory', 'employees.employee_cat_id = employeecategory.id', 'left');
        $this->db->where('employeecategory.id', 1);
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function getDailyEmployees($limit, $offset) {
        $this->db->select('
        employees.id,employees.Name,employees.FatherName,
        employees.Nic,employees.Address,employees.ContactNo,
        employees.BasicSalary,employees.Allowances,employees.Medical,employees.status,

        designations.Name as designation,employeecategory.Name as category
       ');
        $this->db->from('employees');
        $this->db->join('designations', 'employees.designation_id = designations.id', 'left');
        $this->db->join('employeecategory', 'employees.employee_cat_id = employeecategory.id', 'left');
        $this->db->where('employeecategory.id', 2);
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function getCategory() {
        $customers = $this->db->get('employeecategory')->result();
        return $customers;
    }
    public function getDesignation() {
        $designation = $this->db->get('designations')->result();
        return $designation;
    }
    public function getEmployees() {
        $designation = $this->db->get('employees')->result();
        return $designation;
    }
     public function getEmployeePayById($id) {
        $this->db->select('employees.payable');
        $this->db->from('employees');
        $this->db->WHERE('id', $id);
        $products = $this->db->get()->result();
        return $products[0]->payable;
    }
    public function saveEmployee($data) {
        if($this->db->insert('employees', $data)){
            
            $id = $this->db->insert_id();
            $loan=[
                'employee_id'=>$id,
                'category' =>$data['employee_cat_id'],
                'loan'=>0,
                'installment'=>0
            ];
            return $this->db->insert('loans', $loan);
        }
    }
    public function employeeAdvanceAdd($data) {
        if($this->db->insert('employee_loan', $data)){
            $employee = $this->db->get_where('loans', ['employee_id' => $data['employee_id']])->row();
            $loan=$employee->load;
            $loan+=$data['amount'];
            $installment=$employee->load;
            $installment+=$data['installment'];
            $loan=[
                'loan'=>$loan,
                'installment'=>$installment
            ];
            $this->db->where('employee_id', $data['employee_id']);
            return $this->db->update('loans', $loan);
        }
        //return $this->db->insert('employee_loan', $data);
    }
    public function getLoans(){
        $this->db->select('
        employee_loan.id, employee_loan.amount,employee_loan.date_, employee_loan.installment,
        employees.Name as employee, employeecategory.Name as category 
       ');
        $this->db->from('employee_loan');
        $this->db->join('employees', 'employees.id = employee_loan.employee_id', 'left');
        $this->db->join('employeecategory', 'employee_loan.employee_type = employeecategory.id', 'left');
        $stocks = $this->db->get()->result();
        return $stocks;
    }

    public function employeeLoanListing($draw, $start, $length, $search)
    {
        // Total records without filtering
        $totalRecords = $this->db->count_all_results('employee_loan');
    
        // Start the query with the necessary joins
        $this->db->select('
            employee_loan.id, 
            employee_loan.amount, 
            employee_loan.date_, 
            employee_loan.installment,
            employees.Name as employee, 
            employeecategory.Name as category 
        ');
        $this->db->from('employee_loan');
        $this->db->join('employees', 'employees.id = employee_loan.employee_id', 'left');
        $this->db->join('employeecategory', 'employee_loan.employee_type = employeecategory.id', 'left');
    
        
    
        // Apply search filter if provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('employee_loan.amount', $search);
            $this->db->or_like('employees.Name', $search);
            $this->db->or_like('employee_loan.installment', $search);
            $this->db->or_like('employee_loan.date_', $search);
            $this->db->or_like('employeecategory.Name', $search);
            $this->db->group_end();
        }
        // Apply pagination
        $this->db->limit($length, $start);
        $this->db->order_by('employee_loan.id', 'desc');
    
        // Get the data
        $data = $this->db->get()->result();
    
        // Prepare the response
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $data
        );
    
        return $response;
    }
    

    public function saveDesignation($data) {
        return $this->db->insert('designations', $data);
    }
    public function saveCategory($data) {
        return $this->db->insert('employeecategory', $data);
    }

    public function getcustomerById($id) {
        $customer = $this->db->get_where('customers', ['id' => $id])->row();
        return $customer;
    }
    public function updateLoan($eid,$pay){
        $employee = $this->db->get_where('loans', ['employee_id' => $eid])->row();
        $loan=$employee->loan;
        $loan-=$pay;
        $loan=[
            'loan'=>$loan,
        ];
        $this->db->where('employee_id', $eid);
        return $this->db->update('loans', $loan);
    }
    public function addPays($arr){
        $record = $this->db->get_where('pays', ['employee_id' => $arr['employee_id'],'date_'=>$arr['date_']])->row(); 
       if(!$record){
             if($this->db->insert('pays', $arr)){
                $this->db->set('payable', 'payable + ' . $this->db->escape($arr['net']), FALSE);
                $this->db->where('id', $arr['employee_id']);
                return $this->db->update('employees');
             }
        }
        return false;
    }
    public function pays($data){
        foreach($data['total'] as $index => $total){
            $eid=$data['employee_id'][$index];
            $installment=$data['installment'][$index];
            
            $arr=[
                'date_' =>$data['date_'],
                'employee_id'=>$eid,
                'total'=>$total,
                'installment'=>$installment,
                'additon'=>$data['additon'][$index],
                'deduction'=>$data['deduction'][$index],
                'net'=>$data['net'][$index],
                ];
                if($this->addPays($arr)){
                    $this->updateLoan($eid,$installment);
                }else{
                    return false;
                }
        }
        return true;
    }
    public function getPays($draw,$start, $length,$search){
        $totalRecords = $this->db->count_all_results('pays');

        $this->db->select('
        employees.id as eid,employees.Name as employee,
        employees.BasicSalary as basic,employees.Allowances as allowance,employees.Medical as medical,employees.status,
        pays.total,pays.installment,pays.additon as addition,pays.deduction,pays.net,pays.date_ as pdate,pays.status as status
       ');
        $this->db->from('pays');
        $this->db->join('employees', 'employees.id = pays.employee_id', 'left');
        $this->db->join('designations', 'employees.designation_id = designations.id', 'left');
        $this->db->join('employeecategory', 'employees.employee_cat_id = employeecategory.id', 'left');
        $this->db->where('employeecategory.id', 1);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('employees.Name', $search);
            $this->db->or_like('pays.date_', $search);
            $this->db->or_like('pays.net', $search);
            $this->db->or_like('pays.total', $search);
            $this->db->group_end();
        }

        $this->db->order_by('pays.id', 'desc');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $pays = $query->result_array();
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
            "data" => $pays
        );
    
        return $response; 
    }
    public function updatecustomer($id, $data) {
      $this->db->where('id', $id);
       return  $this->db->update('customers', $data);
    }

    public function deletecustomer($id) {
        return $this->db->delete('customers', ['id' => $id]);
    }
}
