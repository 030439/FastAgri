<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function getProducts() {
        $this->db->select('products.*, units.Name as unit');
        $this->db->from('products');
        $this->db->join('units', 'products.unit_id = units.id', 'left');
        $products = $this->db->get()->result();

        return $products;
    }
    public function getStock(){
        $this->db->select('stocks.*, products.Name as product');
        $this->db->from('stocks');
        $this->db->join('products', 'stocks.pid = products.id', 'left');
        $stocks = $this->db->get()->result();
        return $stocks; 
    }
    public function getSeed(){
        $crops = $this->db->get('crops')->result();
        return $crops;
    }

    public function insertProduct($data) {
        return $this->db->insert('products', $data);
    }
    public function insertSeed($data) {
        $this->db->insert('products', $data);
        $insert_id = $this->db->insert_id();
        $cropArr=['pid'=>$insert_id,'FasalName'=>$data['Name']];
        return $this->db->insert('crops', $cropArr);
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
