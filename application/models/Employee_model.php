<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function getAll() {
        $this->db->select('
        employees.id,employees.Name,employees.FatherName,
        employees.Nic,employees.Address,employees.ContactNo,
        employees.BasicSalary,employees.Allowances,employees.Medical,employees.status,

        designations.Name as designation,employeecategory.Name as category
       ');
        $this->db->from('employees');
        $this->db->join('designations', 'employees.designation_id = designations.id', 'left');
        $this->db->join('employeecategory', 'employees.employee_cat_id = employeecategory.id', 'left');
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function getCategory() {
        $customers = $this->db->get('employeecategory')->result();
        return $customers;
    }
    public function getDesignation() {
        $designation = $this->db->get('designation')->result();
        return $designation;
    }
    public function saveEmployee($data) {
        return $this->db->insert('employees', $data);
    }
    public function saveCategory($data) {
        return $this->db->insert('employeecategory', $data);
    }

    public function getcustomerById($id) {
        $customer = $this->db->get_where('customers', ['id' => $id])->row();
        return $customer;
    }

    public function updatecustomer($id, $data) {
      $this->db->where('id', $id);
       return  $this->db->update('customers', $data);
    }

    public function deletecustomer($id) {
        return $this->db->delete('customers', ['id' => $id]);
    }
}
