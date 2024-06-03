<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Tunnel_model');
		$this->load->model('ShareHolder_model');
    }
	public function index()
	{
		$tunnles=count($this->Common_model->getAll('tunnels'));
		$shareholder=count($this->Common_model->getAll('shareholders'));
		$employees=count($this->Common_model->getAll('employees'));
		$available=$this->Common_model->availableBalance();
		$data=['famount'=>$available,'tunnels'=>$tunnles,'shareholders'=>$shareholder,'employees'=>$employees];
		$this->load->view('pages/dashboard/index',['data'=>$data]);

		// $this->load->view('pages/authentication/register');
	}
}