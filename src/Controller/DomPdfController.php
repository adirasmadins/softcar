<?php
namespace App\Controller;

use App\Controller\AppController;
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

            $mpdf=new \mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
 
            $mpdf->SetDisplayMode('fullpage');
             
            $mpdf->WriteHTML("dsadasdasdaa");
                     
            $mpdf->Output();
            exit;
            
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
            $result = ['type' => 'success', 'data' => ''];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
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
