<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountHeads extends CI_Controller
{

    public function index()
    {
        // shamas
        $this->load->view('layout/parts', ['page' => "pages/accounts/acoount-heads"]);
    }

}
