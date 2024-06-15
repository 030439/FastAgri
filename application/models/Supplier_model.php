<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function getCustomers() {
        $customers = $this->db->get('customers')->result();
        return $customers;
    }
    public function getAll($table){
      $this->db->select('suppliers.*, supplier_detail.opening as open,supplier_detail.closing as close');
      $this->db->from('suppliers');
      $this->db->join('supplier_detail', 'supplier_detail.sid = suppliers.id', 'left');
      $all = $this->db->get()->result();
      return $all;
  }
  public function suppliersList($draw, $start, $length, $search = '') {
   // Get total records count
   $totalRecords = $this->db->count_all('suppliers');

   // Construct query with joins
   $this->db->select('suppliers.*, supplier_detail.opening as open, supplier_detail.closing as close');
   $this->db->from('suppliers');
   $this->db->join('supplier_detail', 'supplier_detail.sid = suppliers.id', 'left');

   // Apply search filter if provided
   if (!empty($search)) {
       $this->db->group_start();
       $this->db->like('suppliers.id', $search);
       $this->db->or_like('suppliers.name', $search);
       $this->db->or_like('suppliers.company', $search);
       $this->db->or_like('suppliers.contact', $search);
       $this->db->or_like('suppliers.cnic', $search);
       $this->db->or_like('suppliers.address', $search);
       $this->db->group_end();
   }

   // Apply pagination
   $this->db->order_by('suppliers.id', 'ASC');  // Order by ID or any other column as needed
   $this->db->limit($length, $start);
   $query = $this->db->get();
   $suppliers = $query->result_array();

   // Prepare the final output
   $response = array(
       "draw" => intval($draw),
       "recordsTotal" => intval($totalRecords),
       "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
       "data" => $suppliers
   );

   return $response;
}

  public function detail($id){
   $this->db->select('
      pd.id AS purchase_detail_id,
      pd.product_id,
      p.Name AS product_name,
      pd.quantity AS purchased_quantity,
      pq.product_id AS purchase_product_id,
      pq.RemainingQuantity,
      s.Name AS supplier_name,
      s.company_name AS supplier_company,
      pd.rate,
      pd.amount,
      pd.expenses,
      pd.status as status,
      pd.total_amount,
      pd.Date AS purchase_date
   ');
   $this->db->from('purchasesdetail pd');
   $this->db->join('suppliers s', 'pd.Supplier_id = s.id');
   $this->db->join('products p', 'pd.product_id = p.id');
   $this->db->join('purchaseqty pq', 'pd.id = pq.purchase_id AND pd.product_id = pq.product_id', 'left');
   $this->db->where('pd.Supplier_id', $id);
   $this->db->order_by('pd.id DESC, pq.product_id DESC');

   $query = $this->db->get();
      $results = $query->result_array();

      $individual_records = [];
      foreach ($results as $row) {
         $product_ids = explode(',', $row['product_id']);
         $purchased_quantities = explode(',', $row['purchased_quantity']);
         $purchased_rates = explode(',', $row['rate']);

         foreach ($product_ids as $index => $product_id) {
            $individual_records[] = array(
               'purchase_detail_id' => $row['purchase_detail_id'],
               'product_name' => $row['product_name'],
               'purchased_quantity' => $purchased_quantities[$index],
               'purchase_product_id' => $row['purchase_product_id'],
               'rate' => $purchased_rates[$index],
               'amount' => $row['amount'],
               'total_amount' => $row['total_amount'],
               'purchase_date' => $row['purchase_date']
            );
         }
      }
      return $individual_records;
  }
    public function createRecord($data,$table) {
      $res=$this->db->insert($table, $data);
      $ok=false;
      if($res){
         $sid = $this->db->insert_id();
         $sdata=[
            'sid'=>$sid,
            'opening'  => 0,
            'closing'  => 0
         ];
         if($this->db->insert('supplier_detail', $sdata)){
            $ok=true;
         }
      }
      return $ok?true:false;
 }
   function fetchAll($postData=null){

        $response = array();
   
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value
   
        ## Search 
        $searchQuery = "";
        if($searchValue != ''){
           $searchQuery = " (emp_name like '%".$searchValue."%' or email like '%".$searchValue."%' or city like'%".$searchValue."%' ) ";
        }
   
        ## Total number of records without filtering
        $this->db->select('count(*) as allcount');
        $records = $this->db->get('employees')->result();
        $totalRecords = $records[0]->allcount;
   
        ## Total number of record with filtering
        $this->db->select('count(*) as allcount');
        if($searchQuery != '')
           $this->db->where($searchQuery);
        $records = $this->db->get('employees')->result();
        $totalRecordwithFilter = $records[0]->allcount;
   
        ## Fetch records
        $this->db->select('*');
        if($searchQuery != '')
           $this->db->where($searchQuery);
        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get('employees')->result();
   
        $data = array();
   
        foreach($records as $record ){
   
           $data[] = array( 
              "emp_name"=>$record->emp_name,
              "email"=>$record->email,
              "gender"=>$record->gender,
              "salary"=>$record->salary,
              "city"=>$record->city
           ); 
        }
   
        ## Response
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordwithFilter,
           "aaData" => $data
        );
   
        return $response; 
   }
   public function getSuppliers(){
      $this->db->select('s.id as id,s.Name,sd.opening as opening');
      $this->db->from('suppliers s');
      $this->db->join('supplier_detail sd', 's.id = sd.sid');
      $products = $this->db->get()->result();
      return $products;
}
}
   
