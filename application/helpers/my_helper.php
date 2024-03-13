<?php
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



?>