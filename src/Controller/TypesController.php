<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;

class TypesController extends AppController
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
        $query = $this->Types->find();
        if (isset($data['name']) && !empty($data['name'])) {
            $query->where([
                'name LIKE' => '%' . Utils::r_acc($data['name']) . '%'
            ]);
        };
        $types = $this->paginate($query);

        $this->set(compact('types'));
        $this->set('_serialize', ['types']);
    }

    public function add()
    {
        $type = $this->Types->newEntity();
        if ($this->request->is('post')) {
            $type = $this->Types->patchEntity($type, $this->request->data);
            if ($this->Types->save($type)) {
                $this->Flash->success(__('The type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The type could not be saved. Please, try again.'));
            }
        }
        $situacao = 'Cadastrar Tipos de veículo';
        $this->set(compact('type','situacao'));
        $this->set('_serialize', ['type']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $type = $this->Types->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $type = $this->Types->patchEntity($type, $this->request->data);
            if ($this->Types->save($type)) {
                $this->Flash->success(__('The type has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The type could not be saved. Please, try again.'));
            }
        }
        $situacao = 'Editar Tipos de veículo';

        $this->set(compact('type','situacao'));
        $this->set('_serialize', ['type']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $type = $this->Types->get($data['id']);
        $result = ['type' => 'error'];

        if ($this->Types->delete($type)) {
            $result = ['type' => 'success','data' => $type['name']];
        } else {
            $result = ['type' => 'error'];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
