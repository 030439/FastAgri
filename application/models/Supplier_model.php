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
    public function get_supplier_ledger($supplier_id, $draw, $start, $length, $search) {
      $running_balance = 0;
  
      // Define the searchable columns
      $searchable_columns = [
          'pd.id',
          'pd.Date',
          'pd.total_amount',
          'pd.created_at',
          'co.amount',
          'co.cdate'
      ];
  
      // Construct the WHERE clause for search
      $search_clause = '';
      if (!empty($search)) {
          $search_value = $this->db->escape_like_str($search);
          $search_terms = array_map(function ($col) use ($search_value) {
              return "$col LIKE '%$search_value%'";
          }, $searchable_columns);
          $search_clause = 'WHERE ' . implode(' OR ', $search_terms);
      }
  
      // Fetch the total records count
      $total_query = $this->db->query("SELECT COUNT(*) as total FROM (
          SELECT pd.id FROM purchasesdetail pd WHERE pd.Supplier_id = ?
          UNION ALL
          SELECT co.id FROM cash_in_out co WHERE co.case_sT = 'supplier' AND co.cash_sP = ?
      ) AS total_records", array($supplier_id, $supplier_id));
      $total_records = $total_query->row()->total;
  
      // Main query with search and pagination
      $query = $this->db->query("
          SELECT 
              purchase_id,
              Date,
              total_amount,
              created_at,
              updated_at,
              cash_s,
              case_sT,
              cash_sP,
              narration,
              amount,
              cdate
          FROM (
              SELECT 
                  pd.id AS purchase_id,
                  pd.Date,
                  pd.total_amount,
                  pd.created_at,
                  pd.updated_at,
                  NULL AS cash_s,
                  NULL AS case_sT,
                  NULL AS cash_sP,
                  NULL AS narration,
                  0 AS amount,
                  pd.Date AS cdate
              FROM 
                  purchasesdetail pd
              WHERE 
                  pd.Supplier_id = ?
              
              UNION ALL
              
              SELECT 
                  NULL AS purchase_id,
                  NULL AS Date,
                  0 AS total_amount,
                  NULL AS created_at,
                  NULL AS updated_at,
                  co.cash_s,
                  co.case_sT,
                  co.cash_sP,
                  co.narration,
                  co.amount,
                  co.cdate
              FROM 
                  cash_in_out co
              WHERE 
                  co.case_sT = 'supplier'
                  AND co.cash_sP = ?
          ) AS ledger
          $search_clause
          ORDER BY 
              cdate ASC
          LIMIT ? OFFSET ?
      ", array($supplier_id, $supplier_id, $length, $start));
  
      $result = $query->result();
  
      // Calculate running balance
      $arr = [];
      foreach ($result as $c => $row) {
          $row->running_balance = $running_balance + (isset($row->total_amount) ? $row->total_amount : 0) - (isset($row->amount) ? $row->amount : 0);
          $running_balance = $row->running_balance;
          if ($row->total_amount>0) {
              $arr[] = [
                  'type' => "Purchase",
                  'id' => $row->purchase_id,
                  'date' => $this->dater($row->Date),
                  'amount' => $row->amount,
                  'total_amount' => $row->total_amount,
                  'running_balance' => $running_balance,
              ];
          } else {
              $arr[] = [
                  'type' => "Payment",
                  'id' => null,  // Modify as needed based on your requirement
                  'date' => $this->dater($row->cdate),
                  'amount' => $row->amount,
                  'total_amount' => $row->total_amount,
                  'running_balance' => $running_balance,
              ];
          }
      }
  
      $response = array(
          "draw" => intval($draw),
          "recordsTotal" => $total_records,
          "recordsFiltered" => $total_records,  // Adjust if necessary
          "data" => $arr
      );
      return $response;
  }
  function dater($date){
   if($date){
       return  date('Y-m-d', strtotime($date));
   }else{
       return "-";
   }
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
  public function detailListing($id ,$draw, $start, $length, $search = ''){
   $query = $this->db->query("SELECT * From purchasesdetail WHERE Supplier_id=$id");
   $counter = $query->result_array();
   $totalRecords = count($counter);
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
   $this->db->limit($length, $start);
   $query = $this->db->get();
      $results = $query->result_array();

      $individual_records = [];
      foreach ($results as $row) {
         $product_ids = explode(',', $row['product_id']);
         $purchased_quantities = explode(',', $row['purchased_quantity']);
         $purchased_rates = explode(',', $row['rate']);

         foreach ($product_ids as $index => $product_id) {
           $pdate= date('Y-m-d', strtotime($row['purchase_date']));
            $individual_records[] = array(
               'purchase_detail_id' => $row['purchase_detail_id'],
               'product_name' => $row['product_name'],
               'purchased_quantity' => $purchased_quantities[$index],
               'purchase_product_id' => $row['purchase_product_id'],
               'rate' => $purchased_rates[$index],
               'amount' => $row['amount'],
               'total_amount' => $row['total_amount'],
               'purchase_date' => $pdate
            );
         }
      }
      $response = array(
         "draw" => intval($draw),
         "recordsTotal" => intval($totalRecords),
         "recordsFiltered" => intval($totalRecords),  // No filtering applied in this example
         "data" => $individual_records
     );
 
     return $response;

     // return $individual_records;
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
   
