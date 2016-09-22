<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;

class ReservesController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Vehicles']
        ];
        $reserves = $this->paginate($this->Reserves);

        $this->set(compact('reserves'));
        $this->set('_serialize', ['reserves']);
    }

    public function add()
    {
        $reserve = $this->Reserves->newEntity();
        if ($this->request->is('post')) {
            $reserve = $this->Reserves->patchEntity($reserve, $this->request->data);
            if ($this->Reserves->save($reserve)) {
                $this->Flash->success(__('The reserve has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reserve could not be saved. Please, try again.'));
            }
        }
        $situacao = 'Cadastrar Reserva';

        $clients = $this->Reserves->Clients->find('list');
        $this->set(compact('reserve', 'situacao','clients'));
        $this->set('_serialize', ['reserve']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $reserve = $this->Reserves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reserve = $this->Reserves->patchEntity($reserve, $this->request->data);
            if ($this->Reserves->save($reserve)) {
                $this->Flash->success(__('The reserve has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reserve could not be saved. Please, try again.'));
            }
        }
        $situacao = 'Editar Reserva';
        
        $this->set(compact('reserve', 'situacao'));
        $this->set('_serialize', ['reserve']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reserve = $this->Reserves->get($id);
        if ($this->Reserves->delete($reserve)) {
            $this->Flash->success(__('The reserve has been deleted.'));
        } else {
            $this->Flash->error(__('The reserve could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getVehiclesByDateAndSchedule(){
        if($this->request->is('post')){
            $data = $this->request->data;
            $result = $this->Reserves->find()
                ->select([
                    'vehicle' => 'vehicle_id'
                ])
                ->where([
                    'date_start BETWEEN :date_start1 AND :date_end1'
                ])
                ->orWhere([
                    'date_end BETWEEN :date_start2 AND :date_end2'
                ])
                ->bind(':date_start1', Utils::brToDate($data['date_start']), 'date')
                ->bind(':date_start2', Utils::brToDate($data['date_start']), 'date')
                ->bind(':date_end1', Utils::brToDate($data['date_end']),'date')
                ->bind(':date_end2', Utils::brToDate($data['date_end']),'date');


        }
    }
}
