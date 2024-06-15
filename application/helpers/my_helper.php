<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('validator')) {
    function validator($field)
    {
        $CI = get_instance(); // Get the CodeIgniter instance
        $CI->load->library('form_validation'); // Load the form_validation library if it's not already loaded

        if ($CI->form_validation->error($field)) {
            echo  '<div class="error-message">' . form_error($field) . '</div>';
        }
        return ''; // No error, return empty string
    }
}


if (!function_exists('response')) {
    function response($result, $route, $success_msg, $error_msg = 'Something went wrong.')
    {
        $CI = get_instance(); // Get the CodeIgniter instance
        $CI->load->library('session'); // Load the session library if it's not already loaded

        if ($result) {
            $CI->session->set_flashdata('success', $success_msg);
        } else {
            $CI->session->set_flashdata('error', $error_msg);
        }
        redirect($route);
    }
}
if (!function_exists('ShowVal')) {
    function ShowVal($data)
    {
        echo htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('jsonOutPut')) {
    function jsonOutPut($data)
    {
        if (ob_get_length()) {
            ob_clean();
        }

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

function is_authorized() {
    $CI = get_instance();
    $CI->load->library('session'); 
    if ($CI->session->userdata('user_id')) {
        return true;
    } else {
        return false;
    }
}
function dd($data){
    echo "<pre>";
    print_r($data);
    die;
}

if (!function_exists('pqrate')) {
    function pqrate($pqid, $pid)
    {
        $CI =& get_instance();
        $CI->load->database();
        $stockWithRate = array();
        $query = $CI->db->query("SELECT * FROM purchasesdetail WHERE id = $pqid");

        if ($query && $query->num_rows() > 0) {
            $result = $query->row_array();
            $products = explode(",", $result['product_id']);
            $fprices = explode(",", $result['fu_price']);
            foreach($products as $c=>$p){
                if($p==$pid){
                    echo $fprices[$c];
                }else{
                    echo 0;
                }
            }
            // Do something with $products or $result if needed
        }
    }
}

if (!function_exists('productByTunnelName')) {
    function productByTunnelName($name)

    {
        $CI =& get_instance();
        $CI->load->database();

        $stockWithRate = array();
        $query = $CI->db->query("SELECT crops.FasalName as crop FROM tunnels join crops ON crops.pid=tunnels.product__id WHERE tunnels.TName = '".$name."'");
        $result = $query->row_array();
        echo $result['crop'];
        return;
    }
}
if (!function_exists('productName_')) {
    function productName_($id)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query
        $query = $CI->db->query("SELECT Name as product FROM products WHERE id = ?", array($id));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result['product'];
        } else {
            return "Product not found";
        }
        return;
    }

}
if (!function_exists('getIssueProQty')) {
    function getIssueProQty($tid, $pid)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query with proper binding
        $query = $CI->db->query("SELECT i.Quantity as qty,pd.fu_price as rate, pd.product_id
        FROM issuestock i
        join purchasesdetail pd ON pd.id
        WHERE i.tunnel_id = ? AND i.pid = ? ", array($tid,$pid));

        // Fetch the result as an associative array
        $result = $query->row_array();
        if(!empty($result['product_id'])){
            $product_ids = explode(',', $result['product_id']);
            foreach ($product_ids as $index => $product_id) {
                if($pid==$product_id){
                    $result['price']=$product_id[$index]['fu_price'];
                }
            }
        }
        // Check if result is not empty
        if ($result) {
            return $result;
        } else {
            return "Product not found";
        }
    }
}
if (!function_exists('getLabourQty')) {
    function getLabourQty($tid, $eid)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query with proper binding
        $query = $CI->db->query("SELECT  j.name as jname ,l.lq as qty ,l.rate FROM issuelabour l JOIN jamandars j ON l.jamandar=j.id WHERE l.tunnel = ? AND l.id = ?", array($tid, $eid));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result;
        } else {
            return "data not found";
        }
    }
}

if (!function_exists('jamandarName')) {
    function jamandarName($id)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query with proper binding
        $query = $CI->db->query("SELECT  j.name as jname  FROM jamandars j WHERE id = ?", array($id));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result['jname'];
        } else {
            return "data not found";
        }
    }
}
if (!function_exists('customerName')) {
    function customerName($id)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query with proper binding
        $query = $CI->db->query("SELECT  c.Name as cname  FROM customers c WHERE id = ?", array($id));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result['cname'];
        } else {
            return "data not found";
        }
    }
}


?>