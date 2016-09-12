<?php
namespace App\Controller;

use App\Controller\AppController;
use Dompdf\Dompdf;
use Dompdf\Options;

class ChartsController extends AppController
{
    public function getPdf(){
        $result = ['type' => 'error'];
        if($this->request->is('post')){
            $data = $this->request->data;

            $dompdf = new DOMPDF();
            $dompdf->set_option('defaultFont', 'Helvetica');
            $html = "
                    <!DOCTYPE html>
                    <html>
                    <body>

                    <center>
                        <h1>{$data['title']}</h1>
                        <img src='{$data['url']}'/>
                    </center>

                    </body>
                    </html>
                    ";


            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
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
