<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jamandar_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function saveJamandar($data) {
        $jamandar =$this->db->insert('jamandars', $data);
        return $jamandar;
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
}
