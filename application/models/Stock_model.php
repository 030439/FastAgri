<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function getProducts() {
        $this->db->select('products.*, units.Name as unit');
        $this->db->from('products');
        $this->db->join('units', 'products.unit_id = units.id', 'left');
        $products = $this->db->get()->result();

        return $products;
    }
    public function getStock(){
        $this->db->select('stocks.*, products.Name as product');
        $this->db->from('stocks');
        $this->db->join('products', 'stocks.pid = products.id', 'left');
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function getSeed(){
        $crops = $this->db->get('crops')->result();
        return $crops;
    }

    public function insertProduct($data) {
        return $this->db->insert('products', $data);
    }
    public function insertSeed($data) {
        $this->db->insert('products', $data);
        $insert_id = $this->db->insert_id();
        $cropArr=['pid'=>$insert_id,'FasalName'=>$data['Name']];
        return $this->db->insert('crops', $cropArr);
    }

    public function getshareholderById($id) {
        $shareholder = $this->db->get_where('shareholders', ['id' => $id])->row();
        return $shareholder;
    }

    public function updateShareHolder($id, $data) {
      $this->db->where('id', $id);
       return  $this->db->update('shareholders', $data);
    }

    public function deleteshareholder($id) {
        return $this->db->delete('shareholders', ['id' => $id]);
    }

    public function getStockProduct(){
        $query = $this->db->query("
        SELECT p.id as id, p.Name AS ProductName, 
        ps.qty AS RemainingQuality,
        pd.rate
        FROM purchasesdetail pd
        JOIN products p ON pd.product_id = p.id
        JOIN crops c ON c.pid = p.id
        LEFT JOIN purchaseseeddetail ps ON pd.id = ps.pid
        GROUP BY p.id
    ");

    if ($query) {
        return $result = $query->result_array();
    }
    }
    public function getStockQty($id){
        $query = $this->db->query("
            SELECT p.Name AS ProductName, 
            ps.qty AS RemainingQuality
            FROM purchasesdetail pd
            JOIN products p ON pd.product_id = p.id
            JOIN crops c ON c.pid = p.id
            LEFT JOIN purchaseseeddetail ps ON pd.id = ps.pid
            GROUP BY p.id
            HAVING p.id = $id
        ");

        if ($query) {
            $result = $query->result_array();
            return $result[0]['RemainingQuality'];
            // Process the result as needed
        } else {
            // Handle query execution failure
        }
    }
    public function createAlgo(){
        $query = $this->db->query("
        SELECT product_id,fu_price,id from purchasesdetail  
    ");

    if ($query) {
         $result = $query->result_array();
        
         foreach($result as $k=> $res){
            echo "<pre>";
            $product_ids=explode(",",$res['product_id']);
            $fu_price=explode(",",$res['fu_price']);
            
            for($i=0;$i<count($product_ids);$i++){
                // echo "<pre>";
                // echo $product_ids[$i];
                // echo "<br>";
                // echo $fu_price[$i];
                // echo "<br>__________";
                
            }
        //   dd($product_ids);
            // print_r(count($product_ids));
            // $fu_price=explode(",",$res['fu_price']);
         }
         print_r($fu_price);
         dd($product_ids);
         dd("SDF");
         foreach($result as $re){
            $id=$re['purchase_id'];
            $purchased = $this->db->query("
            SELECT purchase_id,RemainingQuantity from purchaseqty
            SELECT product_id,fu_price from purchasesdetail WHERE id=$id
        ");
        $pr = $purchased->result_array();
        
        // foreach($pr as $p){
            
        // }
      
         }
         
         $product_ids=explode(",",$pr[0]['product_id']);
         $fu_price=explode(",",$pr[0]['fu_price']);

         foreach ($product_ids as $index => $product_id) {
            echo "<pre>";
            print_r($product_id);
            echo "<br>";
            $final=$fu_price[$index];
            print_r($final);
            // $individual_records[] = array(
            //     'purchase_detail_id' => $row['purchase_detail_id'],
            //     'product_id' => $product_id,
            //     'product_name' => $row['product_name']);
            }

         dd($product_id);
    }
    }
}
