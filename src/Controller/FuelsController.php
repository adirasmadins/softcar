<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;

class FuelsController extends AppController
{

    public function index()
    {
        $data = $this->request->query;
        $query = $this->Fuels->find();
        if (isset($data['name']) && !empty($data['name'])) {
            $query->where([
                'name LIKE' => '%' . Utils::r_acc($data['name']) . '%'
            ]);
        };
        $fuels = $this->paginate($query);

        $this->set(compact('fuels'));
        $this->set('_serialize', ['fuels']);
    }

    public function add()
    {
        $fuel = $this->Fuels->newEntity();
        if ($this->request->is('post')) {
            $fuel = $this->Fuels->patchEntity($fuel, $this->request->data);
            if ($this->Fuels->save($fuel)) {
                $this->Flash->success(__('Combustível salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Combustível'));
            }
        }
        $situacao = 'Cadastrar Combustível';

        $this->set(compact('fuel','situacao'));
        $this->set('_serialize', ['fuel']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $fuel = $this->Fuels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fuel = $this->Fuels->patchEntity($fuel, $this->request->data);
            if ($this->Fuels->save($fuel)) {
                $this->Flash->success(__('Combustível salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Combustível'));
            }
        }
        $situacao = 'Editar Combustível';

        $this->set(compact('fuel','situacao'));
        $this->set('_serialize', ['fuel']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $fuel = $this->Fuels->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Fuels->delete($fuel)) {
                $result = ['type' => 'success','data' => $fuel['name']];
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
