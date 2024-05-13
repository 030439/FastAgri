<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH.'vendor/autoload.php';
class Welcome extends CI_Controller {

    public function CreatePdf() {

        $mpdf = new \Mpdf\Mpdf([
            'format'=>'A4',
            'margin_top'=>0,
            'margin_bottom'=>0,
            'margin_left'=>0,
            'margin_right'=>0,
        ]);
        // $mpdf = new \Mpdf\Mpdf();
        $data=[1,2,3,4,5];
        $html=$this->load->view('create-pdf',["data"=>$data],true);
        $mpdf->WriteHTML($html);
        $mpdf->Output();

    }

}
?>
