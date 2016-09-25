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

            $reserve->date_start = Utils::brToDate($reserve->date_start);
            $reserve->date_end = Utils::brToDate($reserve->date_end);
            $reserve->total = str_replace('.', '', number_format(str_replace('R$ ', '', (float) $reserve->total), 2, ',','.'));
            if ($this->Reserves->save($reserve)) {
                $this->Flash->success(__('The reserve has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reserve could not be saved. Please, try again.'));
            }
        }
        $situacao = 'Editar Reserva';
        $clients = $this->Reserves->Clients->find('list');

        $Vehicles = TableRegistry::get('Vehicles');
        $url = $Vehicles->find()
            ->select('picture')
            ->where([
                'id' => $reserve->vehicle_id
            ])
            ->first();

        $reserve->vehicle_picture = $this->request->webroot . $url->picture;
        $reserve->date_start = $reserve->date_start->i18nFormat('dd/MM/yyyy');
        $reserve->date_end = $reserve->date_end->i18nFormat('dd/MM/yyyy');
        $reserve->remove_schedule = $reserve->remove_schedule->i18nFormat('H:i');
        $reserve->devolution_schedule = $reserve->devolution_schedule->i18nFormat('H:i');

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
                ->hydrate(false)
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

            if(!empty($data['idVehicleAllow'])){
                $result->where([
                    'vehicle_id <>' => (int) $data['idVehicleAllow']
                ]);
            }
            $Vehicles = TableRegistry::get('Vehicles');

            if(count($result->toArray())){

                $result = $result->toArray();

                $ids = [];
                foreach($result as $vehicle){
                    array_push($ids, $vehicle['vehicle']);
                }

                $vehicles_list = $Vehicles->find()
                    ->select([
                        'id',
                        'model',
                        'plate',
                        'picture',
                        'day_price'
                    ])
                    ->where([
                        'id NOT IN' => $ids
                    ]);

                if(count($vehicles_list->toArray())){
                    $result = $vehicles_list->toArray();
                } else {
                    $result = false;
                }
            } else {
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
