<?php
if(!function_exists("response")){
     function response($res,$route,$msg){
  

        $this->CI->load->library('session');
		if($res){
			$this->session->set_flashdata('success', $msg);
            redirect($route);
		   }
		   else{
			$this->session->set_flashdata('error', 'Something went Wrong.');
            redirect($route);
		   }
	}
}


if (!function_exists('validator')) {
    function validator($field)
    {
        $CI = get_instance(); // Get the CodeIgniter instance
        $CI->load->library('form_validation'); // Load the form_validation library if it's not already loaded

        if ($CI->form_validation->error($field)) {
            return '<div class="error-message">' . form_error($field) . '</div>';
        }
        return ''; // No error, return empty string
    }
}
?>