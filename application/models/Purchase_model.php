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
        
        foreach ($data['qty'] as $key => $quantity) {
            $total_amount += $quantity * $data['rate'][$key];
        }
        $pro= implode(',', $data['product']);
        $sup=$data['supplier'];
        $Q=implode(',', $data['qty']);
        $rate_ =implode(',', $data['rate']);
        $pdate= $data['pdate'];
        $c_=$data['charges'];
        $ex=$total_amount * $data['charges'];
        $sql = 'INSERT INTO `purchasesdetail` (`product_id`, `Supplier_id`, `quantity`, `rate`, `amount`, `Date`, `expenses`, `total_amount`) 
        VALUES ("'.$pro.'","'.$sup.'", "'.$Q.'", "'.$rate_.'","'.$total_amount.'","'.$pdate.'","'.$c_.'","'.$ex.'")';
        $this->db->query($sql);
        $pid =$this->db->insert_id();
        foreach ($data['qty'] as $key => $quantity) {
            $purchase['purchase_id'] = $pid;
            $purchase['product_id'] = intval($data['product'][$key]);
            $purchase['RemainingQuantity'] = $data['qty'][$key];
            $this->db->insert('purchaseqty', $purchase);
            $pqid =$this->db->insert_id();
            $this->db->select('qunatity,id');
            $this->db->where('pid',$purchase['product_id']);
            $query = $this->db->get('stocks');
            $result = $query->row();
            $newQty=$result->qunatity+$purchase['RemainingQuantity'];
            $sql = "UPDATE stocks SET qunatity = ? WHERE id = ?";
            $this->db->query($sql, array($newQty, $result->id));
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

    public function getPurchaseDetails() {
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
                // print_r($purchased_quantities[$index]);
                // echo "remaing";
                // echo $row['RemainingQuantity'];
                // echo "<br>";
            }
        }
        // echo "<pre>";
        // print_r($results);die;
        return $individual_records;
    }
    
    public function getunit()
    {
        $units = $this->db->order_by('id', 'desc')->get('units')->result();


        return $units;
    }
}
