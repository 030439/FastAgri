<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function readyProduct(){
        
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
    public function issueProduct($data){
        $pqid=$data['pqid'];
        $qty=$data['qty'];
        $query = $this->db->query("SELECT * From purchaseqty WHERE purchase_id=$pqid");
       if ($query) {
        $result = $query->result();
        $remaning=$result[0]->RemainingQuantity-$qty;
        $this->db->query("Update purchaseqty SET RemainingQuantity=$remaning WHERE purchase_id=$pqid");
       }
       $new=['PqId'=>$pqid,
             'empoyee_id'=>$data['person'],
             'tunnel_id'=>$data['tunnel'],
             'pid'=>$data['product'],
             'Quantity'=>$qty,
             'i_date'=>$data['issueDate']
            ];
        return $this->db->insert('issuestock', $new);
    }
    public function issueList(){
        $query = $this->db->query("
        SELECT 
            i.`id` AS issue_stock_id,
            i.`PqId`,
            i.`pid`,
            i.`Quantity`,
            i.`i_date`,
            p.`Name` AS product_name,
            t.`TName`,
            e.`Name` AS employee
        FROM 
        `issuestock` AS i
        JOIN 
        `products` AS p ON i.`pid` = p.`id`
        JOIN 
        `tunnels` AS t ON i.`tunnel_id` = t.`id`
        JOIN 
        `employees` AS e ON e.`id` = i.`empoyee_id`

        ");
        $result = $query->result();
        return $result;
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
    public function getStockRate($pid){
        $stockWithRate=array();
        $query = $this->db->query("
        SELECT id as rsid, purchase_id,RemainingQuantity From purchaseqty WHERE product_id=$pid AND  RemainingQuantity>0  order by id ASC
       ");
       if ($query) {
        $result = $query->result_array();
       }
       foreach($result as $s=> $res){
        $stockWithRate[$s]['stock']=$res['RemainingQuantity'];
        $stockWithRate[$s]['rsid']=$res['rsid'];
        $stockWithRate[$s]['purchase_id']=$res['purchase_id'];
        $Pid=$res['purchase_id'];
        $pd = $this->db->query("
        SELECT product_id,fu_price from purchasesdetail  WHERE id=$Pid
        ");
        if ($pd) {
            $purchaseDetails = $pd->result_array();
            $products=explode(",",$purchaseDetails[0]['product_id']);
            $fu_price=explode(",",$purchaseDetails[0]['fu_price']);
            for($i=0;$i<count($products);$i++){
                if($products[$i]==$pid){
                    $stockWithRate[$s]['price']=$fu_price[$i];    
                }
            }
        }
       }
       return $stockWithRate;
       
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
                echo $product_ids[$i];
                echo "<br>---------";
               echo $fu_price[$i];
                // echo "<br>__________";
                
            }
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
