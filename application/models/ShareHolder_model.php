<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareHolder_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function getshareholders() {
        $this->db->where('status', 1);
        $shareholders = $this->db->get('shareholders')->result();
        return $shareholders;
    }
    public function getshareholdersListing($draw, $start, $length) {
        $this->db->where('status', 1);
        $totalRecords = $this->db->count_all_results('shareholders');
    
        $this->db->select('*');
        $this->db->from('shareholders');
        $this->db->order_by('id', 'desc');
        $this->db->limit($length, $start);
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
    
    public function detail($id){
        $this->db->select('sp.id, s.Name, c.narration, sp.balance as fb, sp.amount, sp.pay_type, sp.created');
        $this->db->from('shareholders s');
        $this->db->join('cash_in_out c', 'c.cash_sP = s.id', 'left');
        $this->db->join('shareholders_pays sp', 'sp.sid = s.id', 'right');
        $this->db->where('s.id', $id); // Assuming $id is a valid shareholder ID
        $this->db->where('c.case_sT', 'shareholder');
        $this->db->group_by('sp.created');

        $res =$this->db->get()->result();
        return $res;
    }

    public function createShareholder($data) {
        return $this->db->insert('shareholders', $data);
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
}
