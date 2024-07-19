<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShareHolder_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('form_validation');
    }
    public function saveAsset($data)
    {
        $existingTunnel = $this->db->get_where('tunnels', ['TName' => $data['name']])->row();
        if ($existingTunnel) {
            // Tunnel name already exists, return false
            return false;
        }

        $this->db->trans_start(); // Start Transaction
            $res['cost']=$data['area'];
            $res['asset']=$data['name'];
            $res['share_id']=implode(',', $data['shares']);
            $res['sh_id']=implode(',', $data['shareholder']);
           
        $this->db->insert('assets', $res);
        $sid =$this->db->insert_id();
        foreach ($data['shares'] as $key => $quantity) {
            $shares['sh_id']=intval($data['shareholder'][$key]);
            $shares['shares_values']=intval($data['shares'][$key]);
            $shares['asset_id']=$sid;
            $res=$this->db->insert('asset_shares', $shares);
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
   function getAssetDetail($id){
        $this->db->where('id', $id);
        $all = $this->db->get('assets')->result();
        return $all[0];
   }
   public function updateAsset($id,$data)
   {
       $existingTunnel = $this->db->get_where('tunnels', ['TName' => $data['name']])->row();
       if ($existingTunnel) {
           // Tunnel name already exists, return false
           return false;
       }

       $this->db->trans_start(); // Start Transaction
           $res['cost']=$data['area'];
           $res['asset']=$data['name'];
           $res['share_id']=implode(',', $data['shares']);
           $res['sh_id']=implode(',', $data['shareholder']);
          
       $this->db->where('id', $id);
       $ok=$this->db->update('assets', $res);
       $this->deleteAssetShares($id);
       foreach ($data['shares'] as $key => $quantity) {
        $shares['sh_id']=intval($data['shareholder'][$key]);
        $shares['shares_values']=intval($data['shares'][$key]);
        $shares['asset_id']=$id;
        $res=$this->db->insert('asset_shares', $shares);
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

    public function assetJsList($draw, $start, $length,$search=""){
        $this->db->where('status', 1);
        $totalRecords = $this->db->count_all_results('assets');

        $this->db->select('assets.id,assets.status,assets.asset,assets.cost,assets.cDate');
        $this->db->from('assets');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('assets.', $search);
            $this->db->or_like('assets.cost', $search);
            $this->db->or_like('assets.cDate', $search);
            $this->db->group_end();
        }
        $this->db->where('assets.status', 1);

        $data = $this->db->get()->result();
        $tunnels = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $data
        );
        return $tunnels; 
    }

    public function getAssetShares($id){
        $this->db->select('a.shares_values, s.Name,as.cost,as.asset');
        $this->db->from('asset_shares a');
        $this->db->join('shareholders s', 's.id = a.sh_id', 'left');
        $this->db->join('assets as', 'as.id = a.asset_id', 'left');
        $this->db->where('a.asset_id', $id);
        $res =$this->db->get()->result();
        return $res;
    }

    public function getshareholders() {
        $this->db->where('status', 1);
        $shareholders = $this->db->get('shareholders')->result();
        return $shareholders;
    }

    public function getshareholdersListing($draw, $start, $length,$search="") {
        $this->db->where('status', 1);
        $totalRecords = $this->db->count_all_results('shareholders');
    
        $this->db->select('*');
        $this->db->from('shareholders');
        $this->db->order_by('id', 'desc');
        $this->db->limit($length, $start);
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('id', $search);
            $this->db->or_like('Name', $search);
            $this->db->or_like('phone', $search);
            $this->db->or_like('address', $search);
            $this->db->or_like('cnic', $search);
            $this->db->or_like('capital_amount', $search);
            $this->db->or_like('balance', $search);
            $this->db->group_end();
        }
        $query = $this->db->get();
        $data = $query->result_array();
    
        $shareholders = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $data
        );
    
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
    public function detailListing($id,$draw, $start, $length,$search=""){

        $this->db->where('sid', $id);
        $totalRecords = $this->db->count_all_results('shareholders_pays');

        $this->db->select('sp.id, s.Name, c.narration, sp.balance as fb, sp.amount, sp.pay_type, sp.created');
        $this->db->from('shareholders s');
        $this->db->join('cash_in_out c', 'c.cash_sP = s.id', 'left');
        $this->db->join('shareholders_pays sp', 'sp.sid = s.id', 'right');
        $this->db->where('s.id', $id); // Assuming $id is a valid shareholder ID
        $this->db->where('c.case_sT', 'shareholder');
        $this->db->group_by('sp.created');
        $this->db->order_by('sp.id', 'DESC');
        $this->db->limit($length, $start);
       
       // $this->db->order_by('cash_in_out.id', 'DESC');

        $res =$this->db->get()->result();
        $shareholders = array(
            "draw" => $draw,
            "recordsTotal" => $totalRecords,  // Total records without pagination
            "recordsFiltered" => $totalRecords,  // Same as recordsTotal since we're not filtering
            "data" => $res
        );
    
        return $shareholders;
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
    public function deleteAssetShares($id) {
        return $this->db->delete('asset_shares', ['asset_id' => $id]);
    }
}
