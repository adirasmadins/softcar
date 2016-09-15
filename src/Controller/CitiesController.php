<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;


class CitiesController extends AppController
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
        $query = $this->Cities->find()->order('name');
        if (isset($data['name']) && !empty($data['name'])) {
            $query->where([
                'name LIKE' => '%' . Utils::r_acc($data['name']) . '%'
            ]);
        };
        $cities = $this->paginate($query);

        $this->set(compact('cities'));
        $this->set('_serialize', ['cities']);
    }

    public function add()
    {
        $city = $this->Cities->newEntity();
        if ($this->request->is('post')) {
            $city = $this->Cities->patchEntity($city, $this->request->data);
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('Cidade salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Cidade'));
            }
        }
        $situacao = 'Cadastrar Cidade';
        $states = $this->Cities->States->find('list');
        $this->set(compact('city', 'states', 'situacao'));
        $this->set('_serialize', ['city']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $city = $this->Cities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $city = $this->Cities->patchEntity($city, $this->request->data);
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Cidade'));
            }
        }
        $situacao = 'Cadastrar Cidade';
        $states = $this->Cities->States->find('list');

        $this->set(compact('city', 'states','situacao'));
        $this->set('_serialize', ['city']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $city = $this->Cities->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Cities->delete($city)) {
                $result = ['type' => 'success','data' => $city['name']];
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
