<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function createPurchase($data)
    {
        $this->db->trans_start(); // Start Transaction

        $total_amount = 0;
        $bno=$data['bno'];
        $totalQty=0;
        $c_=$data['charges'];
        foreach ($data['qty'] as $key => $quantity) {
            $totalQty+=$quantity;
            
        }
       
        $perunitExpense=$c_/$totalQty;
       $finalArr=array();
        foreach ($data['qty'] as $key => $quantity) {
           
            $finalArr[$key]=round($perunitExpense + $data['rate'][$key],2); 
            $total_amount += $quantity * $data['rate'][$key];
        }
        
       $finaValue=implode(',',$finalArr);
        $pro= implode(',', $data['product']);
        $sup=$data['supplier'];
        $Q=implode(',', $data['qty']);
        $rate_ =implode(',', $data['rate']);
        $pdate= $data['pdate'];
        $ex= $data['gt'];
        $paid=$data['pa'];
        $sql = 'INSERT INTO `purchasesdetail` (`bno`,`product_id`, `Supplier_id`, `quantity`, `rate`, `fu_price`, `amount`, `paid_amount`,`Date`, `expenses`, `total_amount`) 
        VALUES ("'.$bno.'","'.$pro.'","'.$sup.'", "'.$Q.'", "'.$rate_.'","'.$finaValue.'","'.$total_amount.'","'.$paid.'","'.$pdate.'","'.$c_.'","'.$ex.'")';
      
       $this->db->query($sql);
        $pid =$this->db->insert_id();
        foreach ($data['qty'] as $key => $quantity) {
            $purchase['purchase_id'] = $pid;
            $purchase['product_id'] = intval($data['product'][$key]);
            $purchase['RemainingQuantity'] = $data['qty'][$key];
            $sb=$data['qty'][$key]*$data['rate'][$key];
            $this->updateSupplier($sup,$sb);
            $this->db->insert('purchaseqty', $purchase);
            $pqid =$this->db->insert_id();

            $result=$this->checkRecord($purchase['product_id']);
            // $this->db->select('qunatity,id');
            // $this->db->where('pid',$purchase['product_id']);
            // $query = $this->db->get('stocks');
            // $result = $query->row();

            if(!empty($result)){
            $newQty=$result->qunatity+$purchase['RemainingQuantity'];
            $sql = "UPDATE stocks SET qunatity = ? WHERE id = ?";
            $this->db->query($sql, array($newQty, $result->id));
            }else{
                $stockRecord=['pid'=>$pid,'qunatity'=>$purchase['RemainingQuantity']];
                 $this->db->insert('stocks', $stockRecord);
            }
            if($data['quality']){
                $purchaseSeed=['pid'=>$pid,'qty'=>$purchase['RemainingQuantity'],'quality'=>$data['quality']];
                  $this->db->insert('purchaseseeddetail', $purchaseSeed);
            }
        }
        $this->db->trans_complete(); // Complete Transaction
        
        if ($this->db->trans_status() === FALSE) {
            // Transaction failed, handle the error
            $this->db->trans_rollback(); // Roll back changes
            return false;
        } else {
            // Transaction succeeded
            $this->db->trans_commit(); // Commit changes
            return true;
        }   
    }
