<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setup_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function createUnit($data)
    {
        return $this->db->insert('units', $data);
    }

    public function getunit()
    {
        $units = $this->db->order_by('id', 'desc')->get('units')->result();


        return $units;
    }
}
