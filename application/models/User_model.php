<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
}