public function checkRecord($pid){
    $this->db->select('qunatity, id');
$this->db->where('pid', $pid);
$query = $this->db->get('stocks');

if ($query->num_rows() > 0) {
    // Record exists, fetch the data
    $result = $query->row();
    return $result;
} else {
    // Record doesn't exist, create it
    $data = array(
        'pid' => $pid,
        // Add other columns and their values as needed
    );
    $this->db->insert('stocks', $data);

    // Fetch the newly created record
    $new_query = $this->db->get_where('stocks', array('pid' => $pid));
    $new_result = $new_query->row();
    return $new_result;
    $quantity = $new_result->quantity;
    $id = $new_result->id;
}

// Now you have either fetched an existing record or created a new one

}
public function updateSupplier($s,$b){
    $this->db->set('closing', 'closing + ' . $this->db->escape($b), FALSE);
    $this->db->where('sid', $s);
    return $this->db->update('supplier_detail');
}
function getPurchaseList($draw, $start, $length, $search){
    $totalRecords = $this->db->count_all_results('purchasesdetail');
        $this->db->select('purchasesdetail.id,purchasesdetail.total_amount,purchasesdetail.amount,purchasesdetail.paid_amount,purchasesdetail.expenses,purchasesdetail.created_at as pdate, suppliers.Name as supplier_name');
        $this->db->from('purchasesdetail');
        $this->db->join('suppliers', 'purchasesdetail.Supplier_id = suppliers.id');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('purchasesdetail.id', $search);
            $this->db->or_like('purchasesdetail.total_amount', $search);
            $this->db->or_like('suppliers.Name', $search);
            $this->db->or_like('purchasesdetail.created_at', $search);
            $this->db->group_end();
        }
    
        // Apply limit and offset for pagination
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $results = $query->result_array();
        $shareholders = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $results
        );
    
        return $shareholders;
}
public function getPurchaseDetail($id,$draw, $start, $length, $search) {
    // Calculate total records
    $totalRecords = $this->db->count_all_results('purchasesdetail');

    // Construct SQL query using Active Record
    $this->db->select('pd.id AS purchase_detail_id, pd.product_id, p.Name AS product_name, pd.quantity AS purchased_quantity, pq.product_id AS purchase_product_id, pq.RemainingQuantity, s.Name AS supplier_name, s.company_name AS supplier_company, pd.rate, pd.amount, pd.expenses, pd.total_amount, pd.Date AS purchase_date');
    $this->db->from('purchasesdetail pd');
    $this->db->join('suppliers s', 'pd.Supplier_id = s.id', 'INNER');
    $this->db->join('products p', 'pd.product_id = p.id', 'INNER');
    $this->db->join('purchaseqty pq', 'pd.id = pq.purchase_id AND pd.product_id = pq.product_id', 'LEFT');
    $this->db->where('pd.id',$id);
    $this->db->order_by('pq.product_id');

    // Apply search condition if search term is provided
    if (!empty($search)) {
        $this->db->group_start();
        $this->db->like('p.Name', $search);
        $this->db->or_like('s.Name', $search);
        $this->db->or_like('pd.amount', $search);
        $this->db->or_like('pd.rate', $search);
        $this->db->group_end();
    }

    // Apply limit and offset for pagination
    $this->db->limit($length, $start);

    // Execute query
    $query = $this->db->get();
    $results = $query->result_array();
    
    // Process results for individual records
    $individual_records = [];
    foreach ($results as $row) {
        $product_ids = explode(',', $row['product_id']);
        $purchased_quantities = explode(',', $row['purchased_quantity']);
        $purchased_rates = explode(',', $row['rate']);

        foreach ($product_ids as $index => $product_id) {
            $individual_records[] = array(
                'purchase_detail_id' => $row['purchase_detail_id'],
                'product_id' => $product_id,
                'product_name' => $row['product_name'],
                'purchased_quantity' => $purchased_quantities[$index],
                'purchase_product_id' => $row['purchase_product_id'],
                'RemainingQuantity' => $row['RemainingQuantity'],
                'supplier_name' => $row['supplier_name'],
                'supplier_company' => $row['supplier_company'],
                'rate' => $purchased_rates[$index],
                'amount' => $row['amount'],
                'expenses' => $row['expenses'],
                'total_amount' =>  $purchased_quantities[$index]*$purchased_rates[$index],
                'purchase_date' => $row['purchase_date']
            );
        }
    }

    // Construct response array
    $shareholders = array(
        "draw" => $draw,
        "recordsTotal" => count($individual_records),
        "recordsFiltered" => count($individual_records),
        "data" => $individual_records
    );

    return $shareholders;
}

    public function getSeedDetails() {
        $query = $this->db->query("
            SELECT 
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
                pd.total_amount,
                pd.Date AS purchase_date
            FROM 
                purchasesdetail pd
            JOIN 
                suppliers s ON pd.Supplier_id = s.id
            JOIN 
                products p ON pd.product_id = p.id
            LEFT JOIN
                purchaseqty pq ON pd.id = pq.purchase_id AND pd.product_id = pq.product_id
                
            ORDER BY 
                pd.id, pq.product_id
        ");
        $results = $query->result_array();
        
        $individual_records = [];
        foreach ($results as $row) {
            $product_ids = explode(',', $row['product_id']);
            $purchased_quantities = explode(',', $row['purchased_quantity']);
            $purchased_rates = explode(',', $row['rate']);
    
            foreach ($product_ids as $index => $product_id) {
                $individual_records[] = array(
                    'purchase_detail_id' => $row['purchase_detail_id'],
                    'product_id' => $product_id,
                    'product_name' => $row['product_name'],
                    'purchased_quantity' => $purchased_quantities[$index],
                    'purchase_product_id' => $row['purchase_product_id'],
                    'RemainingQuantity' => $row['RemainingQuantity'],
                    'supplier_name' => $row['supplier_name'],
                    'supplier_company' => $row['supplier_company'],
                    'rate' => $purchased_rates[$index],
                    'amount' => $row['amount'],
                    'expenses' => $row['expenses'],
                    'total_amount' => $row['total_amount'],
                    'purchase_date' => $row['purchase_date']
                );
            }
        }
        return $individual_records;
    }

    public function getSeedDetailsJS($draw, $start, $length)
    {
        // Count total records without pagination
        $totalRecords = $this->db->count_all_results('purchasesdetail');
    
        // Get records with pagination
        $query = $this->db->query("
            SELECT 
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
                pd.total_amount,
                pd.Date AS purchase_date
            FROM 
                purchasesdetail pd
            JOIN 
                suppliers s ON pd.Supplier_id = s.id
            JOIN 
                products p ON pd.product_id = p.id
            LEFT JOIN
                purchaseqty pq ON pd.id = pq.purchase_id AND pd.product_id = pq.product_id
            ORDER BY 
                pd.id, pq.product_id
            LIMIT $start, $length
        ");
        $results = $query->result_array();
    
        $individual_records = [];
        foreach ($results as $row) {
            $product_ids = explode(',', $row['product_id']);
            $purchased_quantities = explode(',', $row['purchased_quantity']);
            $purchased_rates = explode(',', $row['rate']);
    
            foreach ($product_ids as $index => $product_id) {
                $individual_records[] = array(
                    'purchase_detail_id' => $row['purchase_detail_id'],
                    'product_id' => $product_id,
                    'product_name' => $row['product_name'],
                    'purchased_quantity' => $purchased_quantities[$index],
                    'purchase_product_id' => $row['purchase_product_id'],
                    'RemainingQuantity' => $row['RemainingQuantity'],
                    'supplier_name' => $row['supplier_name'],
                    'supplier_company' => $row['supplier_company'],
                    'rate' => $purchased_rates[$index],
                    'amount' => $row['amount'],
                    'expenses' => $row['expenses'],
                    'total_amount' => $row['total_amount'],
                    'purchase_date' => $row['purchase_date']
                );
            }
        }
    
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $individual_records
        );
    
        return $result;
    }
    
    
    public function getunit()
    {
        $units = $this->db->order_by('id', 'desc')->get('units')->result();


        return $units;
    }
}
