<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareHolder_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function getshareholders() {
        $shareholders = $this->db->get('shareholders')->result();
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
