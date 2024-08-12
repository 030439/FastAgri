<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    function getProductById($id){
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where('id',$id);
        $products = $this->db->get()->result();
        return $products[0];
    }
    function getProductionById($id){
        $this->db->select('*');
        $this->db->from('productions');
        $this->db->where('id',$id);
        $products = $this->db->get()->result();
        return $products[0];
    }
    public function updateProduct($id,$data){
        $date=date("y-m-d h i s");
        $data['updated_at']=$date;
        $this->db->where('id', $id);
        return  $this->db->update('products', $data);
    }
    public function readyProduct($data,$st){
        
         if($this->db->insert('productions', $data)){
            $this->db->where('tunnel', $st['tunnel']);
            return $this->db->update('production_stock', $st);
         }
         return false;
    }
    public function readyProductUpdate($id,$data,$st){
        $this->db->where('id', $id);
        $updated=$this->db->update('productions', $data);
        if($updated){
           $this->db->where('tunnel', $st['tunnel']);
           return $this->db->update('production_stock', $st);
        }
        return false;
   }
    function getPurchase($id){
        $this->db->select('*');
        $this->db->from('purchasesdetail');
        $this->db->where('id',$id);
        $products = $this->db->get()->result();
        return $products[0];
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
        s.`driver`,
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
                    'driver'   =>$row['driver'],
                    'dno'   =>$row['dno'],
                    'vno'   =>$row['vno'],
                    'tid'      => $tunnels[$index],
                    'pid'     => $this->productByTunnel($tunnels[$index]),
                    'tunnel' => $this->tunnelName($tunnels[$index]), // Use corresponding tunnel value
                ];
                $newResult[] = $newRow;
            }
        }

        return $newResult;
    }
    public function productByTunnel($id){
        $this->db->select('p.Name');
        $this->db->from('products p');
        $this->db->join('tunnels t', 'p.id = t.product__id', 'left');
        $this->db->where('t.id',$id);
        $products = $this->db->get()->result();
        return $products[0]->Name;
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
    public function sellList($startDate, $endDate, $draw, $start = 0, $length = 10, $search = '') {
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

        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where('s.selldate BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
        }
        // Limit the results for pagination
        $this->db->limit($length, $start);
        $this->db->order_by('s.id', 'DESC');
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


    public function updateloadForSale($sid,$data){
        $exe=false;
        $date=date("y-m-d h i s");
        $sell=[
            'customer' => $data['customer'],
            'driver' => $data['driver'],
            'dno' => $data['dnumber'],
            'vno' => $data['vno'],
            'updated_at' => $date,
            'selldate' => $data['rdate'],
        ];
        $this->db->trans_start();
        $this->db->where('id', $sid);
        $ok=$this->db->update('sells', $sell);

    //    $this->db->insert('sells', $sell);
    //    $sid = $this->db->insert_id();
        if($ok){
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
            $arr_=[];
            foreach($data['tunnels'] as $c_=> $tunnel){
                $arr_[$c_]['qty']=$this->getCurrentQtyForTunnel($sid,$tunnel);
            }
            $deleted=$this->db->delete('selldetails', ['SellId' => $sid]);
            if($deleted){
                if($this->db->insert('selldetails', $selldetail)){
                    foreach($data['tunnels'] as $c=> $tunnel){
                        $exe=false;
                        $gd=$data['grades'][$c];
                        $bg=$data['bags'][$c];
                       // if($executed){
                            $this->updatereduceProductionStock($arr_[$c]['qty'],$tunnel,$gd,$bg);
                            $exe=true;
                        //}
                    }
                }
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
           return $true;
       } 
        // if($exe){
        //     return true;
        // }
        // else{
        //     return false;
        // }
    }
    public function getCurrentQtyForTunnel($sid,$tid){
        $query = $this->db->query("
        SELECT 
            sd.`Quantity`,sd.`tunnel`
        FROM 
        `selldetails` AS sd
        WHERE 
         SellId=$sid 
        ");
        $row = $query->result_array();
        $quantities = explode(',', $row[0]['Quantity']);
        $tunnels = explode(',', $row[0]['tunnel']);
        // Loop through each quantity and tunnel value to create individual records
        foreach ($quantities as $index => $quantity) {
            if($tid==$tunnels[$index]){
                return $quantity;
            }
        }
    }
    public function productionStocks($draw, $start, $length,$search){
        $totalRecords = $this->db->count_all_results('production_stock');
        $this->db->select('ps.id AS pid, ps.ACQ ac, ps.BCQ bc, p.Name as product');
        $this->db->from('production_stock ps');
        $this->db->join('tunnels t', 'ps.tunnel = t.id', 'left');
        $this->db->join('products p', 'p.id = t.product__id', 'left');
        $this->db->limit($length, $start);

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('p.Name', $search);
            $this->db->or_like('ps.ACQ', $search);
            $this->db->or_like('ps.BCQ', $search);
            $this->db->group_end();
        }

        $products = $this->db->get()->result();
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $totalRecords,
            "data" => $products
        );
    
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
    public function updatereduceProductionStock($qty,$tunnel,$g,$bg){
        $this->db->select('production_stock.*');
        $this->db->from('production_stock');
        $this->db->where('tunnel',$tunnel);
        $quantity = $this->db->get()->result();
        if($g==1){
             $new=$quantity[0]->ACQ-$bg+$qty;
             $data=[
                'ACQ'=>$new
             ];
        }
        else{
             $new=$quantity[0]->BCQ-$bg+$qty;
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
            $this->db->insert('issuestock', $new);
            $lid =$this->db->insert_id();
        if($lid>0){
           if($this->tunnelExpense($lid,$pqid,$data['tunnel'],$data['product'],$qty,$data['issueDate'])){
            return true;
           }
           return false;
        }
        return ;
    }
    public function dirextIssueProduct($data){
        $pqid=$data['pqid'];
        $qty=$data['qty'];
        $query = $this->db->query("SELECT * From purchaseqty WHERE purchase_id=$pqid");
       if ($query) {
        $result = $query->result();

        $remaning=$result[0]->RemainingQuantity-$qty;
        $this->updateStock($data['product'],$qty);
        $this->db->query("Update purchaseqty SET RemainingQuantity=$remaning WHERE purchase_id=$pqid");
       }
       $rate_=pqrate($pqid,$data['product']);
            $total_=$rate_*$qty;
       $new=['PqId'=>$pqid,
             'direct_id'=>$data['person'],
             'pid'=>$data['product'],
             'Quantity'=>$qty,
             'amount'=>$total_,
             'i_date'=>$data['issueDate']
            ];
            $this->db->insert('directissue', $new);
            $lid =$this->db->insert_id();
        if($lid>0){
            $rate_=pqrate($pqid,$data['product']);
            $total_=$rate_*$qty;
            $this->db->set('closing', 'closing + ' . $this->db->escape($total_), FALSE);
            $this->db->where('cid', $data['person']);
            $ok=$this->db->update('direct_detail');
             return true;
        }
        return ;
    }
    public function tunnelExpense($id,$pqid,$tunnel,$pro,$qty,$idate){
        $query = $this->db->query("SELECT product_id,fu_price From purchasesdetail WHERE id=$pqid");
        $result = $query->result();
        $product_ids=explode(",",$result[0]->product_id);
        $fu_price=explode(",",$result[0]->fu_price);
        foreach($product_ids as $c=>$pid){
            if($pid==$pro){
                $amount= $fu_price[$c];
                $expense=[
                    'is_id'=>$id,
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

    public function dailyExpenseListing($draw, $start, $length, $search = '') {
        // Get the total number of records
        $this->db->from('expenses');
        $totalRecords = $this->db->count_all_results();
    
        // Create the query with query builder
        $this->db->select('
            e.id,
            e.narration,
            e.amount,
            e.created_at,
            a.name
        ');
        $this->db->from('expenses AS e');
        $this->db->join('account_head AS a', 'a.id = e.head');
    
        // Apply search filter if any
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('e.narration', $search);
            $this->db->or_like('e.amount', $search);
            $this->db->or_like('a.name', $search);
            $this->db->or_like('e.created_at', $search);
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
    
    public function issueList($startDate, $endDate,$draw, $start, $length, $search = '') {
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
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where('i.i_dat BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
        }
        // Apply pagination and ordering
        $this->db->order_by('i.id', 'DESC');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        $new=[];
        foreach($result as $i=> $re){
            $arr_=pqrate($re['PqId'],$re['pid']);
            $new[$i]['TName']=$re['TName'];
            $new[$i]['employee']=$re['employee'];
            $new[$i]['product_name']=$re['product_name'];
            $new[$i]['Quantity']=$re['Quantity'];
            $new[$i]['TName']=$re['TName'];
            $new[$i]['i_date']=$re['i_date'];
            $new[$i]['pqrate']=pqrate($re['PqId'],$re['pid']);
        }
    
       // dd($new);
        // Prepare the final output
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
            "data" => $new
        );
    
        return $response;
    }
    public function directissueList($startDate, $endDate,$draw, $start, $length, $search = '') {
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
          
            e.Name AS employee
        ');
        $this->db->from('directissue i');
        $this->db->join('products p', 'i.pid = p.id');
        $this->db->join('direct e', 'e.id = i.direct_id');
    
        // Apply search filter if provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('i.id', $search);
            $this->db->or_like('p.Name', $search);
            $this->db->or_like('e.Name', $search);
            $this->db->group_end();
        }
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where('i.i_dat BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
        }
        // Apply pagination and ordering
        $this->db->order_by('i.id', 'DESC');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        $new=[];
        foreach($result as $i=> $re){
            $arr_=pqrate($re['PqId'],$re['pid']);
            $new[$i]['employee']=$re['employee'];
            $new[$i]['product_name']=$re['product_name'];
            $new[$i]['Quantity']=$re['Quantity'];
            $new[$i]['i_date']=$re['i_date'];
            $new[$i]['pqrate']=pqrate($re['PqId'],$re['pid']);
            $new[$i]['total']=$re['Quantity']*pqrate($re['PqId'],$re['pid']);
        }
    
       // dd($new);
        // Prepare the final output
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
            "data" => $new
        );
    
        return $response;
    }
    public function directissueListId($id,$startDate, $endDate,$draw, $start, $length, $search = '') {
        // Get total records count
        $totalRecords = $this->db->count_all('directissue');
    
        // Construct the base query with joins
        $this->db->select('
            i.id AS issue_stock_id,
            i.PqId,
            i.pid,
            i.Quantity,
            i.i_date,
            p.Name AS product_name,
          
            e.Name AS employee
        ');
        $this->db->from('directissue i');
        $this->db->join('products p', 'i.pid = p.id');
        $this->db->join('direct e', 'e.id = i.direct_id');
    
        // Apply search filter if provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('i.id', $search);
            $this->db->or_like('p.Name', $search);
            $this->db->or_like('e.Name', $search);
            $this->db->group_end();
        }
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where('i.i_dat BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
        }
        // Apply pagination and ordering
        $this->db->order_by('i.direct_id', $id);
        $this->db->order_by('i.id', 'DESC');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        $new=[];
        foreach($result as $i=> $re){
            $arr_=pqrate($re['PqId'],$re['pid']);
            $new[$i]['employee']=$re['employee'];
            $new[$i]['product_name']=$re['product_name'];
            $new[$i]['Quantity']=$re['Quantity'];
            $new[$i]['i_date']=$re['i_date'];
            $new[$i]['pqrate']=pqrate($re['PqId'],$re['pid']);
            $new[$i]['total']=$re['Quantity']*pqrate($re['PqId'],$re['pid']);
        }
    
       // dd($new);
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
    public function getProductionListing($startDate, $endDate,$draw,$start, $length,$search){
        $date_filter="";
        if (!empty($startDate) && !empty($endDate)) {
            $date_filter=' WHERE created BETWEEN "' . $startDate . '" AND "' . $endDate . '"';
        }
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
        JOIN grades g ON g.id = p.GradeId 
        ");
        if (!empty($startDate) && !empty($endDate)) {
            $sql.='WHERE p.pdate BETWEEN "' . $startDate . '" AND "' . $endDate . '"';
        }
        $sql .= " order BY p.id desc LIMIT $start, $length";

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


    public function productLedgerDetail($id,$startDate, $endDate,$draw,$start , $length,$search){
        $total_query = $this->db->query("SELECT COUNT(*) as total FROM (
            SELECT pd.id FROM purchaseqty pd WHERE pd.product_id = ?
            UNION ALL
            SELECT i.id FROM issuestock i WHERE i.pid = ?
        ) AS total_records", array($id, $id));
        $total_records = $total_query->row()->total;

        $sql=("
            SELECT
                issue_stock_id,
                pqid,
                quantity,
                i_date,
                tname,
                employee,
                purchase_detail_id,
                purchased_quantity,
                supplier_name,
                rate,
                product_id,
                amount,
                pcreated,
                total_amount,
                purchaseQ,
                issueQ,
                @running_balance := @running_balance +(
                    IFNULL(purchased_quantity, 0) - IFNULL(quantity, 0)
                ) AS running_balance
            FROM
                (
                SELECT
                    i.id as issue_stock_id,
                    i.pqid,
                    i.quantity,
                    i.created_at as i_date,
                    i.i_date as issueQ,
                    t.TName as tname,
                    e.Name as employee,
                    NULL AS purchase_detail_id,
                    NULL AS purchased_quantity,
                    NULL AS supplier_name,
                    NULL AS rate,
                    NULL AS amount,
                    NULL AS pcreated,
                    NULL AS total_amount,
                    NULL AS product_id,
                    NULL AS purchaseQ

                FROM
                    `issuestock` `i`
                JOIN `products` `p` ON
                    `i`.`pid` = `p`.`id`
                JOIN `tunnels` `t` ON
                    `i`.`tunnel_id` = `t`.`id`
                JOIN `employees` `e` ON
                    `e`.`id` = `i`.`empoyee_id`
                WHERE
                    `i`.`pid` = $id
                UNION ALL
            SELECT 
                    NULL AS issue_stock_id,
                    NULL AS pqid,
                    NULL AS quantity,
                    NULL AS i_date,
                    NULL AS issueQ,
                    NULL AS  tname,
                    NULL AS employee,
                    
                    pd.id as purchase_detail_id,
                    pd.quantity as purchased_quantity,
                    s.Name AS supplier_name,
                    pd.rate,
                    pd.amount,
                    pd.created_at as pcreated,
                    pd.total_amount,
                    pd.product_id,
                    pq.id as purchaseQ
            FROM
                    `purchasesdetail` `pd`
                INNER JOIN `suppliers` `s` ON
                    `pd`.`Supplier_id` = `s`.`id`
                INNER JOIN `products` `p` ON
                    `pd`.`product_id` = `p`.`id`
                LEFT JOIN `purchaseqty` `pq` ON
                    `pd`.`id` = `pq`.`purchase_id` AND `pd`.`product_id` = `pq`.`product_id`
                WHERE
                    `pq`.`product_id` = $id
            ) AS combined_data,
             (SELECT @running_balance := 0) AS rb
            ORDER BY
                i_date,pcreated ASC;
            ");
            $query = $this->db->query($sql);
            $results = $query->result_array();
            $final=[];
            foreach($results as $c=> $result){
                if($result['issue_stock_id']){
                    $final[$c]['type']="issue";
                    $final[$c]['detail']=$result['issue_stock_id'];
                    $final[$c]['quantity']=$result['quantity'];
                    $final[$c]['date_']=$result['i_date'];
                    $final[$c]['tname']=$result['tname'];
                    $final[$c]['employeeOrSupplier']=$result['employee'];
                    //$final[$c]['purchased_quantity']=$result['purchased_quantity'];
                   // $final[$c]['supplier_name']=$result['supplier_name'];
                    $final[$c]['rate']=$result['rate'];
                    $final[$c]['amount']=$result['amount'];
                    $final[$c]['running_balance']=$result['running_balance'];
                }else{
                    $final[$c]['type']="purchase";
                    $final[$c]['detail']=$result['purchase_detail_id'];
                   // $final[$c]['quantity']=$result['quantity'];
                    $final[$c]['date_']=$result['pcreated'];
                    $final[$c]['tname']="-";
                    //$final[$c]['employeeOrSupplier']=$result['employee'];
                    $final[$c]['quantity']=$this->getPQ($id,$result['purchased_quantity'],$result['product_id']);
                    $final[$c]['employeeOrSupplier']=$result['supplier_name'];
                    $final[$c]['rate']=$this->getPRate($id,$result['rate'],$result['product_id']);
                    $final[$c]['amount']=$result['amount'];
                    $final[$c]['running_balance']=$result['running_balance'];
                }
            }
            $response = array(
                "draw" => intval($draw),
                "recordsTotal" => $total_records,
                "recordsFiltered" => $total_records,  // Adjust if necessary based on search
                "data" => $final
            );
            return $response;
    }
    public function getPQ($pid,$quantities,$pids){
        $purchased_quantities = explode(',',$quantities);
        $product_ids = explode(',',$pids);
        foreach ($product_ids as $index => $product_id) {
            if($product_id==$pid){
                return $purchased_quantities[$index];
            }
        }
    }
    public function getPRate($pid,$quantities,$pids){
        $purchased_quantities = explode(',',$quantities);
        $product_ids = explode(',',$pids);
        foreach ($product_ids as $index => $product_id) {
            if($product_id==$pid){
                return $purchased_quantities[$index];
            }
        }
    }
    public function issueListByProduct($id,$draw, $start, $length, $search = '') {
        $totalRecords = $this->db->count_all('issuestock');
        $this->db->select('i.id AS issue_stock_id, i.PqId, i.pid, i.Quantity, i.i_date, p.Name AS product_name, t.TName, e.Name AS employee');
        $this->db->from('issuestock i');
        $this->db->join('products p', 'i.pid = p.id');
        $this->db->join('tunnels t', 'i.tunnel_id = t.id');
        $this->db->join('employees e', 'e.id = i.empoyee_id');
        $this->db->where('i.pid',$id);
    
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('i.id', $search);
            $this->db->or_like('p.Name', $search);
            $this->db->or_like('t.TName', $search);
            $this->db->or_like('e.Name', $search);
            $this->db->group_end();
        }
    
        $this->db->order_by('i.id', 'ASC');
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $result = $query->result_array();
        $new = [];
        foreach ($result as $i => $re) {
            if (!is_array($re)) continue; // Skip if re is not an array
            $new[$i] = array(
                'TName' => $re['TName'],
                'employee' => $re['employee'],
                'product_name' => $re['product_name'],
                'quantity' => $re['Quantity'],
                'date' => $re['i_date'],  // Ensure this key is present
                'pqrate' => pqrate($re['PqId'], $re['pid']),
                'type' => 'issue'
            );
        }
        return $new;
    }
    
    public function combinedLedger($product_id) {
        // Get purchase records
        $purchase_records = $this->productLedgerDetail($product_id);
        
        // Get issue records
        $issue_records = $this->issueListByProduct(42,1, 0 ,10, $search="");
        
        // Combine records
        $combined_records = array_merge($purchase_records, $issue_records);
        
        //Sort records by date
        usort($combined_records, function($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });
        
        //dd($combined_records);
        $arr=[];
        foreach($combined_records as $c=> $record){
            if(isset($record['TName'])){
                $arr[$c]['TName'] = $record['TName'];
                $arr[$c]['employee'] = $record['employee'];
                $arr[$c]['product_name'] = $record['product_name'];
                $arr[$c]['quantity'] = $record['quantity'];
                $arr[$c]['date'] = $record['date'];
                $arr[$c]['pqrate'] = $record['pqrate']; 
                $arr[$c]['type'] =$record['type'];
            }else{
                $arr[$c]['purchase_detail_id'] = $record['purchase_detail_id'];
                $arr[$c]['purchased_quantity'] = $record['purchased_quantity'];
                $arr[$c]['supplier_name'] = $record['supplier_name'];
                $arr[$c]['rate'] = $record['rate'];
                $arr[$c]['amount'] = $record['amount'];
                $arr[$c]['type'] ='purchase';
            }
        }
        dd($arr);
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
