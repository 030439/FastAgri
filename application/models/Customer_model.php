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
    public function customersList($draw, $start, $length, $search = '') {
        // Get total records count
        $totalRecords = $this->db->count_all('customers');
    
        // Query to fetch data with search if provided
        $this->db->select('*');
        $this->db->from('customers');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('id', $search);
            $this->db->or_like('Name', $search);
            $this->db->or_like('company', $search);
            $this->db->or_like('contact', $search);
            $this->db->or_like('cnic', $search);
            $this->db->or_like('Address', $search);
            $this->db->or_like('status', $search);
            $this->db->group_end();
        }
        $this->db->order_by('id', 'ASC');  // Order by ID or any other column as needed
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $customers = $query->result_array();
    
        // Prepare the final output
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),  // No filtering applied in this example
            "data" => $customers
        );
    
        return $response;
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
    public function customerDetailListing($id, $draw, $start, $length, $search = ''){
        $searchQuery = "";
        if($search != ''){
            $searchQuery = " AND (
                c.`Name` LIKE '%".$search."%' OR 
                c.`contact` LIKE '%".$search."%' OR 
                c.`Address` LIKE '%".$search."%' OR 
                s.`dno` LIKE '%".$search."%' OR 
                s.`vno` LIKE '%".$search."%' OR 
                sd.`GradeId` LIKE '%".$search."%' OR 
                sd.`tunnel` LIKE '%".$search."%'
            )";
        }
        
        // Fetch total records
        $totalQuery = $this->db->query("
            SELECT COUNT(*) AS total
            FROM `sells` AS s
            JOIN `customers` AS c ON c.`id` = s.`customer`
            JOIN `selldetails` AS sd ON sd.`SellId` = s.`id`
            WHERE s.`customer`=$id
        ");
        $totalRecords = $totalQuery->row()->total;
    
        // Fetch filtered records
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
            $searchQuery
            LIMIT $start, $length
        ");
        $result = $query->result_array(); 
    
        // Process results
        $newResult = [];
        foreach ($result as $row) {
            $quantities = explode(',', $row['Quantity']);
            $tunnels = explode(',', $row['tunnel']);
            $GradeId=explode(',', $row['GradeId']);
            $rate_=explode(',',$row['Rate']);
            $amount=explode(',',$row['amount']);
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
                    'freight'    => $row['kraya'],
                    'amount'     => $amount[$index],
                    'customer'   => $row['customer'],
                    'tunnel'     => $this->tunnelName($tunnels[$index]),
                ];
                $newResult[] = $newRow;
            }
        }
    
        // Prepare DataTables response
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords, // update if you are using search query
            "data" => $newResult
        ];
        
        return $response;
    }
    
    // public function customerDetailList($draw, $start, $length, $search = '', $id) {
    //     // Count total records
    //     $this->db->select('COUNT(*) as total');
    //     $this->db->from('sells s');
    //     $this->db->join('customers c', 'c.id = s.customer');
    //     $this->db->join('selldetails sd', 'sd.SellId = s.id');
    //     $this->db->where('s.customer', $id);
    //     $totalRecords = $this->db->get()->row()->total;
    
    //     // Base query to fetch data
    //     $this->db->select('
    //         s.id AS sid,
    //         s.selldate,
    //         s.dno,
    //         s.vno,
    //         s.status,
    //         s.labour,
    //         s.freight AS kraya,
    //         sd.GradeId,
    //         sd.id AS sdID,
    //         sd.tunnel,
    //         sd.Quantity,
    //         sd.Rate,
    //         sd.amount,
    //         c.Name AS customer,
    //         c.contact AS cno,
    //         c.Address AS caddress
    //     ');
    //     $this->db->from('sells s');
    //     $this->db->join('customers c', 'c.id = s.customer');
    //     $this->db->join('selldetails sd', 'sd.SellId = s.id');
    //     $this->db->where('s.customer', $id);
    
    //     // Apply search filter if provided
    //     if (!empty($search)) {
    //         $this->db->group_start();
    //         $this->db->like('s.id', $search);
    //         $this->db->or_like('s.selldate', $search);
    //         $this->db->or_like('s.dno', $search);
    //         $this->db->or_like('s.vno', $search);
    //         $this->db->or_like('c.Name', $search);
    //         $this->db->or_like('c.contact', $search);
    //         $this->db->or_like('c.Address', $search);
    //         $this->db->group_end();
    //     }
    
    //     // Apply ordering
    //     $columns = ['s.id', 's.selldate', 's.dno', 's.vno', 'c.Name', 'c.contact', 'c.Address'];
    //     $column = $columns[$order[0]['column']];
    //     $dir = $order[0]['dir'];
    //     $this->db->order_by($column, $dir);
    
    //     // Apply pagination
    //     $this->db->limit($length, $start);
    //     $query = $this->db->get();
    //     $result = $query->result_array();
    
    //     $newResult = [];
    //     foreach ($result as $row) {
    //         $quantities = explode(',', $row['Quantity']);
    //         $tunnels = explode(',', $row['tunnel']);
    //         $GradeId = explode(',', $row['GradeId']);
    //         $rate_ = explode(',', $row['Rate']);
    //         $amount = explode(',', $row['amount']);
    //         // Loop through each quantity and tunnel value to create individual records
    //         foreach ($quantities as $index => $quantity) {
    //             $newRow = [
    //                 'sid' => $row['sid'],
    //                 'selldate' => $row['selldate'],
    //                 'labour' => $row['labour'],
    //                 'sdID' => $row['sdID'],
    //                 'grade' => $this->gradeName($GradeId[$index]),
    //                 'Quantity' => $quantity,
    //                 'status' => $row['status'],
    //                 'Fasal' => $this->faslaName($tunnels[$index]),
    //                 'Rate' => $rate_[$index],
    //                 'freight' => $row['kraya'],
    //                 'amount' => $amount[$index],
    //                 'customer' => $row['customer'],
    //                 'tunnel' => $this->tunnelName($tunnels[$index]), // Use corresponding tunnel value
    //             ];
    //             $newResult[] = $newRow;
    //         }
    //     }
    
    //     // Prepare the final output
    //     $response = array(
    //         "draw" => intval($draw),
    //         "recordsTotal" => intval($totalRecords),
    //         "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
    //         "data" => $newResult
    //     );
    
    //     return $response;
    // }
    
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
    public function customerDetailInfo(){
            $this->db->select('c.id as id,c.Name,d.opening as opening');
            $this->db->from('customers c');
            $this->db->join('customer_detail d', 'c.id = d.cid');
            $products = $this->db->get()->result();
            return $products;
    }
}
