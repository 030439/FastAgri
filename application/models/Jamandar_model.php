<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jamandar_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }

    public function saveJamandar($data) {
        if($jamandar =$this->db->insert('jamandars', $data)){
            $id =$this->db->insert_id();
            $jrecord=[
                'jamandar_id'=>$id,
                'payable'=>0,
                'advance'=>0,
                'remaing'=>0
            ];
           return $this->db->insert('jamandartotal', $jrecord);
        }
        return false;
    }
    public function updateJamandar($id,$data) {
        $this->db->where('id', $id);
        return $this->db->update('jamandars', $data);
    }
    public function getAll(){
        $query = $this->db->query("
        SELECT 
            j.`id`,
            j.`name`,
            j.`address`,
            j.`contact`,
            j.`cnic`,
            jt.`payable`,
            jt.`advance`,
            jt.`remaing`
        FROM 
        `jamandars` AS j
        JOIN 
        `jamandartotal` AS jt ON j.`id` = jt.`jamandar_id`
        ");
        $result = $query->result();
        return $result; 
    }
    public function labourList(){
        $query = $this->db->query("
        SELECT 
            i.`id` AS issue_stock_id,
            i.`create_at`,
            i.`total_amount`,
            i.`rate`,
            i.`lq`,
            j.`name` AS jamander,
            t.`TName`
        FROM 
        `issuelabour` AS i
        JOIN 
        `jamandars` AS j ON i.`jamandar` = j.`id`
        JOIN 
        `tunnels` AS t ON i.`tunnel` = t.`id`
        ");
        $result = $query->result();
        return $result;
    }

    public function issuedLabourListing($draw, $start, $length){

        $totalRecords = $this->db->count_all_results('issuelabour');
        $query = $this->db->query("
        SELECT 
            i.`id` AS issue_stock_id,
            i.`ldate`,
            i.`total_amount`,
             i.`deduction`,
            i.`rate`,
            i.`lq`,
            j.`name` AS jamander,
            t.`TName`
        FROM 
        `issuelabour` AS i
        JOIN 
        `jamandars` AS j ON i.`jamandar` = j.`id`
        JOIN 
        `tunnels` AS t ON i.`tunnel` = t.`id`
         LIMIT $start, $length
        ");
        $result = $query->result_array();
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $result
        );
    
        return $response;
        return $result;
    }
    public function listing($draw,$start, $length,$search){
        $this->db->where('status', 1);
        $totalRecords = $this->db->count_all_results('jamandars');
        $this->db->select('jamandars.*,jt.`payable`,
            jt.`advance`,
            jt.`remaing`');
        $this->db->from('jamandars');
        $this->db->join('jamandartotal jt', 'jt.jamandar_id = jamandars.id', 'left');
        $this->db->order_by('jamandars.id', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
    
        $shareholders = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $data
        );
    
        return $shareholders;
    }
    public function issuedJamandarLabour($id,$draw,$start, $length,$search){
        $this->db->where('jamandar', $id);
        $totalRecords_1 = $this->db->count_all_results('issuelabour');
        $query = $this->db->query("
        SELECT *
        FROM 
        `cash_in_out` AS c WHERE
        `c`.`case_sT` = 'jamandari'
         Or
        `c`.`case_sT` = 'jamandariAdvance'
         AND 
        `c`.`cash_sP` = $id
        ");
        $resultC = $query->result_array();
        $totalRecords_2=count($resultC);
        $totalRecords=$totalRecords_1+$totalRecords_2;
        $query = $this->db->query("
       WITH RunningBalance AS (
    SELECT
        issue_stock_id,
        create_at,
        total_amount,
        rate,
        lq,
        jamander,
        TName,
        deduction,
        jamandari,
        jdate,
        pay_id,
        type,
        amount_,
        cdate,
        creater,
        @running_balance := @running_balance + (
            IFNULL(total_amount, 0) - IFNULL(amount_, 0) + IFNULL(jamandari, 0)
        ) AS running_balance
    FROM
        (
            SELECT
                i.`id` AS issue_stock_id,
                i.`ldate` as create_at,
                i.`total_amount`,
                i.`rate`,
                i.`lq`,
                j.`name` AS jamander,
                t.`TName`,
                i.`deduction`,
                i.`create_at` AS creater,
                NULL AS jamandari,
                NULL AS jdate,
                NULL AS pay_id,
                NULL AS type,
                NULL AS amount_,
                NULL AS cdate
            FROM 
                `issuelabour` AS i
            JOIN 
                `jamandars` AS j ON i.`jamandar` = j.`id`
            JOIN 
                `tunnels` AS t ON i.`tunnel` = t.`id`
            WHERE 
                j.id = $id
            
            UNION ALL
            
            SELECT
                NULL AS issue_stock_id,
                NULL AS create_at,
                NULL AS total_amount,
                NULL AS rate,
                NULL AS lq,
                NULL AS jamander,
                NULL AS TName,
                NULL AS deduction,
                ja.create_at AS creater,
                ja.amount AS jamandari,
                ja.date_ AS jdate,
                NULL AS pay_id,
                NULL AS type,
                NULL AS amount_,
                NULL AS cdate
            FROM 
                `jamandari` AS ja
            WHERE 
                ja.jid = $id
            
            UNION ALL
            
            SELECT 
                NULL AS issue_stock_id,
                NULL AS create_at,
                NULL AS total_amount,
                NULL AS rate,
                NULL AS lq,
                NULL AS jamander,
                NULL AS TName,
                NULL AS deduction,
                c.`created_at`  AS creater,
                NULL AS jamandari,
                NULL AS jdate,
                c.id AS pay_id,
                c.case_sT AS type,
                c.amount AS amount_,
                c.cdate AS cdate
            FROM
                `cash_in_out` `c`
            WHERE
                (`c`.`case_sT` = 'jamandari' OR `c`.`case_sT` = 'jamandariAdvance')
                AND `c`.`cash_sP` = $id
        ) AS combined_data,
        (SELECT @running_balance := 0) AS rb
    ORDER BY
        creater ASC
)
SELECT *
FROM RunningBalance
ORDER BY creater DESC
LIMIT $start, $length;

        ");
        $result = $query->result_array();
        foreach($result as $c=>$res){
            if(!empty($res['issue_stock_id'])){
                $result[$c]['date_']=getOnlyDate($res['create_at']);
            }elseif(empty($res['issue_stock_id']) && !empty($res['jamandari']) ){
                $result[$c]['date_']=getOnlyDate($res['jdate']);
                $result[$c]['TName']="Jamandari";
                $result[$c]['total_amount']=$res['jamandari'];
            }
            elseif(!empty($res['pay_id'])){
                $result[$c]['date_']=getOnlyDate($res['cdate']);
                $result[$c]['TName']=$res['type'];
            }
            else{
                $result[$c]['date_']=getOnlyDate($res['cdate']);
            }
        }
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $result
        );
        return $response;
    }
    public function labourListByJamandar($id){
        $query = $this->db->query("
        SELECT 
            i.`id` AS issue_stock_id,
            i.`create_at`,
            i.`total_amount`,
            i.`rate`,
            i.`lq`,
            j.`name` AS jamander,
            t.`TName`
        FROM 
        `issuelabour` AS i
        JOIN 
        `jamandars` AS j ON i.`jamandar` = j.`id`
        JOIN 
        `tunnels` AS t ON i.`tunnel` = t.`id`
        WHERE j.id=$id
        ");
        $result = $query->result();
        return $result;
    }

    public function getRate(){
        $rate = $this->db->get('labourrate')->result();
        return $rate;
    }
    public function updateRate($data){
        $rate = $this->db->get('labourrate')->result();
        $amount=$data['rate'];
        $last=$rate[0]->amount;
        $sql = "UPDATE labourrate SET amount = ? ,last_amount= ?";
        return $this->db->query($sql, array($amount, $last));

    }
    public function jamandarAdvanceAdd($data) {
        $arr=[
            'jid'          => $data['employee_id'],
            'amount'       => $data['amount'],
            'installment'  => $data['installment'],
            'date_'        => $data['date_'],
        ];
        if($this->db->insert('jamandar_loan', $arr)){
            $employee = $this->db->get_where('jamandartotal', ['jamandar_id' => $data['employee_id']])->row();
            $loan=$employee->advance;
            $loan+=$data['amount'];
            $loan=[
                'advance'=>$loan,
            ];
            $this->db->where('jamandar_id', $data['employee_id']);
            return $this->db->update('jamandartotal', $loan);
        }
    }

    public function getLoans(){
        $this->db->select('
        jamandar_loan.id as jlid, jamandar_loan.amount as taken, jamandar_loan.date_ as tdate, jamandars.name as jname
       ');
        $this->db->from('jamandar_loan');
        $this->db->join('jamandars', 'jamandars.id = jamandar_loan.jid', 'left');
        $stocks = $this->db->get()->result();
        return $stocks;
    }
    
    public function jamandarsLoanListing($draw,$start, $length,$search){
        $totalRecords = $this->db->count_all_results('jamandar_loan');

        $this->db->select('
        jamandar_loan.id as jlid, jamandar_loan.amount as amount, jamandar_loan.installment as installment, jamandar_loan.date_ as date_, jamandars.name as name
       ');
        $this->db->from('jamandar_loan');
        $this->db->join('jamandars', 'jamandars.id = jamandar_loan.jid', 'left');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('jamandar_loan.amount', $search);
            $this->db->or_like('jamandar_loan.installment', $search);
            $this->db->or_like('jamandar_loan.date_', $search);
            $this->db->or_like('jamandars.name', $search);
            $this->db->group_end();
        }
        $this->db->limit($length, $start);
        $this->db->order_by('jamandar_loan.id', 'desc');
        $stocks = $this->db->get()->result();
        $response = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $stocks
        );
        return $response;
    }


    function getJmanadarsReports(){
    // Calculate the current week's Friday and Thursday dates
        $today = new DateTime();
        $today->modify('this week'); // Start of current week
        $friday = $today->modify('next friday')->format('Y-m-d');
        $thursday = $today->modify('next thursday')->format('Y-m-d');
        // Fetch data from the database for the current week (Friday to Thursday)
        $this->db->select('issuelabour.*,jamandars.name as jname,jamandartotal.advance as advance');
        $this->db->from('issuelabour');
        $this->db->join('jamandars', 'issuelabour.jamandar = jamandars.id', 'left');
        $this->db->join('jamandartotal', 'jamandartotal.jamandar_id = jamandars.id', 'left');
        $this->db->where('issuelabour.create_at >=', $friday);
        $this->db->where('issuelabour.create_at <=', $thursday);
        $this->db->order_by('issuelabour.jamandar', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result(); // Return the fetched data
        } else {
            return null; // No data found for the current week
        }

    }
    
    public  function jamandari($jid,$ldate){
        $this->db->select('amount');
        $this->db->where('jid', $jid);
        $this->db->where('date_', $ldate);
        $query = $this->db->get('jamandari');
        $result=$query->result();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public  function jamandariAmount($id){
        $this->db->select('jamandari');
        $this->db->from(' jamandars');
       $this->db->where('id', $id);
        $result=$this->db->get()->result();
        return $result[0]->jamandari;
    }
    public  function getJamandarById($id){
        $this->db->select(' *');
        $this->db->from(' jamandars');
        $this->db->WHERE('id', $id);
        $result = $this->db->get()->result();
        return $result[0];
    }
    public function getJamandariById($id) {
        $this->db->select(' jamandartotal.payable');
        $this->db->from(' jamandartotal');
        $this->db->WHERE('jamandar_id', $id);
        $products = $this->db->get()->result();
        return $products[0]->payable;
    }
     public function getIssuedLabour($id) {
        $this->db->select('*');
        $this->db->from(' issuelabour');
        $this->db->WHERE('id', $id);
        $products = $this->db->get()->result();
        return $products[0];
    }
    public function jamandarAmountByIssuedLabourId($id){
        $this->db->select('total_amount,jamandar');
        $this->db->from(' issuelabour');
        $this->db->WHERE('id', $id);
        $products = $this->db->get()->result();
        return $products[0];
    }
    public function addJamandari($data){

        $this->db->insert('jamandari', $data);
        $insert_id=$this->db->insert_id();
        $this->db->select('id');
        $this->db->where('status',1);
        $query = $this->db->get('tunnels');
        $result=$query->result();
        $total=count($result);
        $per_tunnel_exp=$data['amount']/$total;
        foreach($result as $res){
            $expense=[
                'tunnel_id'=>$res->id,
                'expense_type'=>"Jamandari",
                'eid'=>$insert_id,
                'amount'=>$per_tunnel_exp,
                'edate'=>$data['date_'],
                'pid'=>$data['jid']
            ];
            $this->db->insert('tunnel_expense', $expense);
        }
         return ;
    }
    public function issuelabour($data){
        
       
        $counter=count($data['tunnel']);
     
        for($C=0;$C<$counter;$C++){
            $deduction_=$data['deduction'][$C]?$data['deduction'][$C]:0;
            $rate=$this->getRate();
            $labor=$data['labour'][$C];
            $j=$data['jamandar'];
            $ldate=$data['ldate'];
            $deduction=$deduction_;
            $rate=$rate[0]->amount;
            $total_amount=$rate*$labor-$deduction;
            $record=[
                'tunnel'=>$data['tunnel'][$C],
                'jamandar'=>$j,
                'lq'=>$labor,
                'rate'=>$rate,
                'ldate'=>$ldate,
                'deduction'=>$deduction,
                'total_amount'=>$total_amount
            ];
            $idate=date("Y-m-d");
            $ok=false;
            if($this->db->insert('issuelabour', $record)){
                $insert_id = $this->db->insert_id();
                $expense=[
                    'tunnel_id'=>$data['tunnel'][$C],
                    'expense_type'=>"Labour",
                    'eid'=>$insert_id,
                    'amount'=>$total_amount,
                    'edate'=>$ldate,
                    'pid'=>0
                ];
                $this->db->insert('tunnel_expense', $expense);
                $this->db->select('payable');
                $this->db->where('jamandar_id', $j);
                $query = $this->db->get('jamandartotal');
                $result=$query->result();

                $last=$result[0]->payable?$result[0]->payable:$result->payable;
                $amount=$last+$total_amount;
                $out=$this->jamandari($data['jamandar'],$ldate);
                if(!$out){
                    $jamount=$this->jamandariAmount($data['jamandar']);
                    $jarr=[
                        'jid'=>$j,
                        'amount'=>$jamount,
                        'date_'=>$ldate
                    ];
                    $this->addJamandari($jarr);
                    $amount+=$jamount;
                }
                $sql = "UPDATE jamandartotal SET payable = ? WHERE jamandar_id = ?";
                 $this->db->query($sql, array($amount, $j));
                 $ok=true;
            }
            else{
            $ok= false;
            }
        }
        return $ok;
     
    }
    public function deductJamandarPay($j,$amount){
        $this->db->select('payable');
            $this->db->where('jamandar_id', $j);
            $query = $this->db->get('jamandartotal');
            $result=$query->result();
            $last=$result[0]->payable;
            $amount=$last-$amount;
            $sql = "UPDATE jamandartotal SET payable = ? WHERE jamandar_id = ?";
            return $this->db->query($sql, array($amount, $j));
    }
    public function updateLabourIssue($id,$data){
        $rate=$this->getRate();
        $labor=$data['labour'];
        $j=$data['jamandar'];
        $deduction=$data['deduction'];
        $rate=$rate[0]->amount;
        $ldate=$data['ldate'];
        $total_amount=$rate*$labor-$deduction;
        $udate=date("y-m-d h i s");
        $first=$this->jamandarAmountByIssuedLabourId($id);
        
        $first_amount=$first->total_amount;
        $fjamnadar=$first->jamandar;

        $record=[
            'tunnel'=>$data['tunnel'],
            'jamandar'=>$j,
            'lq'=>$labor,
            'ldate'=>$ldate,
            'rate'=>$rate,
            'deduction'=>$deduction,
            'total_amount'=>$total_amount,
            'update_at'=>$udate
        ];
        $idate=date("Y-m-d");
        $this->db->trans_start();
        $this->deductJamandarPay($fjamnadar,$first_amount);

        $this->db->where('id', $id);
        $ok=$this->db->update('issuelabour', $record);
        // if($ok){
        //     dd($record);
        // }

        if($ok){
            $expense=[
                'tunnel_id'=>$data['tunnel'],
                'expense_type'=>"Labour",
                'eid'=>$id,
                'amount'=>$total_amount,
                'edate'=>$ldate,
                'pid'=>0
            ];
            
            $Labour=$this->db->delete('tunnel_expense', ['eid' => $id,'expense_type'=>'Labour','amount'=>$first_amount]);
            if($Labour){
                $this->db->insert('tunnel_expense', $expense);
            
                $this->db->select('payable');
                $this->db->where('jamandar_id', $j);
                $query = $this->db->get('jamandartotal');
                $result=$query->result();
                $last=$result[0]->payable;
                $amount=$last+$total_amount;
                $out=$this->jamandari($data['jamandar'],$ldate);
                if(!$out){
                    $jamount=$this->jamandariAmount($data['jamandar']);
                    $jarr=[
                        'jid'=>$j,
                        'amount'=>$jamount,
                        'date_'=>$ldate
                    ];
                    $this->addJamandari($jarr);
                    $amount+=$jamount;
                }
                $sql = "UPDATE jamandartotal SET payable = ? WHERE jamandar_id = ?";
                $this->db->query($sql, array($amount, $j));
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
}
