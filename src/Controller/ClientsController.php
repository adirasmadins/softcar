<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 */
class ClientsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cities', 'States']
        ];
        $clients = $this->paginate($this->Clients);

        $this->set(compact('clients'));
        $this->set('_serialize', ['clients']);
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['Cities', 'States', 'Locations', 'Reserves', 'Tickets']
        ]);

        $this->set('client', $client);
        $this->set('_serialize', ['client']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {
            $client = $this->Clients->patchEntity($client, $this->request->data);

            /* Convertendo data para padrão americano antes de salvar */
            $client->birth_date = Utils::brToDate($client->birth_date);
            $client->validity_cnh = Utils::brToDate($client->validity_cnh);
            $client->first_license = Utils::brToDate($client->first_license);

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }
        $situacao = 'Cadastrar Cliente';

        $states = $this->Clients->States->find('list');

        $this->set(compact('client','situacao','states'));
        $this->set('_serialize', ['client']);
        $this->render('form');
    }

    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $client = $this->Clients->patchEntity($client, $this->request->data);

            /* Convertendo data para padrão americano antes de salvar */
            $client->birth_date = Utils::brToDate($client->birth_date);
            $client->validity_cnh = Utils::brToDate($client->validity_cnh);
            $client->first_license = Utils::brToDate($client->first_license);

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('The client has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The client could not be saved. Please, try again.'));
            }
        }

        $situacao = 'Editar Cliente';
        $states = $this->Clients->States->find('list');

        /*Convertendo as datas do modelo americano para o brasileiro */
        $client->birth_date=$client->birth_date->i18nFormat('dd/MM/yyyy');
        $client->validity_cnh=$client->validity_cnh->i18nFormat('dd/MM/yyyy');
        $client->first_license=$client->first_license->i18nFormat('dd/MM/yyyy');

        $this->set(compact('client','situacao','states'));
        $this->set('_serialize', ['client']);
        $this->render('form');
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $client = $this->Clients->get($id);
        if ($this->Clients->delete($client)) {
            $this->Flash->success(__('The client has been deleted.'));
        } else {
            $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
