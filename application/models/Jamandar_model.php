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
    
    public  function jamandari($jid){
        $date=date("Y-m-d");
        $this->db->select('amount');
        $this->db->where('jid', $jid);
        $this->db->where('date_', $date);
        $query = $this->db->get('jamandari');
        $result=$query->result();
        if($result){
            return true;
        }else{
            return false;
        }
    }
    public  function jamandariAmount(){
        $this->db->select('amount');
        $query = $this->db->get('jamandari_fee');
        $result=$query->result();
        return $result[0]->amount;
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
                'amount'=>$data['amount'],
                'edate'=>$data['date_'],
                'pid'=>$data['jid']
            ];
            $this->db->insert('tunnel_expense', $expense);
        }
         return ;
    }
    public function issuelabour($data){
        $rate=$this->getRate();
        $labor=$data['labour'];
        $j=$data['jamandar'];
        $rate=$rate[0]->amount;
        $total_amount=$rate*$labor;
        $record=[
            'tunnel'=>$data['tunnel'],
            'jamandar'=>$j,
            'lq'=>$labor,
            'rate'=>$rate,
            'total_amount'=>$total_amount
        ];
        $idate=date("Y-m-d");
        if($this->db->insert('issuelabour', $record)){
            $insert_id = $this->db->insert_id();
            $expense=[
                'tunnel_id'=>$data['tunnel'],
                'expense_type'=>"Labour",
                'eid'=>$insert_id,
                'amount'=>$total_amount,
                'edate'=>$idate,
                'pid'=>0
            ];
             $this->db->insert('tunnel_expense', $expense);
            $this->db->select('payable');
            $this->db->where('jamandar_id', $j);
            $query = $this->db->get('jamandartotal');
            $result=$query->result();
            $last=$result[0]->payable;
            $amount=$last+$total_amount;
            $out=$this->jamandari($data['jamandar']);
            if(!$out){
                $jamount=$this->jamandariAmount();
                $jarr=[
                    'jid'=>$j,
                    'amount'=>$jamount,
                    'date_'=>$idate
                ];
                $this->addJamandari($jarr);
                $amount+=$jamount;
            }
            $sql = "UPDATE jamandartotal SET payable = ? WHERE jamandar_id = ?";
            return $this->db->query($sql, array($amount, $j));
        }
        else{
           return false;
        }
        
     
    }
}
