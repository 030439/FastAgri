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

    public function getunit()
    {
        $units = $this->db->order_by('id', 'desc')->get('units')->result();


        return $units;
    }
}
