<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\Database\Schema\Table;
use Cake\ORM\TableRegistry;
use Phinx\Util\Util;

class UsersController extends AppController
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
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            /* Convertendo data para padrão americano antes de salvar */
            $user->birth_date = Utils::brToDate($user->birth_date);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Usuário'));
            }
        }
        $situacao = 'Cadastrar Usuário';
        $Profiles = TableRegistry::get('Profiles');
        $profiles = $Profiles->find('list');
        $states = $this->Users->States->find('list');
        $this->set(compact('user','situacao', 'states','profiles'));
        $this->set('_serialize', ['user']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);

            /* Convertendo data para padrão americano antes de salvar */
            $user->birth_date = Utils::brToDate($user->birth_date);

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Usuário salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Usuário'));
            }
        }
        $situacao = 'Editar Usuário';

        $Profiles = TableRegistry::get('Profiles');
        $profiles = $Profiles->find('list');

        $states = $this->Users->States->find('list');

        if($user->birth_date){
            $user->birth_date = $user->birth_date->i18nFormat('dd/MM/YYYY');
        }
        $this->set(compact('user','situacao','profiles','states'));
        $this->set('_serialize', ['user']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $user = $this->Users->get($data['id']);
        $result = ['type' => 'error'];

        if ($this->Users->delete($user)) {
            $result = ['type' => 'success','data' => $user['name']];
        } else {
            $result = ['type' => 'error'];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
