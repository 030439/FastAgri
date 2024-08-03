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
        $query = $CI->db->query("SELECT * FROM purchasesdetail WHERE id =$pqid");
        $Arr=[0][0];
        $result = $query->result_array();
        if ($result) {
            $products = explode(",", $result[0]['product_id']);
            $fprices = explode(",", $result[0]['fu_price']);
            foreach($products as $c=>$p){
                echo $p;
                if($p==$pid){
                    return $fprices[$c];
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
if (!function_exists('CropName_')) {
    function productIdByCrop($id)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query
        $query = $CI->db->query("SELECT pid as crop FROM crops WHERE id = ?", array($id));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result['crop'];
        } else {
            return 0;
        }
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
        $result = $query->result_array();
        $result=$result[0];
        if(!empty($result['product_id'])){
            $product_ids = explode(',', $result['product_id']);
            $rates = explode(',', $result['rate']);
            foreach ($product_ids as $index => $product_id) {
                if($pid==$product_id){
                    $result['price']=$rates[$index];
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
function is_qual($a,$b){
    if($a==$b){
        echo "selected";
    }else{
        echo " ";
    }
}
function isSalaryAppliedOnThisTunnel($eid,$date,$tunnel){
    // tunnel_expense
    $CI =& get_instance();
    $CI->load->database();
    $query = $CI->db->query("SELECT e.id FROM tunnel_expense e WHERE e.tunnel_id = ? AND e.eid = ? AND e.edate=?", array($tunnel,$date, $eid));
    $result = $query->row_array();
    if ($result) {
        return true;
    } else {
        return false;
    }
}
function set_value($val){
    echo "value=$val";
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
if (!function_exists('supplierName_')) {
    function supplierName_($id)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query with proper binding
        $query = $CI->db->query("SELECT  s.Name as sname  FROM suppliers s WHERE id = ?", array($id));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result['sname'];
        } else {
            return "data not found";
        }
    }
}
if (!function_exists('tunnelName_')) {
    function tunnelName_($id)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query with proper binding
        $query = $CI->db->query("SELECT  t.TName as tunnel  FROM tunnels t WHERE id = ?", array($id));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result['tunnel'];
        } else {
            return "data not found";
        }
    }
}
if (!function_exists('employeeName_')) {
    function employeeName_($id)
    {
        $CI =& get_instance();
        $CI->load->database();

        // Execute the query with proper binding
        $query = $CI->db->query("SELECT  e.Name as employee  FROM employees e WHERE id = ?", array($id));

        // Fetch the result as an associative array
        $result = $query->row_array();

        // Check if result is not empty
        if ($result) {
            return $result['employee'];
        } else {
            return "data not found";
        }
    }
}
function getOnlyDate($date){
    if($date){
        return  date('Y-m-d', strtotime($date));
    }else{
        return "-";
    }
}

function convertNumberToWords($number) {
    $hyphen = '-';
    $conjunction = ' and ';
    $separator = ', ';
    $negative = 'negative ';
    $decimal = ' point ';
    $dictionary = [
        0 => 'zero',
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
        10 => 'ten',
        11 => 'eleven',
        12 => 'twelve',
        13 => 'thirteen',
        14 => 'fourteen',
        15 => 'fifteen',
        16 => 'sixteen',
        17 => 'seventeen',
        18 => 'eighteen',
        19 => 'nineteen',
        20 => 'twenty',
        30 => 'thirty',
        40 => 'forty',
        50 => 'fifty',
        60 => 'sixty',
        70 => 'seventy',
        80 => 'eighty',
        90 => 'ninety',
        100 => 'hundred',
        1000 => 'thousand',
        1000000 => 'million',
        1000000000 => 'billion',
        1000000000000 => 'trillion',
        1000000000000000 => 'quadrillion',
        1000000000000000000 => 'quintillion'
    ];

    if (!is_numeric($number)) {
        return false;
    }

    if ($number < 0) {
        return $negative . convertNumberToWords(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens = ((int) ($number / 10)) * 10;
            $units = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convertNumberToWords($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convertNumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convertNumberToWords($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = [];
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

?>

