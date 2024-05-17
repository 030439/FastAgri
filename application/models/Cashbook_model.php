<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashbook_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function addAccountHead($data){
        return $this->db->insert('account_head', $data);
    }
    public function cashbookList() {
        $cash = $this->db->get('cash_in_out')->result();
        foreach($cash as $c){
            echo "<pre>";
            print_r($c);
            if($c->cash_s=="cash-in"){
                if($c->case_sT=="customer"){
                    
                }
            }else{
            }
        }
        dd("SDF");
        dd($cash);
        return $cash;
    }
    public function getAccountHead() {
        $customers = $this->db->get('account_head')->result();
        return $customers;
    }
    public function getAll($table){
        $this->db->where('status', 1);
        $all = $this->db->get($table)->result();
        return $all;
    }
    public function getAllInArray($table){
        $this->db->where('status', 1);
        $all = $this->db->get($table)->result_array();
        return $all;
    }

    public function cashbookPay($data) {
        $arr=[
            'cash_s'  =>$data['cash-selection'],
            'case_sT'  =>$data['cash-selection-type'],
            'cash_sP'  =>$data['cash-selection-party'],
            'amount'  =>$data['amount'],
        ];
        $this->db->insert('cash_in_out', $arr);
        $this->db->trans_start();
        if($data['cash-selection']=='cash-in'){
            $this->debit($data);
            if($data['cash-selection-type']=='customer'){
                $this->customerCashIn($data);
            }
        }
        else{
            $this->credit($data);
            if($data['cash-selection-type']=='supplier'){
                $this->SupplierCashOut($data);
            }
            elseif($data['cash-selection-type']=="shareholder"){
                $this->shareHolderCashOut($data);
            }
            elseif($data['cash-selection-type']=="expense"){
                $this->Expense($data);
            }
        }
        $this->db->trans_complete(); // Complete Transaction
        
        if ($this->db->trans_status() === FALSE) {
            // Transaction failed, handle the error
            $this->db->trans_rollback(); // Roll back changes
            return false;
        } else {
            // Transaction succeeded
            $this->db->trans_commit(); // Commit changes
            return true;
        } 
    }

    public function customerCashIn($data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];

        $this->db->set('closing', 'closing - ' . $this->db->escape($amount), FALSE);
        $this->db->where('cid', $customerId);
        return $this->db->update('customer_detail');
    }
    public function SupplierCashOut($data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];

        $this->db->set('closing', 'closing - ' . $this->db->escape($amount), FALSE);
        $this->db->where('sid', $customerId);
        return $this->db->update('supplier_detail');
    }
    public function Expense($data){
        $arr=[
            'head'        => $data['cash-selection-party'],
            'narration'   => $data['narration'],
            'amount'     => $data['amount']
        ];
        return $this->db->insert('expenses', $arr);
    }
    public function debit($data){
        $amount = $data['amount'];
        $this->db->set('amount', 'amount + ' . $this->db->escape($amount), FALSE);
        return $this->db->update('availableamount');
    }
    public function credit($data){
        $amount = $data['amount'];
        $this->db->set('amount', 'amount - ' . $this->db->escape($amount), FALSE);
        return $this->db->update('availableamount');
    }
    public function shareHolderCashOut($data){
        $amount = $data['amount'];
        $sh = $data['cash-selection-party'];

        $this->db->set('balance', 'balance + ' . $this->db->escape($amount), FALSE);
        $this->db->where('id', $sh);
        return $this->db->update('shareholders');
    }

    public function updatecustomer($id, $data) {
      $this->db->where('id', $id);
       return  $this->db->update('customers', $data);
    }

    public function deletecustomer($id) {
        return $this->db->delete('customers', ['id' => $id]);
    }
    
}
