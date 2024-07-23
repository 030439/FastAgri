<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payroll extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
		$this->load->model('Common_model');
		$this->load->model('Setup_model');
        $this->load->library('form_validation');
        if (!is_authorized()) {
			redirect('auth/login');
		}
    }

    private function _ok_(){$sql=("
    SELECT
        total,
        addition,
        deduction,
        net,
        pay_month,
        pay_id
        type,
        pay,
        @running_balance := @running_balance +(
            IFNULL(net, 0) - IFNULL(pay, 0)
        ) AS running_balance
    FROM
        (
        SELECT
            p.total as total,
            p.additon,
            p.deduction,
            p.net,
            p.date_ as pay_month,
            p.created_at as pdate
            NULL AS pay_id,
            NULL AS type,
            NULL AS pay,
            NULL AS cdate

        FROM
            `pays` `p`
        JOIN `employees` `e` ON
            `e`.`id` = `p`.`employee_id`
        WHERE
            `e`.`id` = $id
        UNION ALL
    SELECT 
            NULL AS total,
            NULL AS additon,
            NULL AS deduction,
            NULL AS net,
            NULL AS pay_month,
            NULL AS pdate
            c.id AS pay_id,
            c.case_sT AS type,
            c.amount AS pay,
            c.created_at as cdate
    FROM
            `cash_in_out` `c`
       
        WHERE
            `c`.`case_sT` = advance
        Or
            `c`.`case_sT` = advance
        AND 
             `c`.`cash_sP` = $id
    ) AS combined_data,
     (SELECT @running_balance := 0) AS rb
    ORDER BY
        cdate,pdate ASC;
    ");
    }

    public function index(){
       // $data['pays']=$this->Employee_model->getPays();
        $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/list-payroll"]);
    }
    public function getPaysList(){
		try{
			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
            $search = $this->input->post('search')['value'];
			$res=$this->Employee_model->getPaysList($draw,$start, $length,$search);
			echo jsonOutPut($res);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
	}
    public function generate(){
        try{
			$this->load->library('pagination');

        // Pagination configuration
        $config['base_url'] = base_url('employees');
        $config['total_rows'] = $this->Employee_model->count_records(); // Get total number of records from your model
        $config['per_page'] = 10; // Number of records per page
        $config['uri_segment'] = 3; // URI segment containing the page number

        // Customize pagination styling if needed
        $config['attributes'] = array('class' => 'pagination-link');

        // Initialize pagination
        $this->pagination->initialize($config);

        // Fetch data with pagination
        $offset = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
         $data['records']=$this->Employee_model->generatePayroll();
        //  dd($data);
            $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/generate-payroll",'data'=>$data,'listing'=>"employee-list"]);
			//$this->load->view('layout/parts',['page'=>"pages/human-resource/list-employee",'data'=>$data,'listing'=>"employee-list"]);
		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			show_error('An unexpected error occurred. Please try again later.');
		}
        
    }
    public function add(){
        $this->load->view('layout/parts',['page'=>"pages/human-resource/payroll/add-payroll"]);
    }
    
}