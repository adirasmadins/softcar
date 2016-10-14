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

        if($this->request->is('post')){
            $data = $this->request->data;

            $mpdf=new \mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 10 , 10); 
 
            $mpdf->SetDisplayMode('fullpage');
             
            $texto = str_replace('%CLIENTE%', 'José da Silva', $data['texto']); 
            $mpdf->WriteHTML($texto);
                     
            $arquivo = 'files/exports/' . $data['file_name'];         
            $mpdf->Output('files/exports/' . $data['file_name'], 'F');
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
            
            $client = Utils::getAllInformationsClients($location->client_id);

            $mpdf=new \mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 10 , 10); 
 
            $mpdf->SetDisplayMode('fullpage');
            
            $img = '<img src="img/logo.png" width="200px"/><hr/>';  
            
            $search = [
                '%CLIENTE%',
                'LOCADORA',
                '%CPFCNPJ%'
            ];
            
            $replace = [
                $client['name'],
                'Val Locadora de Veículos',
                $client['cpf_cnpj']
            ];
            
            $html = $img . str_replace($search, $replace, $contract->texto);
            
            $stylesheet = file_get_contents('files/exports/style.css');

            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($html, 2);
                     
            $arquivo = 'files/exports/' . $data['file_name'];         
            $mpdf->Output('files/exports/' . $data['file_name'], 'F');
            
            $result = ['type' => 'success', 'data' => $arquivo];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
