<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\Database\Schema\Table;
use Cake\ORM\TableRegistry;
use Phinx\Util\Util;

class LocationsController extends AppController
{
    public $paginate = [
        'limit' => 7,
    ];

    public function initialize()
    {
        parent::initialize();
    }

    public function index()
    {
        $data = $this->request->query;
        $query = $this->Locations->find();
        if (isset($data['plate']) && !empty($data['plate'])) {
            $id =  Utils::getVehicleId($data['plate']);
            $query->where(['vehicle_id' => $id]);
        };
        $locations = $this->paginate($query);

        $this->set(compact('locations'));
        $this->set('_serialize', ['locations']);
    }

    public function add()
    {
        $location = $this->Locations->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;

            $location = $this->Locations->patchEntity($location, $data);

            $location->out_date = Utils::brToDate($location->out_date);
            $location->return_date = Utils::brToDate($location->return_date);
            $location->location_date = date('Y-m-d');
            $location->status = 0;
            $location->free_km = $location->free_km == 'on' ? 1 : 0;
            $location->start_value = (float) $location->start_value;
            $location->payment_date = null;
            $location->client_id = $location->client_id_hidden;
            $location->vehicle_id = $location->vehicle_id_hidden;
            if($location->free_km != 1){
                $this->updateLastKmVehicle($location->vehicle_id, $location->start_km + $location->allowed_km);
            }
            unset($location->client_id_hidden);
            unset($location->vehicle_id_hidden);

            if ($this->Locations->save($location)) {
                $this->Flash->success(__('Locação salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Locação'));
            }
        }
        $situacao = 'Cadastrar Locação';
        $clients = $this->Locations->Clients->find('list');
        $drivers = $this->Locations->Drivers->find('list');

        $Reserves = TableRegistry::get('Reserves');
        $reserves = $Reserves->find()
            ->hydrate(false)
            ->where([
                'date_start >=' => date('Y-m-d'),
                'status' => 1
            ]);

        if(count($reserves)){
            $reserves = $reserves->toArray();
        } else {
            $reserves = false;
        }

        $this->set(compact('location','situacao','reserves','clients','drivers'));
        $this->set('_serialize', ['location','reserves','clients','drivers']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $location = $this->Locations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $location = $this->Locations->patchEntity($location, $this->request->data);
            if ($this->Locations->save($location)) {
                $this->Flash->success(__('Locação salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Locação'));
            }
        }
        $situacao = 'Editar Locação';

        $this->set(compact('location','situacao'));
        $this->set('_serialize', ['location']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $location = $this->Locations->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Locations->delete($location)) {
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

    public function export(){
        $cars = $this->Locations->find()
            ->select([
                'ids' => 'DISTINCT vehicle_id'
            ]);

        if(count($cars->toArray())){
            $cars = $cars->toArray();

            $vehicles_ids = [];
            foreach($cars as $item){
                array_push($vehicles_ids, $item['ids']);
            }

            $this->Locations->Vehicles->displayField('model');
            $vehicles = $this->Locations->Vehicles->find('list')
                ->where([
                    'id in' => $vehicles_ids
                ]);
            $vehicles = $vehicles->toArray();
        } else {
            $cars = false;
            $vehicles = ['0' => 'Não há locação'];
        }

        $this->set(compact('vehicles'));
        $this->set('_serialize', ['vehicles']);
    }

    public function populateGraph(){
        $result = ['type' => 'error', 'data' => ''];
        if($this->request->is('post')){
            $data = $this->request->data;

            $entity = $this->Locations->find()->hydrate(false);

            if (!empty($data['vehicle']['_ids'])) {
                $locations_list = $entity->where([
                    'Locations.vehicle_id in' => $data['vehicle']['_ids']
                ]);
            }

            if (!empty($data['out_date'])) {
                list($d, $m, $y) = explode('/', $data['out_date']);
                $locations_list = $entity->where([
                    'Locations.out_date >=' => $y . '-' . $m . '-' . $d
                ]);
            }

            if (!empty($data['return_date'])) {
                list($d, $m, $y) = explode('/', $data['return_date']);
                $locations_list = $entity->where([
                    'Locations.return_date <=' => $y . '-' . $m . '-' . $d
                ]);
            }

            $locations_list = $entity
                ->select([
                    'id' => 'Locations.id',
                    'model' => 'v.model',
                    'plate' => 'v.plate',
                    'qtdLocations' => 'count(vehicle_id)'
                ])
                ->innerJoin(['v' => 'vehicles'],['Locations.vehicle_id = v.id'])
                ->group('Locations.vehicle_id');

            if(count($locations_list)){
                $locations_list = $locations_list->toArray();
                $result = ['type' => 'success', 'data' => $locations_list];
            } else {
                $locations_list = false;
                $result = ['type' => 'error', 'data' => ''];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function updateLastKmVehicle($vehicle, $last_km){
        $Vehicles = TableRegistry::get('Vehicles');
        $vehicle = $Vehicles->get($vehicle);

        $vehicle_registry = [
            'id' => $vehicle->id
        ];

        $vehicle = $Vehicles->patchEntity($vehicle, $vehicle_registry);
        $vehicle->last_km = $last_km;
        $Vehicles->save($vehicle);
    }
}
