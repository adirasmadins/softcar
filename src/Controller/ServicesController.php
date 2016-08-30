<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;

class ServicesController extends AppController
{

    public function index()
    {
        $data = $this->request->query;
        $query = $this->Services->find();
        if (isset($data['plate']) && !empty($data['plate'])) {
            $id =  Utils::getVehicleId($data['plate']);
            $query->where(['vehicle_id' => $id]);
        };
        $services = $this->paginate($query);

        $this->set(compact('services'));
        $this->set('_serialize', ['services']);
    }

    public function add()
    {
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {
            $service = $this->Services->patchEntity($service, $this->request->data);

            $service->make_date = Utils::brToDate($service->make_date);
            if ($this->Services->save($service)) {
                $this->Flash->success(__('Serviço salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Serviço'));
            }
        }
        $situacao = 'Cadastrar Serviço/Manutenção';

        $this->Services->Vehicles->displayField('model');
        $vehicles = $this->Services->Vehicles->find('list');

        $this->set(compact('service', 'situacao','vehicles'));
        $this->set('_serialize', ['service']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->data);
            $service->make_date = Utils::brToDate($service->make_date);
            if ($this->Services->save($service)) {
                $this->Flash->success(__('Serviço salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Serviço'));
            }
        }

        $situacao = 'Editar Serviço/Manutenção';

        if(count($service->make_date)){
            $service->make_date = $service->make_date->i18nFormat('dd/MM/yyyy');
        }

        $this->Services->Vehicles->displayField('model');
        $vehicles = $this->Services->Vehicles->find('list');

        $this->set(compact('service', 'situacao','vehicles'));
        $this->set('_serialize', ['service']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $service = $this->Services->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Services->delete($service)) {
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
}
