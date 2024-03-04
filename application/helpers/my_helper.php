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
?>