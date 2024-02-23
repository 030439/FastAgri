<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tunnels extends CI_Controller{
    
    public function index(){
        $this->load->view('layout/parts',['page'=>"pages/tunnels/list-tunnel"]);
    }
    public function add(){
        $this->load->view('layout/parts',['page'=>"pages/tunnels/add-tunnel"]);
    }
    
}
?>