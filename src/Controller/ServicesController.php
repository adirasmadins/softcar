<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;

class ServicesController extends AppController
{

    public function index()
    {
        $this->paginate = [
            'contain' => ['Vehicles']
        ];
        $services = $this->paginate($this->Services);

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
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The service could not be saved. Please, try again.'));
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
                $this->Flash->success(__('The service has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The service could not be saved. Please, try again.'));
            }
        }

        $situacao = 'Editar Serviço/Manutenção';

        $this->Services->Vehicles->displayField('model');
        $vehicles = $this->Services->Vehicles->find('list');

        $this->set(compact('service', 'situacao','vehicles'));
        $this->set('_serialize', ['service']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $service = $this->Services->get($id);
        if ($this->Services->delete($service)) {
            $this->Flash->success(__('The service has been deleted.'));
        } else {
            $this->Flash->error(__('The service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
