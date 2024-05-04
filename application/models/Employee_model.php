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
                if($this->db->insert('pays', $arr)){
                    $this->updateLoan($eid,$installment);
                }
        }
        dd($data);
        dd("SDF");
    }

    public function updatecustomer($id, $data) {
      $this->db->where('id', $id);
       return  $this->db->update('customers', $data);
    }

    public function deletecustomer($id) {
        return $this->db->delete('customers', ['id' => $id]);
    }
}
