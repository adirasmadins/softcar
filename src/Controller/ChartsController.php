<?php
namespace App\Controller;

use App\Controller\AppController;

class ChartsController extends AppController
{
    public function getPdf(){
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        $result = ['type' => 'error'];
        if($this->request->is('post')){
            $data = $this->request->data;

            $mpdf = new \mPDF();
            $html = "
                    <!DOCTYPE html>
                    <html>
                    <body style='font-family: Arial'>

                    <div style='text-align: center'>
                        <h1>{$data['title']}</h1>
                        <hr/>
                        <img src='{$data['url']}' style='margin-top: 40px'/>
                    </div>

                    </body>
                    </html>";


            $mpdf->WriteHTML($html);

            $arquivo = 'files/exports/' . $data['file_name'];         
            $mpdf->Output('files/exports/' . $data['file_name'], 'F');
            
            $result = ['type' => 'success', 'data' => $arquivo];
        }
        $this->set(compact('arquivo'));
        $this->set('_serialize', ['arquivo']);
    }
}
