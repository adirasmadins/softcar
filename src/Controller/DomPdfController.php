<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Dompdf\Options;

class DomPdfController extends AppController
{
    public function preVisualizar(){
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        $result = ['type' => 'error'];
        if($this->request->is('post')){
            $data = $this->request->data;

            $dompdf = new DOMPDF();
            $dompdf->set_option('defaultFont', 'Helvetica');
            $html = str_replace('%CLIENTE%', 'José da Silva', $data['texto']);
            $html .= "<img src='img/logo.png' width='100px' style='float: left'/><hr/>";


            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdf = $dompdf->output();
            $arquivo = "files/exports/" . $data['file_name'] . '_' . date('Y-m-d') . '.pdf';
            file_put_contents($arquivo,$pdf);
            $result = ['type' => 'success', 'data' => $arquivo];
        }
        $this->set(compact('arquivo'));
        $this->set('_serialize', ['arquivo']);
    }
}
