<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\ORM\TableRegistry;

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

            $reserve->date_start = Utils::brToDate($reserve->date_start);
            $reserve->date_end = Utils::brToDate($reserve->date_end);
            $reserve->reserve_date = date('Y-m-d');
            $reserve->total = str_replace('.', '', number_format(str_replace('R$ ', '', (float) $reserve->total), 2, ',','.'));

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
        $clients = $this->Reserves->Clients->find('list');

        $reserve->date_start = $reserve->date_start->i18nFormat('dd/MM/yyyy');
        $reserve->date_end = $reserve->date_end->i18nFormat('dd/MM/yyyy');

        $this->set(compact('reserve', 'situacao','clients'));
        $this->set('_serialize', ['reserve']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $reserve = $this->Reserves->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Reserves->delete($reserve)) {
                $result = ['type' => 'success','data' => ''];
            } else {
                $result = ['type' => 'error'];
            }
        } catch(\PDOException $e){
            $result = ['type' => 'vinculo', 'message' => $e->getMessage()];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function getVehiclesByDateAndSchedule(){
        $result = ['type' => 'error', 'data' => false];
        if($this->request->is('post')){
            $data = $this->request->data;
            $result = $this->Reserves->find()
                ->select([
                    'vehicle' => 'vehicle_id'
                ])
                ->where([
                    'date_start BETWEEN :date_start AND :date_end'
                ])
                ->orWhere([
                    'date_end BETWEEN :date_start AND :date_end'
                ])
                ->bind(':date_start', Utils::brToDate($data['date_start']), 'date')
                ->bind(':date_end', Utils::brToDate($data['date_end']),'date');
                
                if(count($result->toArray())){
                    $result = $result->toArray();
                    $Vehicles = TableRegistry::get('Vehicles');
                    $vehicles_list = $Vehicles->find()
                        ->where([
                            'id NOT IN' => $result
                        ]);
                    if(count($vehicles_list->toArray())){
                        $result = $vehicles_list->toArray();
                    } else {
                        $result = false;
                    }
                } else {
                    $Vehicles = TableRegistry::get('Vehicles');
                    $vehicles_list = $Vehicles->find();
                    if(count($vehicles_list->toArray())){
                        $result = $vehicles_list->toArray();
                    } else {
                        $result = false;
                    }
                }
                $result = ['type' => 'success', 'data' => $result];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
