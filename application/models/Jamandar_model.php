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
                'edate'=>$idate
            ];
             $this->db->insert('tunnel_expense', $expense);

            $this->db->select('payable');
            $this->db->where('jamandar_id', $j);
            $query = $this->db->get('jamandartotal');
            $result=$query->result();
            $last=$result[0]->payable;
            $amount=$last+$total_amount;
            $sql = "UPDATE jamandartotal SET payable = ? WHERE jamandar_id = ?";
            return $this->db->query($sql, array($amount, $j));
        }
        else{
           return false;
        }
        
     
    }
}
