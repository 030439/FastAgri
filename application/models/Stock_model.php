<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function readyProduct($data,$st){
        
         if($this->db->insert('productions', $data)){
            $this->db->where('tunnel', $st['tunnel']);
            return $this->db->update('production_stock', $st);
         }
         return false;
    }
    function getOnlyPro(){
        $this->db->select('products.*, units.Name as unit,crops.id as ci');
        $this->db->from('products');
        $this->db->join('units', 'products.unit_id = units.id', 'left');
        $this->db->join('crops', 'products.id != crops.pid');
        $products = $this->db->get()->result();

        return $products;
    }
    function getOnlyProducts(){
        $this->db->select('products.*');
        $this->db->from('products');
        $this->db->join('crops', 'products.id = crops.pid', 'left');
        $this->db->where('crops.pid IS NULL');
        $products = $this->db->get()->result();
        return $products;
    }
    public function sellDetail($id){
        $query = $this->db->query("
        SELECT 
        s.`id` AS sid,
        s.`selldate`,
        s.`dno`,
        s.`vno`,
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
        WHERE s.`id`=$id
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
                    'sid' => $row['sid'],
                    'selldate' => $row['selldate'],
                    'sdID' => $row['sdID'],
                    'grade' => $this->gradeName($GradeId[$index]),
                    'Quantity' => $quantity,
                    'Rate' => $rate_[$index],
                    'freight' =>$row['kraya'],
                    'amount' => $amount[$index],
                    'customer' => $row['customer'],
                    'tunnel' => $this->tunnelName($tunnels[$index]), // Use corresponding tunnel value
                ];
                $newResult[] = $newRow;
            }
        }

        return $newResult;
    }
    public function sellDetailUpdate($id,$rate,$amount,$labour,$expences,$freight,$net){
        $rate_     = implode(',', $rate);
        $amount_   = implode(',', $amount);
        $labour_   = implode(',', $labour);
        $expences_ = implode(',', $expences);
        $freight_  = implode(',', $freight);
        $net_      = implode(',', $net);
        $data=[
            'Rate'       => $rate_,
            'Amount'     => $amount_,
            'Labour'     => $labour_,
            'commission' => $expences_,
            "Freight"    => $freight_,
            "NetAmount"  =>$net_
        ];
        $this->db->where('SellId', $id);
        return  $this->db->update('selldetails', $data);
    }
    public function sellBillDetail($id){
        $query = $this->db->query("
        SELECT 
        s.`id` AS sid,
        s.`selldate`,
        s.`dno`,
        s.`labour`,
        s.`expences`,
        s.`freight`,
        s.`vno`,
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
        WHERE s.`id`=$id
        ");
        $result = $query->result_array(); 
        $newResult = [];
        foreach ($result as $row) {
            $quantities = explode(',', $row['Quantity']);
            $tunnels = explode(',', $row['tunnel']);
            $GradeId=explode(',', $row['GradeId']);
            // Loop through each quantity and tunnel value to create individual records
            foreach ($quantities as $index => $quantity) {
                $newRow = [
                    'freight'=>$row['freight'],
                    'sid' => $row['sid'],
                    'labour' => $row['labour'],
                    'expences' => $row['expences'],
                    'selldate' => $row['selldate'],
                    'sdID' => $row['sdID'],
                    'grade' => $this->gradeName($GradeId[$index]),
                    'Quantity' => $quantity,
                    'Rate' => $row['Rate'],
                    'amount' => $row['amount'],
                    'customer' => $row['customer'],
                    'tunnel' => $this->tunnelName($tunnels[$index]), // Use corresponding tunnel value
                ];
                $newResult[] = $newRow;
            }
        }

        return $newResult;
    }
    public function updateSellBill($id, $data) {
        $this->db->where('id', $id);
         return  $this->db->update('sells', $data);
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
    public function sellList($draw, $start = 0, $length = 10, $search = '') {
        // Get the total number of records
        $totalRecords = $this->db->count_all_results('sells');
    
        // Create the query with query builder
        $this->db->select('
            s.id AS sid,
            s.selldate,
            s.driver,
            s.dno,
            s.vno,
            s.freight,
            s.labour,
            s.total_amount,
            s.expences,
            c.Name as customer,
            t.TName as tunnel
        ');
        $this->db->from('sells AS s');
        $this->db->join('customers AS c', 'c.id = s.customer', 'left');
        $this->db->join('selldetails AS sd', 'sd.SellId = s.id', 'left');
        $this->db->join('tunnels AS t', 't.id = sd.tunnel', 'left');
    
        // Apply search filter if any
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.id', $search);
            $this->db->or_like('c.Name', $search);
            $this->db->or_like('s.driver', $search);
            $this->db->or_like('s.dno', $search);
            $this->db->or_like('s.vno', $search);
            $this->db->or_like('s.total_amount', $search);
            $this->db->or_like('s.freight', $search);
            $this->db->or_like('s.labour', $search);
            $this->db->or_like('s.expences', $search);
            $this->db->group_end();
        }
    
        // Limit the results for pagination
        $this->db->limit($length, $start);
    
        // Execute the query
        $query = $this->db->get();
    
        // Get the result as an array
        $result = $query->result_array();
    
        // Prepare the final output
        $sells = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $result
        );
    
        return $sells;
    }
    
    public function tunnelProfit($draw, $start = 0, $length = 10, $search = '') {
        // Get the total number of records
        $totalRecords = $this->db->count_all_results('sells');
    
        // Create the query with query builder
        $this->db->select('
            s.id AS sid,
            s.selldate,
            sd.id as sdID,
            g.Name as grade,
            sd.Quantity,
            sd.Rate,
            sd.amount,
            c.Name as customer,
            t.TName as tunnel
        ');
        $this->db->from('sells AS s');
        $this->db->join('customers AS c', 'c.id = s.customer', 'left');
        $this->db->join('selldetails AS sd', 'sd.SellId = s.id', 'left');
        $this->db->join('tunnels AS t', 't.id = sd.tunnel', 'left');
        $this->db->join('grades AS g', 'g.id = sd.GradeId', 'left');
    
        // Apply search filter if any
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('s.id', $search);
            $this->db->or_like('c.Name', $search);
            $this->db->or_like('s.driver', $search);
            $this->db->or_like('s.dno', $search);
            $this->db->or_like('s.vno', $search);
            $this->db->or_like('s.total_amount', $search);
            $this->db->or_like('s.freight', $search);
            $this->db->or_like('s.labour', $search);
            $this->db->or_like('s.expences', $search);
            $this->db->group_end();
        }
    
        // Limit the results for pagination
        $this->db->limit($length, $start);
    
        // Execute the query
        $query = $this->db->get();
    
        // Get the result as an array
        $result = $query->result_array();
    
        // Prepare the final output
        $shareholders = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $result
        );
    
        return $shareholders;
    }
    
    public function loadForSale($data){
        $exe=false;
        $sell=[
            'customer' => $data['customer'],
            'driver' => $data['driver'],
            'dno' => $data['dnumber'],
            'vno' => $data['vno'],
            // 'freight' => $data['frieght'],
            'selldate' => $data['rdate'],
        ];
       $this->db->insert('sells', $sell);
       $sid = $this->db->insert_id();
        if($sid>0){
            $grade= implode(',', $data['grades']);
            $tunnels=implode(',', $data['tunnels']);
            $bags=implode(',', $data['bags']);
            $selldetail=[
                'SellId'=> $sid,
                'CustomerId'=>$data['customer'],
                'tunnel'=>$tunnels,
                'ProductionId'=>1,
                'GradeId'=>$grade,
                'Quantity' =>$bags,  
            ];
            // if($this->db->insert('selldetails', $selldetail)){
            //     dd("SDF");
            // }
            // dd($sd);
            if($this->db->insert('selldetails', $selldetail)){
            foreach($data['tunnels'] as $c=> $tunnel){
                $exe=false;
                $gd=$data['grades'][$c];
                $bg=$data['bags'][$c];
               // if($executed){
                    $this->reduceProductionStock($tunnel,$gd,$bg);
                    $exe=true;
                //}
            }
        }
       }
        if($exe){
            return true;
        }
        else{
            return false;
        }
    }
    public function productionStocks(){
        $query = $this->db->query("
        SELECT 
            ps.`id` AS pid,
            ps.`ACQ`,
            ps.`BCQ`,
            p.`Name` as product
        FROM 
        `production_stock` AS ps
        JOIN 
        `tunnels` AS t ON t.`id` = ps.`tunnel`
        JOIN 
        `products` AS p ON p.`id` = t.`product__id`
        ");
        $result = $query->result();
        return $result;
    }
    public function reduceProductionStock($tunnel,$g,$bg){
        $this->db->select('production_stock.*');
        $this->db->from('production_stock');
        $this->db->where('tunnel',$tunnel);
        $quantity = $this->db->get()->result();
        if($g==1){
             $new=$quantity[0]->ACQ-$bg;
             $data=[
                'ACQ'=>$new
             ];
        }
        else{
             $new=$quantity[0]->BCQ-$bg;
             $data=[
                'ACQ'=>$new
             ];
        }
        $this->db->where('tunnel', $tunnel);
       return  $this->db->update('production_stock', $data);
    }
    public function readyQuantity($g,$t){
        $this->db->select('production_stock.*');
        $this->db->from('production_stock');
        $this->db->where('tunnel',$t);
        $quantity = $this->db->get()->result();
        if($g==1){
            return $quantity[0]->ACQ;
        }
        return $quantity[0]->BCQ;
    }
    public function getProducts() {
        $this->db->select('products.*, units.Name as unit');
        $this->db->from('products');
        $this->db->join('units', 'products.unit_id = units.id', 'left');
        $products = $this->db->get()->result();

        return $products;
    }

    // SELECT p.id as id, p.Name AS ProductName, 
    //     s.qunatity AS RemainingQuality
    //     FROM products p
    //     JOIN stocks s ON s.pid = p.id
    //     GROUP BY p.id
    
    public function productListJs($draw, $start, $length,$search="") {
        $totalRecords = $this->db->count_all_results('products');
        $this->db->select('products.*, units.Name as unit,stocks.qunatity AS RemainingQuality');
        $this->db->from('products');
        $this->db->join('units', 'products.unit_id = units.id', 'left');
        $this->db->join('stocks', 'products.id = stocks.pid', 'left');
        $this->db->limit($length, $start);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('products.Name', $search);
            $this->db->or_like('units.Name', $search);
            $this->db->group_end();
        }

        $products = $this->db->get()->result();
        $shareholders = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $products
        );
    
        return $shareholders;
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
        $this->updateStock($data['product'],$qty);
        $this->db->query("Update purchaseqty SET RemainingQuantity=$remaning WHERE purchase_id=$pqid");
       }
       $new=['PqId'=>$pqid,
             'empoyee_id'=>$data['person'],
             'tunnel_id'=>$data['tunnel'],
             'pid'=>$data['product'],
             'Quantity'=>$qty,
             'i_date'=>$data['issueDate']
            ];
        if($this->db->insert('issuestock', $new)){
           if($this->tunnelExpense($pqid,$data['tunnel'],$data['product'],$qty,$data['issueDate'])){
            return true;
           }
           return false;
        }
        return ;
    }
    public function tunnelExpense($pqid,$tunnel,$pro,$qty,$idate){
        $query = $this->db->query("SELECT product_id,fu_price From purchasesdetail WHERE id=$pqid");
        $result = $query->result();
        $product_ids=explode(",",$result[0]->product_id);
        $fu_price=explode(",",$result[0]->fu_price);
        foreach($product_ids as $c=>$pid){
            if($pid==$pro){
                $amount= $fu_price[$c];
                $expense=[
                    'tunnel_id'=>$tunnel,
                    'expense_type'=>"issueStockPurchase",
                    'eid'=>$pqid,
                    'amount'=>$amount,
                    'edate'=>$idate,
                    'pid'=>$pro,
                ];
                return $this->db->insert('tunnel_expense', $expense);
            }
        }
        return ;
    }
    public function updateStock($pro,$qty){
        $this->db->set('qunatity', 'qunatity - ' . $this->db->escape($qty), FALSE);
        $this->db->where('pid', $pro);
        return $this->db->update('stocks');
    }

    public function tunnelsExpensesList($draw, $start, $length, $search = '') {
        // Get the total number of records
        $this->db->from('tunnel_expense');
        $totalRecords = $this->db->count_all_results();
    
        // Create the query with query builder
        $this->db->select('
            e.id,
            e.expense_type,
            e.eid,
            e.amount,
            e.edate,
            t.TName as tunnel
        ');
        $this->db->from('tunnel_expense AS e');
        $this->db->join('tunnels AS t', 't.id = e.tunnel_id');
        $this->db->where('t.status', '1');
    
        // Apply search filter if any
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('e.expense_type', $search);
            $this->db->or_like('e.eid', $search);
            $this->db->or_like('e.amount', $search);
            $this->db->or_like('e.edate', $search);
            $this->db->or_like('t.TName', $search);
            $this->db->group_end();
        }
    
        // Get the filtered records count
        $filteredRecords = $this->db->count_all_results('', FALSE);
        // $this->db->order_by('e.id', 'DESC');
        // Limit the results for pagination
        $this->db->limit($length, $start);
    
        // Execute the query
        $query = $this->db->get();
        $result = $query->result();
    
        // Prepare the final output
        $expenses = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($filteredRecords),
            "data" => $result
        );
    
        return $expenses;
    }
    

    public function issueListPdf(){
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
    
    public function issueList($draw, $start, $length, $search = '') {
        // Get total records count
        $totalRecords = $this->db->count_all('issuestock');
    
        // Construct the base query with joins
        $this->db->select('
            i.id AS issue_stock_id,
            i.PqId,
            i.pid,
            i.Quantity,
            i.i_date,
            p.Name AS product_name,
            t.TName,
            e.Name AS employee
        ');
        $this->db->from('issuestock i');
        $this->db->join('products p', 'i.pid = p.id');
        $this->db->join('tunnels t', 'i.tunnel_id = t.id');
        $this->db->join('employees e', 'e.id = i.empoyee_id');
    
        // Apply search filter if provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('i.id', $search);
            $this->db->or_like('p.Name', $search);
            $this->db->or_like('t.TName', $search);
            $this->db->or_like('e.Name', $search);
            $this->db->group_end();
        }
    
        // Apply pagination and ordering
        $this->db->order_by('i.id', 'ASC');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        $new=[];
        foreach($result as $i=> $re){
            $new[$i]['TName']=$re['TName'];
            $new[$i]['employee']=$re['employee'];
            $new[$i]['product_name']=$re['product_name'];
            $new[$i]['Quantity']=$re['Quantity'];
            $new[$i]['TName']=$re['TName'];
            $new[$i]['i_date']=$re['i_date'];
            $new[$i]['pqrate']=pqrate($re['PqId'],$re['pid']);
        }
    
        // Prepare the final output
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
            "data" => $new
        );
    
        return $response;
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

    public function getProduction($date){
        $query = $this->db->query("
        SELECT p.id as id, p.Quantity as qty,
        pd.Name AS ProductName, 
        t.TName AS tunnel, 
        u.Name AS unit, 
        g.Name AS grade 
        FROM productions p 
        JOIN tunnels t ON t.id = p.TunnelId 
        JOIN units u ON u.id = p.UnitId 
        JOIN crops c ON c.id = p.CropId 
        JOIN products pd ON pd.id = c.pid 
        JOIN grades g ON g.id = p.GradeId 
        WHERE p.pdate='".$date."' order BY p.id
        ");
        $result = $query->result_array();
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
    public function getProductionListing($draw, $start, $length,$search=""){
        $totalRecords = $this->db->count_all('productions');
        $sql=("
        SELECT p.id as id, p.Quantity as qty,p.pdate,
        pd.Name AS ProductName, 
        t.TName AS tunnel, 
        u.Name AS unit, 
        g.Name AS grade 
        FROM productions p 
        JOIN tunnels t ON t.id = p.TunnelId 
        JOIN units u ON u.id = p.UnitId 
        JOIN crops c ON c.id = p.CropId 
        JOIN products pd ON pd.id = c.pid 
        JOIN grades g ON g.id = p.GradeId  order BY p.id desc
        ");
        $sql .= " LIMIT $start, $length";

        // Execute the query
        $query = $this->db->query($sql);
        $result = $query->result_array();
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
            "data" => $result
        );
            return $response;
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

    public function getStockProductList(){
        $query = $this->db->query("
        SELECT p.id as id, p.Name AS ProductName, 
        s.qunatity AS RemainingQuality
        FROM products p
        JOIN stocks s ON s.pid = p.id
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



    public function getPassBysellDetailId($id){
        $query = $this->db->query("
        SELECT 
        s.`id` AS sid,
        s.`selldate`,
        s.`dno`,
        s.`vno`,
        s.`driver` as driver,
        s.`freight`,
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
        WHERE s.`id`=$id
        ");
        $result = $query->result_array(); 
        $newResult = [];
        foreach ($result as $row) {
            $quantities = explode(',', $row['Quantity']);
            $tunnels = explode(',', $row['tunnel']);
            $GradeId=explode(',', $row['GradeId']);
            // Loop through each quantity and tunnel value to create individual records
            foreach ($quantities as $index => $quantity) {
                $newRow = [
                    'sid'=>$id,
                    'freight'=>$row['freight'],
                    'selldate' => $row['selldate'],
                    'cno' => $row['cno'],
                    'driver'=>$row['driver'],
                    'caddress' => $row['caddress'],
                    'dno' => $row['dno'],
                    'vno' => $row['vno'],
                    'grade' => $this->gradeName($GradeId[$index]),
                    'Quantity' => $quantity,
                    'customer' => $row['customer'],
                    'tunnel' => $this->tunnelName($tunnels[$index]), // Use corresponding tunnel value
                ];
                $newResult[] = $newRow;
            }
        }
        return $newResult;
    }
}
