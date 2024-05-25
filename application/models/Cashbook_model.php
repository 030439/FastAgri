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
        $this->db->select('c.*,a.amount as famount');
        $this->db->from('cash_in_out c');
        $this->db->join('availableamount a ', 'c.id = a.cash_id');
        $cash = $this->db->get()->result_array();
        foreach($cash as $c=>$d){
            if($d['cash_s']=="cash-in"){
                if($d['case_sT']=="customer"){
                    $cash[$c]['name']="Cash Received";
                    $cash[$c]['narration']=$this->customerName($d['cash_sP']);
                }
            }elseif($d['cash_s']=="cash-out"){
                if($d['case_sT']=="supplier"){
                    $cash[$c]['narration']=$this->SupplierName($d['cash_sP']);
                    $cash[$c]['name']=$d['narration'];
                }
                elseif ($d['case_sT']=="shareholder") {
                    $cash[$c]['narration']=$this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
                elseif ($d['case_sT']=="expense") {
                    $cash[$c]['name']=$this->accountHeadName($d['cash_sP']);
                }
            }
        }
        return $cash;
    }
    public function customerName($id){
        $this->db->select('Name');
        $this->db->from('customers');
        $this->db->WHERE('id', $id);
        $customer = $this->db->get()->result();
        return $customer[0]->Name;
    }
    public function SupplierName($id){
        $this->db->select('Name');
        $this->db->from('suppliers');
        $this->db->WHERE('id', $id);
        $supplier = $this->db->get()->result();
        return $supplier[0]->Name;
    }
    public function ShareHolderName($id){
        $this->db->select('Name');
        $this->db->from('shareholders');
        $this->db->WHERE('id', $id);
        $shareholder = $this->db->get()->result();
        return $shareholder[0]->Name;
    }
    public function accountHeadName($id){
        $this->db->select('Name');
        $this->db->from('account_head');
        $this->db->WHERE('id', $id);
        $shareholder = $this->db->get()->result();
        return $shareholder[0]->Name;
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
            'narration'   => $data['narration'],
        ];
        $this->db->insert('cash_in_out', $arr);
        $id_ = $this->db->insert_id();
        $this->balance($arr,$id_);
        $this->db->trans_start();
        if($data['cash-selection']=='cash-in'){
            // $this->debit($data);
            if($data['cash-selection-type']=='customer'){
                $this->customerCashIn($data);
            }
        }
        else{
            // $this->credit($data);
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
    public function balance($data, $id) {
        // Validate the input data
        if (!isset($data['cash_s']) || !in_array($data['cash_s'], ['cash-in', 'cash-out']) || !isset($data['amount']) || !is_numeric($data['amount'])) {
            return false; // Invalid data
        }
    
        // Get the last record from the 'availableamount' table
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('availableamount');
    
        if ($query->num_rows() == 0) {
            // No records found, assuming initial balance is 0
            $last_amount = 0;
        } else {
            $last_record = $query->row();
            $last_amount = $last_record->amount;
        }
    
        // Calculate the new amount based on the cash type
        if ($data['cash_s'] == 'cash-in') {
            $amount = $last_amount + $data['amount'];
        } elseif ($data['cash_s'] == 'cash-out') {
            $amount = $last_amount - $data['amount'];
        }
    
        // Prepare the data to be inserted
        $arr = [
            'cash_id'   => $id,
            'cash_type' => $data['cash_s'],
            'amount'    => $amount
        ];
    
        // Insert the new record into the 'availableamount' table
        if ($this->db->insert('availableamount', $arr)) {
            return true; // Insert successful
        } else {
            return false; // Insert failed
        }
    }
    
    // public function debit($data){
    //     $amount = $data['amount'];
    //     $this->db->set('amount', 'amount + ' . $this->db->escape($amount), FALSE);
    //     return $this->db->update('availableamount');
    // }
    // public function credit($data){
    //     $amount = $data['amount'];
    //     $this->db->set('amount', 'amount - ' . $this->db->escape($amount), FALSE);
    //     return $this->db->update('availableamount');
    // }
    public function shareHolderCashOut($data){
        $amount = $data['amount'];
        $sh = $data['cash-selection-party'];
        $this->db->set('balance', 'balance + ' . $this->db->escape($amount), FALSE);
        $this->db->where('id', $sh);
        $res=$this->db->update('shareholders');
        if($res){
            $this->db->where('id', $sh);
            $all = $this->db->get('shareholders')->result_array();
            $b=$all[0]['balance'];
        $arr=[
            'sid'      => $sh,
            'pay_type' => $data['cash-selection'],
            'amount'   => $amount, 
            'balance'=>$b,
        ];
        return $this->db->insert('shareholders_pays', $arr);
        }
    }

    public function updatecustomer($id, $data) {
      $this->db->where('id', $id);
       return  $this->db->update('customers', $data);
    }

    public function deletecustomer($id) {
        return $this->db->delete('customers', ['id' => $id]);
    }
    
}