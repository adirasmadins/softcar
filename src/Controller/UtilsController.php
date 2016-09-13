<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class UtilsController extends AppController
{

    public function citiesList(){
        $result = ['status' => 'error', 'data' => ''];
        if($this->request->is('post')){
            $data = $this->request->data;

            $Cities = TableRegistry::get('Cities');
            $filterCity = $Cities->find()
                ->where(['state_id' => $data['id']]);

            if($filterCity){
                $result = ['status' => 'success', 'data' => $filterCity];
            } else {
                $result = ['status' => 'error', 'data' => ''];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
