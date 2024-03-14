<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function getAll($table){
        $this->db->where('status', 1);
        $all = $this->db->get($table)->result();
        return $all;
    }

    public function createRecord($data,$table) {
         $res=$this->db->insert($table, $data);
         return $res?true:false;
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
