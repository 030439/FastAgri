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
        if($this->db->insert('issuelabour', $record)){
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
