<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;

class ClientsController extends AppController
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
        $query = $this->Clients->find();
        if (isset($data['name']) && !empty($data['name'])) {
            $query->where([
                'name LIKE' => '%' . Utils::r_acc($data['name']) . '%'
            ]);
        };
        $clients = $this->paginate($query);

        $this->set(compact('clients'));
        $this->set('_serialize', ['clients']);
    }

    public function add()
    {
        $client = $this->Clients->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;

            if(!empty($data['client_files'][0]['name'])){
                foreach($data['client_files'] as $key => $item){
                    $file = Utils::fazerUploadClients($item, 'clients', $key);
                    $data['client_files'][$key]['url_file'] = $file;
                }
            } else {
                unset($data['client_files'][0]);
            }

            $client = $this->Clients->patchEntity($client, $data);

            /* Convertendo data para padrão americano antes de salvar */
            $client->birth_date = Utils::brToDate($client->birth_date);
            $client->validity_cnh = Utils::brToDate($client->validity_cnh);
            $client->first_license = Utils::brToDate($client->first_license);
            if(strlen($client->cpf_cnpj) < 14){
                $this->Flash->error(__('O CPF/CNPJ está incorreto!'));
            }

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('Cliente salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Cliente'));
            }
        }
        $situacao = 'Cadastrar Cliente';

        $states = $this->Clients->States->find('list');

        $this->set(compact('client','situacao','states'));
        $this->set('_serialize', ['client']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $client = $this->Clients->get($id, [
            'contain' => ['ClientFiles']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->data;
            debug($data);die();
            if(!empty($data['client_files'][0]['name'])){
                foreach($data['client_files'] as $key => $item){
                    $file = Utils::fazerUploadClients($item, 'clients', $key);
                    $data['client_files'][$key]['url_file'] = $file;
                }
            } else {

                unset($data['client_files'][0]);

            }

            $client = $this->Clients->patchEntity($client, $this->request->data);

            if(strlen($client->cpf_cnpj) < 14){
                $this->Flash->error(__('O CPF/CNPJ está incorreto!'));
            }
            /* Convertendo data para padrão americano antes de salvar */
            $client->birth_date = Utils::brToDate($client->birth_date);
            $client->validity_cnh = Utils::brToDate($client->validity_cnh);
            $client->first_license = Utils::brToDate($client->first_license);

            if ($this->Clients->save($client)) {
                $this->Flash->success(__('Cliente salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Cliente'));
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

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $client = $this->Clients->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Clients->delete($client)) {
                $result = ['type' => 'success','data' => $client['name']];
            } else {
                $result = ['type' => 'error'];
            }
        } catch(\PDOException $e){
            $result = ['type' => 'vinculo', 'message' => $e->getMessage()];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function getClientInformation(){
        $result = ['type' => 'error'];

        if($this->request->is('post')){
            $data = $this->request->data;

            $client = $this->Clients->find()
                ->select([
                    'cpf' => 'Clients.cpf_cnpj',
                    'cnh' => 'Clients.cnh',
                    'city_name' => 'c.name',
                    'state_name' => 's.state_cod'
                ])
                ->innerJoin(['c' => 'cities'],['Clients.city_id = c.id'])
                ->innerJoin(['s' => 'states'],['Clients.state_id = s.id'])
                ->where([
                    'Clients.id' => $data['id']
                ])
                ->first();

            $result = ['type' => 'success','data' => $client];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
