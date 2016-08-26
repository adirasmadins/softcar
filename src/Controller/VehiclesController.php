<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Lib\Utils;


class VehiclesController extends AppController
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
        $query = $this->Vehicles->find();
        if (isset($data['plate']) && !empty($data['plate'])) {
            $query->where([
                'plate LIKE' => '%' . $data['plate'] . '%'
            ]);
        };
        $vehicles = $this->paginate($query);

        $this->set(compact('vehicles'));
        $this->set('_serialize', ['vehicles']);
    }

    public function add()
    {
        $vehicle = $this->Vehicles->newEntity();
        if ($this->request->is('post')) {

            $data = $this->request->data;

            $file = Utils::fazerUpload($data, 'vehicles');

            $vehicle = $this->Vehicles->patchEntity($vehicle, $data);

            if ($file) {
                $vehicle->picture = '/' . $file;
            }

            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success(__('Veículo salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Veículo'));
            }
        }
        $situacao = 'Cadastrar Veículo';

        $types = $this->Vehicles->Types->find('list');
        $fuels = $this->Vehicles->Fuels->find('list');

        $this->set(compact('vehicle', 'situacao','types','fuels'));
        $this->set('_serialize', ['vehicle']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $vehicle = $this->Vehicles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;

            $file = Utils::fazerUpload($data, 'vehicles');

            $vehicle = $this->Vehicles->patchEntity($vehicle, $data);

            if ($file) {
                $vehicle->picture = '/' . $file;
            }

            if(empty($vehicle->picture) && !empty($vehicle->current_picture)){
                $vehicle->picture = $vehicle->current_picture;
            }

            if ($this->Vehicles->save($vehicle)) {
                $this->Flash->success(__('Veículo salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Veículo'));
            }
        }
        $situacao = 'Editar veículo';

        $types = $this->Vehicles->Types->find('list');
        $fuels = $this->Vehicles->Fuels->find('list');

        $this->set(compact('vehicle', 'situacao','types','fuels'));
        $this->set('_serialize', ['vehicle']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $vehicle = $this->Vehicles->get($data['id']);
        $result = ['type' => 'error'];

        if ($this->Vehicles->delete($vehicle)) {
            $result = ['type' => 'success','data' => $vehicle['model']];
        } else {
            $result = ['type' => 'error'];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
