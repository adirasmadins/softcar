<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Dompdf\Options;
use Cake\ORM\TableRegistry;
use App\Lib\Utils;

class DomPdfController extends AppController
{
    public function preVisualizar(){
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        $result = ['type' => 'error'];
        if($this->request->is('post')){
            $data = $this->request->data;

            $html = "
                        <img src='img/logo.png' width='100px' style='float: left'/>
                        <hr/>
                    ";
            $html .= str_replace('%CLIENTE%', 'José da Silva', $data['texto']);

            $mpdf = new \mPDF();
            $mpdf->WriteHTML($html);
            $pdf = $mpdf->Output();
            $arquivo = "files/exports/" . $data['file_name'] . '_' . date('Y-m-d') . '.pdf';
            file_put_contents($arquivo,$pdf);
//            $dompdf = new DOMPDF();
//            $dompdf->set_option('defaultFont', 'Helvetica');
//            $html = "
//                        <img src='img/logo.png' width='100px' style='float: left'/>
//                        <hr/>
//                    ";
//            $html .= str_replace('%CLIENTE%', 'José da Silva', $data['texto']);
//
//
//            $dompdf->loadHtml($html);
//            $dompdf->setPaper('A4', 'portrait');
//            $dompdf->render();
//
//            $pdf = $dompdf->output();
//            $arquivo = "files/exports/" . $data['file_name'] . '_' . date('Y-m-d') . '.pdf';
//            file_put_contents($arquivo,$pdf);
            $result = ['type' => 'success', 'data' => $arquivo];
        }
        $this->set(compact('arquivo'));
        $this->set('_serialize', ['arquivo']);
    }
    
    public function generateContract(){
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        $result = ['type' => 'error'];
        if($this->request->is('post')){
            $data = $this->request->data;

            $Locations = TableRegistry::get('Locations');
            $Contract = TableRegistry::get('Contract');
            $contract = $Contract->find()->first();
           
            $location = $Locations->get($data['id']);
            
            $client = Utils::getClientOnlyName($location->client_id);

            $dompdf = new DOMPDF();
            $dompdf->set_option('defaultFont', 'Helvetica');
            $html = "
                        <hr/>
                    ";
            $html .= str_replace('%CLIENTE%', $client, $contract->texto);
            $texto = str_replace('LOCADORA', 'Val Locadora de Veículos', $html);


            $dompdf->loadHtml($texto);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            $pdf = $dompdf->output();
            $arquivo = "files/exports/" . $data['file_name'] . '_' . $client . '.pdf';
            file_put_contents($arquivo,$pdf);
            $result = ['type' => 'success', 'data' => $arquivo];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
