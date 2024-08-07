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
    public function getCashRecord($id) {
        $this->db->select('c.*');
        $this->db->from('cash_in_out c');
        $this->db->WHERE('c.id',$id);
        $cash = $this->db->get()->result_array();
        return $cash;
    }
    public function updateCashbookPay($id,$data) {
        $old=$this->getCashRecord($id);
        $firstPerson=$old[0]['cash_sP'];
        $first_amount=$old[0]['amount'];
        $old_date=$old[0]['cdate'];
        $cash=$old[0]['cash_s'];

        $arr=[
            'cash_s' =>$cash,
            'cash_sP'  =>$data['cash-selection-party'],
            'amount'  =>$data['amount'],
            'narration'   => $data['narration'],
        ];
        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update('cash_in_out', $arr);
        
        $is_updated=$this->Updatebalance($first_amount,$cash,$arr,$id);
        if($cash=='cash-in'){
            // $this->debit($data);
            if($data['record']=='customer'){
                $this->UpdatecustomerCashIn($firstPerson,$first_amount,$data);
            }
            elseif($data['record']=="shareholder"){
                $this->UpdateshareHolderCashIn($firstPerson,$first_amount,$data,$old_date,$cash);
            }
        }
        else{
            // $this->credit($data);
            if($data['record']=='supplier'){
                $this->UpdateSupplierCashOut($firstPerson,$first_amount,$data);
            }
            elseif($data['record']=="shareholderOut"){
                $this->UpdateshareHolderCashOut($firstPerson,$first_amount,$data,$old_date,$cash);
            }
            elseif($data['record']=="jamandar"){
                $this->JamandarCashOutUpdate($firstPerson,$first_amount,$data);
            }
            elseif($data['record']=="jadvance"){
                $this->jadvance($firstPerson,$first_amount,$data,$old_date,$cash);
            }
            elseif($data['record']=="pay"){
                $this->UpdateGivenSalary($firstPerson,$first_amount,$data,$old_date);
            }
             elseif($data['record']=="advance"){
                $this->UpdateemployeeAdvance($firstPerson,$first_amount,$data,$old_date);
            }
            elseif($data['record']=="expense"){
                $this->updateExpense($$firstPerson,$first_amount,$data,$old_date);
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
            return $id;
        } 
    }

    public function cashbookList() {
        $this->db->select('c.*,a.amount as famount');
        $this->db->from('cash_in_out c');
        $this->db->join('availableamount a ', 'c.id = a.cash_id');
        $cash = $this->db->get()->result_array();
        $debit=0;
        $credit=0;
        $balance=0;
        foreach($cash as $c=>$d){
            $balance=$d['famount'];
            if($d['cash_s']=="cash-in"){
                $credit+=$d['amount'];
                if($d['case_sT']=="customer"){
                    $cash[$c]['name']="Cash Received";
                    $cash[$c]['narration']=$this->customerName($d['cash_sP']);
                }
                elseif ($d['case_sT']=="shareholder") {
                    $cash[$c]['narration']=$this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
            }elseif($d['cash_s']=="cash-out"){
                $debit+=$d['amount'];
                if($d['case_sT']=="supplier"){
                    $cash[$c]['narration']=$this->SupplierName($d['cash_sP']);
                    $cash[$c]['name']=$d['narration'];
                }
                elseif ($d['case_sT']=="shareholder") {
                    $cash[$c]['narration']=$this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
                elseif ($d['case_sT']=="pay") {
                    $cash[$c]['narration']=$this->EmployeeName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
                elseif ($d['case_sT']=="jamandari") {
                    $cash[$c]['narration']=$this->jamandarName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
                elseif ($d['case_sT']=="advance") {
                    $cash[$c]['narration']=$this->EmployeeName($d['cash_sP']);
                    $cash[$c]['name']=$this->EmployeeName($d['cash_sP']);
                }
                elseif ($d['case_sT']=="expense") {
                    $cash[$c]['name']=$this->accountHeadName($d['cash_sP']);
                }
                elseif ($d['case_sT']=="advance") {
                    $cash[$c]['name']=$this->EmployeeName($d['cash_sP']);
                }
            }
        }
        $cash[0]['fb']=$balance;
        $cash[0]['cashOut']=$credit;
        $cash[0]['cashIn']=$debit;
        return $cash;
    }
    public function cashbookList_($startDate, $endDate,$draw, $start = 0, $length = 10, $search = '') {
        // Get the total number of records
        $this->db->from('cash_in_out');
        $totalRecords = $this->db->count_all_results();
    
        // Create the query with query builder
        $this->db->select('c.*, a.amount as famount');
        $this->db->from('cash_in_out c');
        $this->db->join('availableamount a', 'c.id = a.cash_id');
    
        // Apply search filter if any
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('c.id', $search);
            $this->db->or_like('c.cash_s', $search);
            $this->db->or_like('c.case_sT', $search);
            $this->db->or_like('c.narration', $search);
            $this->db->or_like('a.amount', $search);
            $this->db->group_end();
        }
        if (!empty($startDate) && !empty($endDate)) {
            $this->db->where('c.cdate BETWEEN "' . $startDate . '" AND "' . $endDate . '"');
        }
    
        // Get the filtered records count
        $filteredRecords = $this->db->count_all_results('', FALSE);
    
        // Order by id in descending order
        $this->db->order_by('c.id', 'DESC');
    
        // Limit the results for pagination
        $this->db->limit($length, $start);
    
        // Execute the query
        $query = $this->db->get();
        $cash = $query->result_array();
    
        // Process the results
        $debit = 0;
        $credit = 0;
        $balance = 0;
        foreach ($cash as $c => $d) {
            $balance = $d['famount'];
            if ($d['cash_s'] == "cash-in") {
                $credit += $d['amount'];
                if ($d['case_sT'] == "customer") {
                    $cash[$c]['name'] = "Cash Received";
                    $cash[$c]['narration'] = $this->customerName($d['cash_sP']);
                } elseif ($d['case_sT'] == "shareholder") {
                    $cash[$c]['narration'] = $this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['name'] = "Share Holder";
                }
            } elseif ($d['cash_s'] == "cash-out") {
                $debit += $d['amount'];
                if ($d['case_sT'] == "supplier") {
                    $cash[$c]['name'] = $this->SupplierName($d['cash_sP']);
                    $cash[$c]['narration'] = $d['narration'];
                } elseif ($d['case_sT'] == "shareholder") {
                    $cash[$c]['narration'] = $this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['name'] = "Share Holder";
                } elseif ($d['case_sT'] == "pay") {
                   // $cash[$c]['narration'] = $this->EmployeeName($d['cash_sP']);
                    $cash[$c]['name'] = $this->EmployeeName($d['cash_sP']);
                } elseif ($d['case_sT'] == "jamandari") {
                    $cash[$c]['narration'] = $this->jamandarName($d['cash_sP']);
                    $cash[$c]['name'] = "Jamandar";
                } elseif ($d['case_sT'] == "jamandariAdvance") {
                    $cash[$c]['narration'] = $this->jamandarName($d['cash_sP']);
                    $cash[$c]['name'] = "Jamandar Advance";
                } elseif ($d['case_sT'] == "expense") {
                    $cash[$c]['name'] = $this->accountHeadName($d['cash_sP']);
                }
                elseif ($d['case_sT']=="advance") {
                    $cash[$c]['name']=$this->EmployeeName($d['cash_sP']);
                }
            }
        }
        $cash[0]['fb'] = $balance;
        $cash[0]['cashOut'] = $credit;
        $cash[0]['cashIn'] = $debit;
    
        // Prepare the final output
        if($cash[0]['fb']==0){
            $cash=[];
        }
        $response = array(
            "draw" => intval($draw),
            "recordsTotal" => intval($totalRecords),
            "recordsFiltered" => intval($filteredRecords),
            "data" => $cash
        );
    
        return $response;
    }
    
    public function invoice($id){
        $this->db->select('*');
        $this->db->from('cash_in_out');
        $this->db->WHERE('id', $id);
        $cash = $this->db->get()->result_array();
        foreach($cash as $c=>$d){
            if($d['cash_s']=="cash-in"){
                if($d['case_sT']=="customer"){
                    $cash[$c]['pname']=$this->customerName($d['cash_sP']);
                    $cash[$c]['current_amount']=$this->CustomerCurrentAmount($d['cash_sP']);
                }
                elseif ($d['case_sT']=="shareholder") {
                    $cash[$c]['pname']=$this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['current_amount']=$this->ShareHolderCurrentAmount($d['cash_sP']);
                }
            }elseif($d['cash_s']=="cash-out"){
                if($d['case_sT']=="supplier"){
                    $cash[$c]['pname']=$this->SupplierName($d['cash_sP']);
                    $cash[$c]['current_amount']=$this->SupplierCurrentAmount($d['cash_sP']);
                }
                elseif ($d['case_sT']=="shareholder") {
                    $cash[$c]['pname']=$this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['current_amount']=$this->ShareHolderCurrentAmount($d['cash_sP']);
                }
                elseif ($d['case_sT']=="pay") {
                    $cash[$c]['pname']=$this->EmployeeName($d['cash_sP']);
                    $cash[$c]['current_amount']=$this->EmployeeCurrentAmount($d['cash_sP']);
                }
                elseif ($d['case_sT']=="jamandari") {
                    $cash[$c]['pname']=$this->jamandarName($d['cash_sP']);
                    $cash[$c]['current_amount']=$this->JamandarCurrentAmount($d['cash_sP']);
                }
                elseif($d['case_sT']=="jamandariAdvance"){
                    $cash[$c]['pname']=$this->jamandarName($d['cash_sP']);
                    $cash[$c]['current_amount']=$this->JamandarCurrentAmount($d['cash_sP']);
                }
                elseif ($d['case_sT']=="expense") {
                    $cash[$c]['pname']=$this->accountHeadName($d['cash_sP']);
                    $cash[$c]['current_amount']="-";
                }
                elseif ($d['case_sT']=="advance") {
                    $cash[$c]['pname']=$this->EmployeeName($d['cash_sP']);
                    $cash[$c]['current_amount']="-";
                }
            }
        }
        return ($cash);
    }
    public function cashbookById($id) {
        $this->db->select('c.*,a.amount as famount');
        $this->db->from('cash_in_out c');
        $this->db->join('availableamount a ', 'c.id = a.cash_id');
        $cash = $this->db->get()->result_array();
        $debit=0;
        $credit=0;
        foreach($cash as $c=>$d){
            $balance=$d['famount'];
            if($d['cash_s']=="cash-in"){
                $credit+=$d['amount'];
                if($d['case_sT']=="customer"){
                    $cash[$c]['name']="Cash Received";
                    $cash[$c]['narration']=$this->customerName($d['cash_sP']);
                }
                elseif ($d['case_sT']=="shareholder") {
                    $cash[$c]['narration']=$this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
            }elseif($d['cash_s']=="cash-out"){
                $debit+=$d['amount'];
                if($d['case_sT']=="supplier"){
                    $cash[$c]['narration']=$this->SupplierName($d['cash_sP']);
                    $cash[$c]['name']=$d['narration'];
                }
                elseif ($d['case_sT']=="shareholder") {
                    $cash[$c]['narration']=$this->ShareHolderName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
                elseif ($d['case_sT']=="pay") {
                    $cash[$c]['narration']=$this->EmployeeName($d['cash_sP']);
                    $cash[$c]['name']="Share Holder";
                }
                elseif ($d['case_sT']=="jamandari") {
                    $cash[$c]['narration']=$this->jamandarName($d['cash_sP']);
                    $cash[$c]['name']="Jamandar";
                }
                elseif($d['case_sT']=="jamandariAdvance"){
                    $cash[$c]['narration']=$this->jamandarName($d['cash_sP']);
                    $cash[$c]['name']="Jamandar";
                }
                elseif ($d['case_sT']=="expense") {
                    $cash[$c]['name']=$this->accountHeadName($d['cash_sP']);
                }
                elseif ($d['case_sT']=="advance") {
                    $cash[$c]['name']=$this->EmployeeName($d['cash_sP']);
                }
            }
        }
        $cash[0]['fb']=$balance;
        $cash[0]['cashOut']=$credit;
        $cash[0]['cashIn']=$debit;
        return $cash;
    }

    public function customerName($id){
        $this->db->select('Name');
        $this->db->from('customers');
        $this->db->WHERE('id', $id);
        $customer = $this->db->get()->result();
        return $customer[0]->Name;
    }
    public function CustomerCurrentAmount($id){
        $this->db->select('closing');
        $this->db->from('customer_detail');
        $this->db->WHERE('cid', $id);
        $customer = $this->db->get()->result();
        return $customer[0]->closing;
    }
    public function jamandarName($id){
        $this->db->select('name');
        $this->db->from('jamandars');
        $this->db->WHERE('id', $id);
        $customer = $this->db->get()->result();
        return $customer[0]->name;
    }
    public function JamandarCurrentAmount($id){
        $this->db->select('payable');
        $this->db->from('jamandartotal');
        $this->db->WHERE('jamandar_id', $id);
        $customer = $this->db->get()->result();
        return $customer[0]->payable;
    }
    public function SupplierName($id){
        $this->db->select('Name');
        $this->db->from('suppliers');
        $this->db->WHERE('id', $id);
        $supplier = $this->db->get()->result();
        return $supplier[0]->Name;
    }
    public function SupplierCurrentAmount($id){
        $this->db->select('closing');
        $this->db->from('supplier_detail');
        $this->db->WHERE('sid', $id);
        $supplier = $this->db->get()->result();
        return $supplier[0]->closing;
    }
    public function ShareHolderName($id){
        $this->db->select('Name');
        $this->db->from('shareholders');
        $this->db->WHERE('id', $id);
        $shareholder = $this->db->get()->result();
        if(!empty($shareholder)){
            return $shareholder[0]->Name;
        }
    }
    public function ShareHolderCurrentAmount($id){
        $this->db->select('balance');
        $this->db->from('shareholders');
        $this->db->WHERE('id', $id);
        $shareholder = $this->db->get()->result();
        return $shareholder[0]->balance;
    }
    public function EmployeeName($id){
        $this->db->select('Name');
        $this->db->from('employees');
        $this->db->WHERE('id', $id);
        $shareholder = $this->db->get()->result();
        return $shareholder[0]->Name;
    }
    public function EmployeeCurrentAmount($id){
        $this->db->select('payable');
        $this->db->from('employees');
        $this->db->WHERE('id', $id);
        $shareholder = $this->db->get()->result();
        return $shareholder[0]->payable;
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

    public function jamandarAdvanceAdd($data) {
        $date_=date("y-m-d");
        $this->db->trans_start();
        $arr=[
            'jid'          => $data['cash-selection-party'],
            'amount'       => $data['amount'],
            'installment'  => $data['installment'],
            'date_'        => $date_,
        ];
        if($this->db->insert('jamandar_loan', $arr)){
            $employee = $this->db->get_where('jamandartotal', ['jamandar_id' => $data['cash-selection-party']])->row();
            $loan=$employee->advance;
            $loan-=$data['amount'];
            $loan=[
                'advance'=>$loan,
            ];
            $this->db->where('jamandar_id', $data['cash-selection-party']);
            $ok=$this->db->update('jamandartotal', $loan);
        }
        $this->db->trans_complete(); // Complete Transaction
        
        if ($this->db->trans_status() === FALSE) {
            // Transaction failed, handle the error
            $this->db->trans_rollback(); // Roll back changes
            return false;
        } else {
            // Transaction succeeded
            $this->db->trans_commit(); // Commit changes
            return $id_;
        } 
    }
    public function cashbookPay($data) {
        $arr=[
            'cash_s'  =>$data['cash-selection'],
            'case_sT'  =>$data['cash-selection-type'],
            'cash_sP'  =>$data['cash-selection-party'],
            'amount'  =>$data['amount'],
            'narration'   => $data['narration'],
        ];
      
        $this->db->trans_start();
        $this->db->insert('cash_in_out', $arr);
        $id_ = $this->db->insert_id();
        $this->balance($arr,$id_);
        if($data['cash-selection']=='cash-in'){
            // $this->debit($data);
            if($data['cash-selection-type']=='customer'){
                $this->customerCashIn($data);
            }
            elseif($data['cash-selection-type']=="shareholder"){
                $this->shareHolderCashIn($data);
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
            elseif($data['cash-selection-type']=="jamandari"){
                $this->JamandarCashOut($data);
            }
            elseif($data['cash-selection-type']=="jamandariAdvance"){
                $this->jamandarAdvanceAdd($data);
            }
            elseif($data['cash-selection-type']=="pay"){
                $this->SalaryGiven($data);
            }
             elseif($data['cash-selection-type']=="advance"){
                $this->employeeAdvance($data);
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
            return $id_;
        } 
    }

    public function customerCashIn($data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];

        $this->db->set('closing', 'closing - ' . $this->db->escape($amount), FALSE);
        $this->db->where('cid', $customerId);
        return $this->db->update('customer_detail');
    }
    public function UpdatecustomerCashIn($firstPerson,$first_amount,$data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];
        $this->db->trans_start();
        $this->db->set('closing', 'closing + ' . $this->db->escape($first_amount), FALSE);
        $this->db->where('cid', $firstPerson);
        $updated=$this->db->update('customer_detail');
        if($updated){
            $amount = $data['amount'];
            $customerId = $data['cash-selection-party'];
            $this->db->set('closing', 'closing - ' . $this->db->escape($amount), FALSE);
            $this->db->where('cid', $customerId);
            $this->db->update('customer_detail');
        }
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
    public function SupplierCashOut($data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];

        $this->db->set('closing', 'closing - ' . $this->db->escape($amount), FALSE);
        $this->db->where('sid', $customerId);
        return $this->db->update('supplier_detail');
    }
    public function UpdateSupplierCashOut($firstPerson,$first_amount,$data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];
        $this->db->trans_start();
        $this->db->set('closing', 'closing + ' . $this->db->escape($first_amount), FALSE);
        $this->db->where('sid', $firstPerson);
        $update=$this->db->update('supplier_detail');
        if($update){
            $this->db->set('closing', 'closing - ' . $this->db->escape($amount), FALSE);
            $this->db->where('sid', $customerId);
            $this->db->update('supplier_detail');
        }
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
    public function SalaryGiven($data){
        $this->db->trans_start();
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];
        $date=date("y-m-d");
        $this->db->set('payable', 'payable - ' . $this->db->escape($amount), FALSE);
        $this->db->where('id', $customerId);
        $this->db->update('employees');

        $tunnels=$data['select-tunnel'];
        $all=$this->getAllTunnels();
        $allTunnel=count($tunnels);
        $perTunnel=$data['amount']/$allTunnel;

        foreach($tunnels as $tunnel){
                $expense=[
                    'tunnel_id'=>$tunnel,
                    'expense_type'=>'EMP',
                    'eid'=>$customerId,
                    'amount'=>$perTunnel,
                    'edate'=>$date,
                    'pid'=>$customerId
                ];
                $res=$this->db->insert('tunnel_expense', $expense);
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
    public function UpdateGivenSalary($firstPerson,$first_amount,$data,$old_date){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];
        // $date=date("y-m-d");
        $this->db->trans_start();
        $this->db->set('payable', 'payable + ' . $this->db->escape($first_amount), FALSE);
        $this->db->where('id', $firstPerson);
        $updated=$this->db->update('employees');
        if($updated){
            $this->db->set('payable', 'payable -' . $this->db->escape($amount), FALSE);
            $this->db->where('id', $customerId);
            $this->db->update('employees'); 
            $tunnels=$data['select-tunnel'];
            $all=$this->getAllTunnels();
            $allTunnel=count($tunnels);
            $perTunnel=$data['amount']/$allTunnel;
                foreach($tunnels as $tunnel){

                    $this->db->delete('tunnel_expense', ['tunnel_id' => $tunnel,'eid'=>$firstPerson,'edate'=>$old_date]);
                        $expense=[
                            'tunnel_id'=>$tunnel,
                            'expense_type'=>'EMP',
                            'eid'=>$customerId,
                            'amount'=>$perTunnel,
                            'edate'=>$old_date,
                            'pid'=>$customerId
                        ];
                        $res=$this->db->insert('tunnel_expense', $expense);
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
    }
    public function employeeAdvance($data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];
        $installment=$data['installment'];
        $date_=date('y-m-d');
        $this->db->trans_start();
        $data_=['employee_id'=>$customerId,'employee_type'=>1,'amount'=>$amount,'installment'=>$installment,'date_'=>$date_];

        $this->db->set('payable', 'payable - ' . $this->db->escape($amount), FALSE);
        $this->db->where('id', $customerId);
        $res=$this->db->update('employees');
        if($res){
            $this->db->insert('employee_loan', $data_);
            $eid = $this->db->insert_id();
            $employee = $this->db->get_where('loans', ['employee_id' => $customerId])->row();
            $loan=$employee->loan;
            $loan+=$data['amount'];
           // $installment_=$employee->load;
            $installment_=$data['installment'];
            $loan=[
                'loan'=>$loan,
                'installment'=>$installment_
            ];
            $this->db->where('employee_id', $customerId);
            $this->db->update('loans', $loan);
            
            $tunnels=$data['select-tunnel'];
            $all=$this->getAllTunnels();
            $allTunnel=count($tunnels);
            $perTunnel=$data['amount']/$allTunnel;
    
                foreach($tunnels as $tunnel){
                        $expense=[
                            'tunnel_id'=>$tunnel,
                            'expense_type'=>'ADV',
                            'eid'=>$eid,
                            'amount'=>$perTunnel,
                            'edate'=>$date_,
                            'pid'=>$customerId
                        ];
                        $res=$this->db->insert('tunnel_expense', $expense);
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
    }
    public function UpdateemployeeAdvance($firstPerson,$first_amount,$data,$old_date){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];
        $installment=$data['installment'];
        $date_=date('y-m-d');
        $this->db->trans_start();
        $data_=['employee_id'=>$customerId,'employee_type'=>1,'amount'=>$amount,'installment'=>$installment,'date_'=>$date_];

        $this->db->set('payable', 'payable + ' . $this->db->escape($first_amount), FALSE);
        $this->db->where('id', $firstPerson);
        $fupdated=$this->db->update('employees');
        if($fupdated){
            $this->db->set('payable', 'payable - ' . $this->db->escape($amount), FALSE);
            $this->db->where('id', $customerId);
            $res=$this->db->update('employees');
            if($res){
                $deleted=$this->db->delete('employee_loan', ['employee_id' => $customerId,'date_'=>$old_date]);
                if($deleted)
                {
                    $firstRemoved=$this->employeeAdvanceRecordUpdation($firstPerson,$first_amount,$data,$old_date);
                    if($firstRemoved)
                    {
                        $this->db->insert('employee_loan', $data_);
                        $eid = $this->db->insert_id();
                        $employee = $this->db->get_where('loans', ['employee_id' => $customerId])->row();
                        $loan=$employee->loan;
                        $loan+=$data['amount'];
                        // $installment_=$employee->load;
                        $installment_=$data['installment'];
                        $loan=[
                            'loan'=>$loan,
                            'installment'=>$installment_
                        ];
                        $this->db->where('employee_id', $customerId);
                        $this->db->update('loans', $loan);
                        
                        $tunnels=$data['select-tunnel'];
                        $all=$this->getAllTunnels();
                        $allTunnel=count($tunnels);
                        $perTunnel=$data['amount']/$allTunnel;
                        foreach($tunnels as $tunnel){
                                $expense=[
                                    'tunnel_id'=>$tunnel,
                                    'expense_type'=>'ADV',
                                    'eid'=>$eid,
                                    'amount'=>$perTunnel,
                                    'edate'=>$date_,
                                    'pid'=>$customerId
                                ];
                                $res=$this->db->insert('tunnel_expense', $expense);
                        }
                    }else{
                        return false;
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
        }
    }
    function employeeAdvanceRecordUpdation($firstPerson,$first_amount,$data,$old_date){
        $ok=false;
        $this->db->trans_start();
        $employee = $this->db->get_where('loans', ['employee_id' => $firstPerson])->row();
        $loan=$employee->loan;
        $loan-=$first_amount;
        // $installment_=$employee->load;
        $installment_=$data['installment'];
        $loan=[
            'loan'=>$loan
        ];
        $this->db->where('employee_id', $firstPerson);
        $this->db->update('loans', $loan);
        
        $tunnels=$data['select-tunnel'];
        $all=$this->getAllTunnels();
        $allTunnel=count($tunnels);
        $perTunnel=$first_amount/$allTunnel;

        foreach($tunnels as $tunnel){
            $deleted=$this->db->delete('tunnel_expense', ['eid' => $firstPerson,'edate'=>$old_date,'amount'=>$perTunnel]);
            if($deleted){
                $ok=true;
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
            return $ok;
        } 
    }
    public function JamandarCashOut($data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];

        $this->db->set('payable', 'payable - ' . $this->db->escape($amount), FALSE);
        $this->db->where('jamandar_id', $customerId);
        return $this->db->update('jamandartotal');
    }
    public function JamandarCashOutUpdate($firstPerson,$first_amount,$data){
        $amount = $data['amount'];
        $customerId = $data['cash-selection-party'];

        $this->db->set('payable', 'payable + ' . $this->db->escape($first_amount), FALSE);
        $this->db->where('jamandar_id', $firstPerson);
        $updated=$this->db->update('jamandartotal');
        if($updated){
            $this->db->set('payable', 'payable - ' . $this->db->escape($amount), FALSE);
            $this->db->where('jamandar_id', $customerId);
            return $this->db->update('jamandartotal');
        }
    }
    public function jadvance($firstPerson,$first_amount,$data,$old_date,$cash){
        $arr=[
            'jid'          => $data['cash-selection-party'],
            'amount'       => $data['amount'],
            'installment'  => $data['installment'],
            'date_'        => $data['date_'],
        ];
        $this->db->trans_start();
        $deleted=$this->db->delete('jamandar_loan', ['jid' => $firstPerson,'amount'=>$first_amount,'date_'=>$old_date]);
        if($deleted){
            $inserted=$this->db->insert('jamandar_loan', $arr);
            if($inserted){
                $employee = $this->db->get_where('jamandartotal', ['jamandar_id' => $firstPerson])->row();
                $floan=$employee->advance;
                $floan-=$first_amount;
                $floan_=[
                    'advance'=>$floan,
                ];
                $this->db->where('jamandar_id', $firstPerson);
                $new=$this->db->update('jamandartotal', $floan_);
                if($new){
                    $employee = $this->db->get_where('jamandartotal', ['jamandar_id' => $data['cash-selection-party']])->row();
                    $loan=$employee->advance;
                    $loan+=$data['amount'];
                    $loan_=[
                        'advance'=>$loan_,
                    ];
                    $this->db->where('jamandar_id', $data['cash-selection-party']);
                    return $this->db->update('jamandartotal', $loan_);
                }
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
            return $ok;
        } 
    }
    public function updateExpense($firstPerson,$first_amount,$data,$old_date){
        $arr=[
            'head'        => $data['cash-selection-party'],
            'narration'   => $data['narration'],
            'amount'     => $data['amount']
        ];
        $this->db->trans_start();
        $deleted=$this->db->delete('expenses', ['amount'=>$first_amount,'head' => $data['cash-selection-party'],'e_date'=>$old_date]);
        if($deleted){
            $this->db->insert('expenses', $arr);
            $eid = $this->db->insert_id();
            $tunnels=$data['select-tunnel'];
            $all=$this->getAllTunnels();
            $allTunnel=count($tunnels);
            $perTunnel=$data['amount']/$allTunnel;
            
            $date=date("y-m-d");
            foreach($tunnels as $tunnel){
                $this->db->delete('tunnel_expense', ['tunnel_id' => $tunnel,'eid'=>$firstPerson,'edate'=>$old_date]);
                    $expense=[
                        'tunnel_id'=>$tunnel,
                        'expense_type'=>'EXP',
                        'eid'=>$eid,
                        'amount'=>$perTunnel,
                        'edate'=>$date,
                        'pid'=>$data['cash-selection-party']
                    ];
                    $ok=$this->db->insert('tunnel_expense', $expense);
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
            return $ok;
        } 
    }
    public function Expense($data){
        $arr=[
            'head'        => $data['cash-selection-party'],
            'narration'   => $data['narration'],
            'amount'     => $data['amount']
        ];
        $date=date("y-m-d");
        $this->db->insert('expenses', $arr);
        $eid = $this->db->insert_id();
        $tunnels=$data['select-tunnel'];
        $all=$this->getAllTunnels();
        $allTunnel=count($tunnels);
        $perTunnel=$data['amount']/$allTunnel;
            foreach($tunnels as $tunnel){
                    $expense=[
                        'tunnel_id'=>$tunnel,
                        'expense_type'=>'EXP',
                        'eid'=>$data['cash-selection-party'],
                        'amount'=>$perTunnel,
                        'edate'=>$date,
                        'pid'=>$data['cash-selection-party']
                    ];
                    $res=$this->db->insert('tunnel_expense', $expense);
            }
       return;
    }
    public function getAllTunnels(){
        $this->db->select('tunnels.id');
        $this->db->from('tunnels');
        $this->db->WHERE('status', 1);
        $products = $this->db->get()->result();
        return $products;

        $this->db->where('status', 1);
        $all = $this->db->get('tunnels')->result();
        return $all[0]->TName;
    }
    public function Updatebalance($first_amount,$cash,$data, $id) {

        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('availableamount');
    
        if ($query->num_rows() == 0) {
            $last_amount = 0;
        } else {
            $last_record = $query->row();
            $last_amount = $last_record->amount;
        }
    
        // Calculate the new amount based on the cash type
        if ($cash == 'cash-in') {
            $amount = $last_amount + $data['amount']-$first_amount;
        } elseif ($cash == 'cash-out') {
            $amount = $last_amount - $data['amount']+$first_amount;
        }
    
        // Prepare the data to be inserted
        $arr = [
            'cash_id'   => $id,
            'cash_type' => $cash,
            'amount'    => $amount
        ];
        $deleted=$this->db->delete('availableamount', ['cash_id' => $id]);
        if($deleted){
            if ($this->db->insert('availableamount', $arr)) {
                return true; // Insert successful
            } else {
                return false; // Insert failed
            }
        }else{
            return false;
        }
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
        $this->db->trans_start();
        $amount = $data['amount'];
        $sh = $data['cash-selection-party'];
        $this->db->set('balance', 'balance - ' . $this->db->escape($amount), FALSE);
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
        $ok= $this->db->insert('shareholders_pays', $arr);
        }
        $this->db->trans_complete(); // Complete Transaction

        if ($this->db->trans_status() === FALSE) {
            // Transaction failed, handle the error
            $this->db->trans_rollback(); // Roll back changes
            return false;
        } else {
            // Transaction succeeded
            $this->db->trans_commit(); // Commit changes
            return $ok;
        } 
    }

    public function UpdateshareHolderCashOut($firstPerson,$first_amount,$data,$old_date,$cash){
        $this->db->trans_start();
        $amount = $data['amount'];
        $sh = $data['cash-selection-party'];
        $this->db->set('balance', 'balance + ' . $this->db->escape($first_amount), FALSE);
        $this->db->where('id', $firstPerson);
        $fupdated=$this->db->update('shareholders');
        if($fupdated){
            $this->db->set('balance', 'balance - ' . $this->db->escape($amount), FALSE);
            $this->db->where('id', $sh);
            $res=$this->db->update('shareholders');
            if($res){
                $deleted=$this->db->delete('shareholders_pays', ['sid' => $firstPerson,'pay_date'=> $old_date,'amount'=>$first_amount]);
                $this->db->where('id', $sh);
                $all = $this->db->get('shareholders')->result_array();
                $b=$all[0]['balance'];
            $arr=[
                'sid'      => $sh,
                'pay_type' => $cash,
                'amount'   => $amount, 
                'balance'=>$b,
            ];
            $ok= $this->db->insert('shareholders_pays', $arr);
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
            return $ok;
        } 
    }

    public function UpdateshareHolderCashIn($firstPerson,$first_amount,$data,$old_date,$cash){
        $this->db->trans_start();
        $amount = $data['amount'];
        $sh = $data['cash-selection-party'];
        $this->db->set('balance', 'balance - ' . $this->db->escape($first_amount), FALSE);
        $this->db->where('id', $firstPerson);
        $fupdated=$this->db->update('shareholders');
        if($fupdated){
            $this->db->set('balance', 'balance + ' . $this->db->escape($amount), FALSE);
            $this->db->where('id', $sh);
            $res=$this->db->update('shareholders');
            if($res){
                $deleted=$this->db->delete('shareholders_pays', ['sid' => $firstPerson,'pay_date'=> $old_date,'amount'=>$first_amount]);
                $this->db->where('id', $sh);
                $all = $this->db->get('shareholders')->result_array();
                $b=$all[0]['balance'];
            $arr=[
                'sid'      => $sh,
                'pay_type' => $cash,
                'amount'   => $amount, 
                'balance'=>$b,
            ];
            $ok= $this->db->insert('shareholders_pays', $arr);
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
            return $ok;
        } 
    }
    public function shareHolderCashIn($data){
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
