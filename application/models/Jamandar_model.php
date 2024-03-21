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
}
