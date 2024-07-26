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
    public function tunnelStatus($id){
        $this->db->select('status');
        $this->db->from('tunnels');
        $this->db->where('id', $id);
        $tunnel = $this->db->get()->result();
        
        if($tunnel[0]->status==1){
            $st=0;
        }
        else{
            $st=1;
        }
        $this->db->where('id', $id);
        return  $this->db->update('tunnels', ['status'=>$st]);
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
           
        $this->db->insert('tunnels', $res);
        $sid =$this->db->insert_id();
        $Qt=[
            'tunnel'  => $sid,
            'pro'    => 1,
            'BCQ'  => 0
          ];
        $this->db->insert('production_stock', $Qt);
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
        $this->db->limit($length, $start);
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function getActiveShareHolders(){
        $this->db->select('*');
        $this->db->from('shareholders');
        $this->db->where('status', 1);
        return  $this->db->get()->result();
    }
    public function tunnelSummary() {
        // Fetch active tunnels
        $this->db->select('*');
        $this->db->from('tunnels');
        $this->db->where('status', 1);
        $tunnels = $this->db->get()->result();
    
        $arr = array();
        $shares = array();
        $name = [];
        $acer = [];
        $expense = [];
        $profit = [];
        $net = [];
    
        // Get active shareholders
        $shareholders = $this->getActiveShareHolders();
        $shareholders_dict = [];
        $shareholders_ids=[];
        $shareholders_name=[];
        foreach ($shareholders as $shareholder) {
            $shareholders_ids[]=$shareholder->id;
            $shareholders_name[]=$shareholder->Name;
            $shareholders_dict[$shareholder->id] = $shareholder;
        }
    
        foreach ($tunnels as $n => $tunnel) {
            $name[$n] = $tunnel->TName;
            $acer[$n] = $tunnel->CoveredArea;
            $expense[$n] = $this->tunnelExpenses($tunnel->id);
            $profit[$n] = $this->tunnleProfitSummary($tunnel->id);
    
            // Calculate net profit for the tunnel
            $net_value = $profit[$n] - $expense[$n];
            $net[$n] = $net_value;
    
            $sholders = $this->shareByTunnel($tunnel->id);
    
            $shares[$n] = ['shareholder' => []];
            foreach ($sholders['shareholders'] as $counter => $sholder_id) {
                if (isset($shareholders_dict[$sholder_id])) {
                    $share_percentage = $sholders['shares'][$counter];
                    $samount = ($share_percentage / 100) * $net_value; 
                    $shares[$n][$sholder_id] = $samount;
                } else {
                    $shares[$n][$sholder_id] = "---------";
                }
            }
        }
    
        $arr = [
            'tunnel'       => $name,
            'acer'         => $acer,
            'sale'         => $profit,
            'expense'      => $expense,
            'net'          => $net,
            'shares'       => $shares,
            'shareholders' =>$shareholders_ids,
            'snames'       =>$shareholders_name
        ];
        return $arr;
    }
    
    
    function shareByTunnel($tunnel){
        $this->db->select('*');
        $this->db->from('shares');
        $this->db->where('tunnel_id', $tunnel);
        $shares = $this->db->get()->result();
        $sh=array();
        $shareVal=array();
        foreach($shares as $s=> $share){
            $sh[]=$share->sh_id;
            $shareVal[]=$share->shares_values;
        }
        return [
            'shareholders'   => $sh,
            'shares'         => $shareVal
        ];
    }
    function tunnelExpenses($id){
        $query = $this->db->query("
        SELECT 
            e.`amount`
        FROM 
        `tunnel_expense` AS e
        JOIN 
        `tunnels` AS t ON t.`id` = e.`tunnel_id`
        WHERE t.`id` ='{$id}'
        ");
        $totals=$query->result();
        $amount=0;
        if($totals){
            foreach($totals as $total){
                $amount+=$total->amount;
            }
        }
        return $amount;
    }
    public function tunnleProfitSummary($id){
        $query = $this->db->query("
        SELECT 
        s.`id` AS sid,
        sd.`NetAmount`
        FROM 
        `sells` AS s
        JOIN 
        `customers` AS c ON c.`id` = s.`customer`
        JOIN 
        `selldetails` AS sd ON sd.`SellId` = s.`id`
        JOIN 
        `tunnels` AS t ON t.`id` = sd.`tunnel`
        JOIN 
        `grades` AS g ON g.`id` = sd.`GradeId`
        WHERE t.`id` =$id");
        $result = $query->result_array(); 
        $total=0;
        if($result){
            $amounts= explode(',',$result[0]['NetAmount']);
            foreach($amounts as $a=>$amount){
                $total+=$amount;
            }
        }
        return $total;
    }
    public function tunnelJsList($draw, $start, $length,$search=""){
        $this->db->where('status', 1);
        $totalRecords = $this->db->count_all_results('tunnels');

        $this->db->select('tunnels.id,tunnels.status,tunnels.TName,tunnels.CoveredArea,tunnels.cDate,
        crops.FasalName as product,crops.SeedQuality as grade');
        $this->db->from('tunnels');
        $this->db->join('crops', 'tunnels.product__id = crops.pid', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('tunnels.TName', $search);
            $this->db->or_like('tunnels.CoveredArea', $search);
            $this->db->or_like('crops.FasalName', $search);
            $this->db->or_like('crops.SeedQuality', $search);
            $this->db->group_end();
        }

        $data = $this->db->get()->result();
        $tunnels = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $data
        );
        return $tunnels; 
    }

    public function tunnelProduct($tunnel){
        $this->db->select('tunnels.id,crops.pid as pid,
        crops.FasalName as product');
        $this->db->from('tunnels');
        $this->db->join('crops', 'tunnels.product__id = crops.pid', 'left');
        $this->db->where('tunnels.status', 1);
        $this->db->where('tunnels.id', $tunnel);
        $stocks = $this->db->get()->result();
        return $stocks[0]; 
    }
    public function getCropId($fasal){
        $this->db->select('crops.id');
        $this->db->from('crops');
        $this->db->where('FasalName', $fasal);
        $stocks = $this->db->get()->result();
        return $stocks[0]->id; 
    }

    public function getunnelsExpenseList($id,$startDate, $endDate,$draw, $start, $length, $search = '') {
        // Get total records count
        $this->db->from('tunnel_expense AS e');
        $this->db->join('tunnels AS t', 't.id = e.tunnel_id');
        $this->db->where('t.id', $id);
        $totalRecords = $this->db->count_all_results();
        
        // Construct the base query with joins
        $this->db->select('
            e.id,
            e.expense_type,
            e.eid,
            e.amount,
            e.pid,
            e.edate,
            t.TName as tunnel,
            t.id as tid
        ');
        $this->db->from('tunnel_expense e');
        $this->db->join('tunnels t', 't.id = e.tunnel_id');
        $this->db->where('t.id', $id);
    
        // Apply search filter if provided
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('e.expense_type', $search);
            $this->db->or_like('e.amount', $search);
            $this->db->or_like('e.edate', $search);
            $this->db->or_like('t.TName', $search);
            $this->db->group_end();
        }
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where('e.edate BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
        }
    
        // Apply ordering
        if (!empty($order)) {
            $column = $order[0]['column'];
            $dir = $order[0]['dir'];
            $columns = ['e.id', 'e.expense_type', 'e.amount', 'e.edate', 't.TName'];
            $this->db->order_by($columns[$column], $dir);
        } else {
            $this->db->order_by('e.id', 'ASC');
        }
    
        // Apply pagination
        $this->db->limit($length, $start);
        $query = $this->db->get();
        $res = $query->result_array();
    
        // Process each record for additional data
        foreach ($res as $c => $re) {
            if ($re['expense_type'] == "issueStockPurchase") {
                $pq = getIssueProQty($id, $re['pid']);
                $res[$c]['head'] = productName_($re['pid']);
                $res[$c]['qty'] = $pq['qty'];
                $res[$c]['rate'] = $re['amount'];
                $res[$c]['amount'] = $pq['qty'] * $re['amount'];
            } elseif ($re['expense_type'] == "Jamandari") {
                $pq = getIssueProQty($id, $re['pid'], $re['edate']);
                $res[$c]['head'] = jamandarName($re['pid']);
                $res[$c]['qty'] = 1;
                $res[$c]['rate'] = 0;
            } 
            elseif($re['expense_type'] == "EXP"){
                $res[$c]['head']   = $this->accountHeadName($re['pid']);
                $res[$c]['qty']    = 0;
                $res[$c]['rate']   = 0;
            }
            elseif($re['expense_type'] == "EMP"){
                $res[$c]['head']   = employeeName_($re['pid']);
                $res[$c]['qty']    = 0;
                $res[$c]['rate']   = 0;
            }
            elseif($re['expense_type'] == "ADV"){
                $res[$c]['head']   = employeeName_($re['pid']);
                $res[$c]['qty']    = 0;
                $res[$c]['rate']   = 0;
            }
            else {
                $lb = getLabourQty($id, $re['eid']);
                $res[$c]['head'] = $lb['jname'];
                $res[$c]['qty'] = $lb['qty'];
                $res[$c]['rate'] = $lb['rate'];
            }
        }
    
        // Prepare the final output
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($totalRecords),  // Update this if server-side filtering is applied
            "data" => $res
        );
    
        return $response;
    }
    public function getunnelsExpense($id){

        $query = $this->db->query("
        SELECT 
            e.`id`,
            e.`expense_type`,
            e.`eid`,
            e.`amount`,
            e.`pid`,
            e.`edate`,
            t.`TName` as tunnel,
            t.`id` as tid
        FROM 
        `tunnel_expense` AS e
        JOIN 
        `tunnels` AS t ON t.`id` = e.`tunnel_id`
        WHERE t.`id` =$id
        order by e.`id` desc
        ");
        $res= $query->result();
        foreach($res as $c => $re) {
            if ($re->expense_type == "issueStockPurchase"){
                $pq=getIssueProQty($id, $re->pid);
                $res[$c]->head   = productName_($re->pid);
                $res[$c]->qty    = $pq['qty'];
                $res[$c]->rate   = $re->amount;
                $res[$c]->amount = $pq['qty']*$re->amount;
            }
            elseif($re->expense_type == "Jamandari"){
                $pq=getIssueProQty($id, $re->pid, $re->edate);
                $res[$c]->head   = jamandarName($re->pid);
                $res[$c]->qty    = 1;
                $res[$c]->rate   = 0;
            }
            elseif($re->expense_type == "EXP"){
                $pq=getIssueProQty($id, $re->pid, $re->edate);
                $res[$c]->head   = $this->accountHeadName($re->pid);
                $res[$c]->qty    = 0;
                $res[$c]->rate   = 0;
            }
            elseif($re->expense_type == "EMP"){
                $pq=getIssueProQty($id, $re->pid, $re->edate);
                $res[$c]->head   = employeeName_($re->pid);
                $res[$c]->qty    = 0;
                $res[$c]->rate   = 0;
            }
            elseif($re->expense_type == "ADV"){
                $pq=getIssueProQty($id, $re->pid, $re->edate);
                $res[$c]->head   = employeeName_($re->pid);
                $res[$c]->qty    = 0;
                $res[$c]->rate   = 0;
            }
            else{
                $lb=getLabourQty($id,$re->eid);
                $res[$c]->head = $lb['jname'];
                $res[$c]->qty =$lb['qty'];
                $res[$c]->rate =$lb['rate'];
                
            }
        }
        return $res;
    }
    public function accountHeadName($id){
        $this->db->select('Name');
        $this->db->from('account_head');
        $this->db->WHERE('id', $id);
        $shareholder = $this->db->get()->result();
        return $shareholder[0]->Name;
    }
    public function tunnleProfit($id){
        $query = $this->db->query("
        SELECT 
        s.`id` AS sid,
        s.`selldate`,
        s.`total_amount`,
        s.`labour`,
        s.`freight`,
        s.`expences`,
        sd.`id` as sdID,
       
        sd.`Quantity`,
        sd.`Rate`,
        sd.`amount`,
        c.`Name` as customer,
        t.`id` as tid,
        t.`TName` as tunnel
        FROM 
        `sells` AS s
        JOIN 
        `customers` AS c ON c.`id` = s.`customer`
        JOIN 
        `selldetails` AS sd ON sd.`SellId` = s.`id`
        JOIN 
        `tunnels` AS t ON t.`id` = sd.`tunnel`
        WHERE t.`id` =$id");
        $result = $query->result_array(); 
        // dd($result);
        $newData = [];

        foreach ($result as $record) {
            // Split comma-separated values
            $quantities = explode(',', $record['Quantity']);
            $rates = explode(',', $record['Rate']);
            $amounts = explode(',', $record['amount']);
            
            // Determine the maximum length to iterate through
            $maxLength = max(count($quantities), count($rates), count($amounts));
            
            for ($i = 0; $i < $maxLength; $i++) {
                $newRecord = $record;
                $newRecord['Quantity'] = $quantities[$i] ?? $quantities[0];
                $newRecord['Rate'] = $rates[$i] ?? $rates[0];
                $newRecord['amount'] = $amounts[$i] ?? $amounts[0];
                $newData[] = $newRecord;
            }
        }


        return $newData;
        return $result;
    }
    public function getunnelsProfitList($id,$startDate, $endDate,$draw, $start, $length, $searchTerm){
        $totalRecords = $this->db->query("SELECT COUNT(*) as count FROM `selldetails` WHERE `tunnel`=$id")->row()->count;
        $sql = "
        SELECT 
        s.`id` AS sid,
        s.`selldate`,
        s.`total_amount`,
        s.`labour`,
        s.`freight`,
        s.`expences`,
        sd.`id` AS sdID,
        g.`Name` AS grade,
        sd.`Quantity`,
        sd.`Rate`,
        sd.`NetAmount`,
        sd.`Freight` AS fre,
        sd.`commission`,
        sd.`Labour`,
        sd.`amount`,
        c.`Name` AS customer,
        t.`id` AS tid,
        sd.`GradeId`,
        t.`TName` AS tunnel
        FROM 
        `sells` AS s
        JOIN 
        `customers` AS c ON c.`id` = s.`customer`
        JOIN 
        `selldetails` AS sd ON sd.`SellId` = s.`id`
        JOIN 
        `tunnels` AS t ON t.`id` = sd.`tunnel`
        JOIN 
        `grades` AS g ON g.`id` = sd.`GradeId`";
        // if (!empty($search)) {
        //     $this->db->group_start();
        //     $this->db->like('e.expense_type', $search);
        //     $this->db->or_like('e.amount', $search);
        //     $this->db->or_like('e.edate', $search);
        //     $this->db->or_like('t.TName', $search);
        //     $this->db->group_end();
        // }
        $sql.="WHERE t.`id` = $id";
    if (!empty($startDate) && !empty($endDate)) {
        $sql.=' AND s.selldate BETWEEN "' . $startDate . '" AND "' . $endDate . '"';
    }
    if (!empty($searchTerm)) {
        $conditions[] = '(c.Name LIKE "%' . $searchTerm . '%" OR g.Name LIKE "%' . $searchTerm . '%" OR s.selldate LIKE "%' . $searchTerm . '%" OR sd.Quantity LIKE "%' . $searchTerm . '%")';
    }
    if (!empty($conditions)) {
        $sql .= ' AND ' . implode(' AND ', $conditions);
    }
    // Apply pagination
    $sql .= " LIMIT $start, $length";

    // Execute the query
    $query = $this->db->query($sql);
    
    $result = $query->result_array();
        $result = $query->result_array(); 
        $newData = [];

        foreach ($result as $record) {
            // Split comma-separated values
            $quantities = explode(',', $record['Quantity']);
            $rates = explode(',', $record['Rate']);
            $amounts = explode(',', $record['amount']);
            $GradeId = explode(',', $record['GradeId']);
            $NetAmount = explode(',', $record['NetAmount']);
 $fre = explode(',', $record['fre']);
$commission = explode(',', $record['commission']);
$Labour = explode(',', $record['Labour']);
            
            // Determine the maximum length to iterate through
            $maxLength = max(count($quantities), count($rates), count($amounts));
            
            for ($i = 0; $i < $maxLength; $i++) {
                $newRecord = $record;
                $newRecord['Quantity'] = $quantities[$i] ?? $quantities[0];
                $newRecord['Rate'] = $rates[$i] ?? $rates[0];
               // $newRecord['NetAmount'] = $NetAmount[$i] ?? $NetAmount[0];
$newRecord['Labour'] = number_format($Labour[$i] ?? $Labour[0]*$newRecord['Quantity'],2);
$newRecord['commission'] = number_format($commission[$i] ?? $commission[0]*$newRecord['Quantity'],2);
$newRecord['fre'] = number_format($Freight[$i] ?? $fre[0]*$newRecord['Quantity'],2);
                $newRecord['amount'] = $amounts[$i] ?? $amounts[0];
 $newRecord['NetAmount']= number_format($newRecord['amount']- $newRecord['Labour']-$newRecord['commission']-$newRecord['fre'],2);
                $grade=$GradeId[$i] ?? $GradeId[0];
                if($grade==1){
                    $newRecord['GradeId'] = "A";
                }
                else{
                    $newRecord['GradeId'] = "B";
                }
                $newData[] = $newRecord;
            }
        }
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => count($newData),
            "recordsFiltered" => count($newData),  // Update this if server-side filtering is applied
            "data" => $newData
        );
        return $response;
    }
    public function tunnelLedger($id,$draw,$startDate, $endDate, $start, $length, $search = '')
    {
        $total_query = $this->db->query("SELECT COUNT(*) as total FROM (
            SELECT e.id FROM tunnel_expense e WHERE e.tunnel_id = ?
            UNION ALL
            SELECT s.id FROM selldetails s WHERE s.tunnel = ?
        ) AS total_records", array($id, $id));
        $total_records = $total_query->row()->total;

        $Q="
            SELECT
            eid_,
            expense_type,
            eamount,
            epid,
            edate,
            ecreated
            sid,
            sid_,
            selldate,
            total_amount,
            labour,
            freight,
            expences,
            sdID,
            grade,
            Quantity,
            Rate,
            NetAmount,
            amount,
            customer,
            GradeId
        FROM
            (
            SELECT
                e.`eid` as eid_,
                e.`expense_type`,
                e.`amount` AS eamount,
                e.`pid` AS epid,
                e.`edate`,
                e.`created_at` AS ecreated,
                NULL AS sid,
                NULL AS sid_,
                NULL AS selldate,
                NULL AS total_amount,
                NULL AS labour,
                NULL AS freight,
                NULL AS expences,
                NULL AS sdID,
                NULL AS grade,
                NULL AS Quantity,
                NULL AS Rate,
                NULL AS NetAmount,
                NULL AS amount,
                NULL AS customer,
                NULL AS GradeId
            FROM
                `tunnel_expense` AS e
            JOIN `tunnels` AS t
            ON
                t.`id` = e.`tunnel_id`
            WHERE
                t.`id` = $id
            UNION ALL
        SELECT NULL AS
            expense_type,
            NULL AS eid_,
            NULL AS eamount,
            NULL AS epid,
            NULL AS edate,
            NULL AS created_at,
            s.`id` AS sid,
            sd.`SellId` AS sid_,
            s.`selldate`,
            s.`total_amount`,
            s.`labour`,
            s.`freight`,
            s.`expences`,
            sd.`id` AS sdID,
            g.`Name` AS grade,
            sd.`Quantity`,
            sd.`Rate`,
            sd.`NetAmount`,
            sd.`amount`,
            c.`Name` AS customer,
            sd.`GradeId`
        FROM
            `sells` AS s
        JOIN `customers` AS c
        ON
            c.`id` = s.`customer`
        JOIN `selldetails` AS sd
        ON
            sd.`SellId` = s.`id`
        JOIN `tunnels` AS t
        ON
            t.`id` = sd.`tunnel`
        JOIN `grades` AS g
        ON
            g.`id` = sd.`GradeId`";
        $Q.="
        WHERE
            t.`id` = $id
        ) AS combined_data";
         
        if (!empty($startDate) && !empty($endDate)) {
            $Q.='AND s.edate BETWEEN "' . $startDate . '" AND "' . $endDate . '"';
        }
         $Q.="
        ORDER BY
            edate,
            ecreated ASC
        ";
        $Q .= " LIMIT $start, $length";
        $query = $this->db->query($Q);
        $result = $query->result_array();
        $newData = [];
        foreach ($result as $c => $re) {
            if($re['eid_']){
                $result[$c]['entry_id'] = $re['eid_'];
                $result[$c]['type']=$re['expense_type'];
                $result[$c]['entryDate'] = $re['edate'];
                if ($re['expense_type'] == "issueStockPurchase") {
                    $pq = getIssueProQty($id, $re['epid']);
                    $result[$c]['head'] = productName_($re['epid']);
                    $result[$c]['qty_'] = $pq['qty'];
                    $result[$c]['rate_'] = $re['eamount'];
                    $result[$c]['amount'] = $pq['qty'] * $re['eamount'];
                } elseif ($re['expense_type'] == "Jamandari") {
                    $pq = getIssueProQty($id, $re['epid'], $re['edate']);
                    $result[$c]['head'] = jamandarName($re['epid']);
                    $result[$c]['qty_'] = 1;
                    $result[$c]['rate_'] = 0;
                    $result[$c]['amount'] = $re['eamount'];
                }
                elseif($re['expense_type'] == "EXP"){
                    $result[$c]['head']   = $this->accountHeadName($re['epid']);
                    $result[$c]['qty_']    = 0;
                    $result[$c]['rate_']   = 0;
                    $result[$c]['amount'] = $re['eamount'];
                }
                 else {
                    $lb = getLabourQty($id, $re['eid_']);
                    $result[$c]['head'] = $lb['jname'];
                    $result[$c]['qty_'] = $lb['qty'];
                    $result[$c]['rate_'] = $lb['rate'];
                    $result[$c]['amount'] = $re['eamount'];
                }
            }
            else
            {
                $result[$c]['type']='Sell';
                $result[$c]['entryDate'] = $re['selldate'];
                $result[$c]['entry_id'] = $re['sid_'];
                $result[$c]['head']=$re['customer'];
                $quantities = explode(',', $re['Quantity']);
                $rates = explode(',', $re['Rate']);
                $amounts = explode(',', $re['amount']);
                $GradeId = explode(',', $re['GradeId']);
                $NetAmount = explode(',', $re['NetAmount']);
                
                // Determine the maximum length to iterate through
                $maxLength = max(count($quantities), count($rates), count($amounts));
                
                for ($i = 0; $i < $maxLength; $i++) {
                    $newRecord = $re;
                    $result[$c]['qty_'] = $quantities[$i] ?? $quantities[0];
                    $result[$c]['rate_'] = $rates[$i] ?? $rates[0];
                    $result[$c]['NetAmount'] = $NetAmount[$i] ?? $NetAmount[0];
                    $result[$c]['amount'] = $amounts[$i] ?? $amounts[0];
                    $grade=$GradeId[$i] ?? $GradeId[0];
                    if($grade==1){
                        $result[$c]['GradeId'] = "A";
                    }
                    else{
                        $result[$c]['GradeId'] = "B";
                    }
                    $newData[] = $newRecord;
                }
            }
        }
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => $total_records,
            "recordsFiltered" => $total_records,  // Adjust if necessary based on search
            "data" => $result
        );
        return $response;
    
    }

}
