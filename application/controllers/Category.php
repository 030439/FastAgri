<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

    public function index()
    {
        $this->load->view('layout/parts', ['page' => "pages/setup/category"]);
    }
    public function unit()
    {
        $this->load->view('layout/parts', ['page' => "pages/setup/unit"]);
    }

}
