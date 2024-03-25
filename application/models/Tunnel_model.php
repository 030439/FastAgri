<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tunnel_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function createTunnel($data)
    {
        $existingTunnel = $this->db->get_where('tunnels', ['TName' => $data['name']])->row();
        if ($existingTunnel) {
            // Tunnel name already exists, return false
            return false;
        }

        $this->db->trans_start(); // Start Transaction
            $res['CoveredArea']=$data['area'];
            $res['TName']=$data['name'];
            $res['product__id']=$data['product'];
            $res['share_id']=implode(',', $data['shares']);
            $res['sh_id']=implode(',', $data['shareholder']);
            $res['cDate']=$data['cdate'];
           
        $this->db->insert(' tunnels', $res);
        $sid =$this->db->insert_id();
        foreach ($data['shares'] as $key => $quantity) {
            $shares['sh_id']=intval($data['shareholder'][$key]);
            $shares['shares_values']=intval($data['shares'][$key]);
            $shares['tunnel_id']=$sid;
            $res=$this->db->insert('shares', $shares);
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
    public function getunnels(){
        $this->db->select('tunnels.id,tunnels.TName,tunnels.CoveredArea,tunnels.cDate,
        crops.FasalName as product,crops.SeedQuality as grade');
        $this->db->from('tunnels');
        $this->db->join('crops', 'tunnels.product__id = crops.pid', 'left');
        $this->db->where('tunnels.status', 1);
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
}
