<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_user_by_email($email,$pass) {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $email);
        $this->db->where('Password', $pass);
        return  $this->db->get()->result();
        
        return $this->db->get_where('users', ['username' => $email])->row();
    }
}
