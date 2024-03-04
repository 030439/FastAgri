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
