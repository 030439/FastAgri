<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function getCustomers() {
        $customers = $this->db->get('customers')->result();
        return $customers;
    }

    public function createCustomer($data) {
        $customer=$this->db->insert('customers', $data);
        $ok=false;
        if($customer){
            $cid = $this->db->insert_id();
            $cdata=[
               'cid'=>$cid,
               'opening'  => 0,
               'closing'  => 0
            ];
            if($this->db->insert('customer_detail', $cdata)){
               $ok=true;
            }
        }
        return $ok?true:false;
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
    public function customerDetail($id){
        $query = $this->db->query("
        SELECT 
        s.`id` AS sid,
        s.`selldate`,
        s.`dno`,
        s.`vno`,
        s.`status` as status,
        s.`labour` as labour,
        s.`freight` as kraya,
        sd.`GradeId`,
        sd.`id` as sdID,
        sd.`tunnel`,
        sd.`Quantity`,
        sd.`Rate`,
        sd.`amount`,
        c.`Name` as customer,
        c.`contact` as cno,
        c.`Address` as caddress
        FROM 
        `sells` AS s
        JOIN 
        `customers` AS c ON c.`id` = s.`customer`
        JOIN 
        `selldetails` AS sd ON sd.`SellId` = s.`id`
        WHERE s.`customer`=$id
        ");
        $result = $query->result_array(); 
        $newResult = [];
        foreach ($result as $row) {
            $quantities = explode(',', $row['Quantity']);
            $tunnels = explode(',', $row['tunnel']);
            $GradeId=explode(',', $row['GradeId']);
            $rate_=explode(',',$row['Rate']);
            $amount=explode(',',$row['amount']);
            // Loop through each quantity and tunnel value to create individual records
            foreach ($quantities as $index => $quantity) {
                $newRow = [
                    'sid'        => $row['sid'],
                    'selldate'   => $row['selldate'],
                    'labour'     => $row['labour'],
                    'sdID'       => $row['sdID'],
                    'grade'      => $this->gradeName($GradeId[$index]),
                    'Quantity'   => $quantity,
                    'status'     => $row['status'],
                    'Fasal'      => $this->faslaName($tunnels[$index]),
                    'Rate'       => $rate_[$index],
                    'freight'    =>$row['kraya'],
                    'amount'     => $amount[$index],
                    'customer'   => $row['customer'],
                    'tunnel'     => $this->tunnelName($tunnels[$index]), // Use corresponding tunnel value
                ];
                $newResult[] = $newRow;
            }
        }
        return $newResult;
    }
    function tunnelName($id){
        $this->db->select('tunnels.TName');
        $this->db->from('tunnels');
        $this->db->WHERE('id', $id);
        $products = $this->db->get()->result();
        return $products[0]->TName;
    }
    function gradeName($id){
        $this->db->select('grades.Name');
        $this->db->from('grades');
        $this->db->WHERE('id', $id);
        $products = $this->db->get()->result();
        return $products[0]->Name;
    }
    public function faslaName($tunnel){
            $this->db->select('p.Name');
            $this->db->from('tunnels t');
            $this->db->join('products p', 'p.id = t.product__id');
            $this->db->where('t.id', $tunnel);
            $products = $this->db->get()->result();
            return $products[0]->Name;
    }
}
