<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Lib\Utils;


class ProfilesController extends AppController
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
        $query = $this->Profiles->find();
        if (isset($data['name']) && !empty($data['name'])) {
            $query->where([
                'name LIKE' => '%' . Utils::r_acc($data['name']) . '%'
            ]);
        };
        $profiles = $this->paginate($query);

        $this->set(compact('profiles'));
        $this->set('_serialize', ['profiles']);
    }

    public function add()
    {
        $profile = $this->Profiles->newEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('Perfil salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Perfil'));
            }
        }
        $situacao = 'Cadastrar Perfil';

        $Menus = TableRegistry::get('Menus');
        $Menus->displayField('text');
        $menus = $Menus->find('list')->where(['controller is not null']);

        $this->set(compact('profile','situacao','menus'));
        $this->set('_serialize', ['profile']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => ['Menus']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('Perfil salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Perfil'));
            }
        }

        $situacao = 'Cadastrar Perfil';

        $Menus = TableRegistry::get('Menus');
        $Menus->displayField('text');
        $menus = $Menus->find('list')->where(['controller is not null']);

        $this->set(compact('profile','situacao','menus'));
        $this->set('_serialize', ['profile']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $profile = $this->Profiles->get($data['id']);
        $result = ['type' => 'error'];

        if ($this->Profiles->delete($profile)) {
            $result = ['type' => 'success','data' => $profile['name']];
        } else {
            $result = ['type' => 'error'];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
