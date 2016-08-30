<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\Database\Schema\Table;
use Cake\ORM\TableRegistry;
use Phinx\Util\Util;
use Aura\Intl\Exception;
use Cake\Core\Configure;
use Cake\Mailer\Email;

class UsersController extends AppController
{
    public $paginate = [
        'limit' => 7,
    ];

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow('recoverPassword');
        $this->Auth->allow('changePassword');
    }

    public function index()
    {
        $data = $this->request->query;
        $query = $this->Users->find();
        if (isset($data['name']) && !empty($data['name'])) {
            $query->where([
                'name LIKE' => '%' . Utils::r_acc($data['name']) . '%'
            ]);
        };
        $users = $this->paginate($query);

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

        try{
            if ($this->Users->delete($user)) {
                $result = ['type' => 'success','data' => $user['name']];
            } else {
                $result = ['type' => 'error'];
            }
        } catch(\PDOException $e){
            $result = ['type' => 'vinculo', 'message' => $e->getMessage()];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function recoverPassword(){
        $result = ['type' => 'error'];
        if($this->request->is('post')){
            $data = $this->request->data;

            $user = $this->Users->find()
                ->where([
                    'email' => $data['email']
                ])
                ->first();

            if(count($user)){
                $user->token = $this->Token->generate(64);
                if($this->Users->save($user)){
                    $this->set('send', true);
                    $this->set('email', $user->email);
                    try {
                        $emailSend = new Email('default');
                        $emailSend
                            ->template('recover_password')
                            ->emailFormat('html')
                            ->to($user->email)
                            ->from(Configure::read('EmailFrom'))
                            ->subject('Recuperação de Senha')
                            ->viewVars(['token' => $user->token,'data' => $user])
                            ->send();
                    } catch (Exception $exc) {
                        die($exc->getMessage());
                    }

                    $result = ['type' => 'success'];
                }
            } else {
                $result = ['type' => 'not_user'];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function changePassword(){
        $this->viewBuilder()->layout(false);
        if($this->request->is('get')){
            $query = $this->request->query;
            $token = $query['token'];

            $user = $this->Users->find()
                ->where([
                    'token' => $token
                ])
                ->first();

            if($user){
                $this->set(compact('user'));
            } else {
                $this->redirect(['controller' => 'Home','action' => 'login']);
            }
        }

        if($this->request->is('post')){
            $this->RequestHandler->renderAs($this, 'json');
            $data = $this->request->data;

            $user_save = $this->Users->get($data['id'], [
                'contain' => []
            ]);

            $user_save->token = $this->Token->generate(64);
            $user_save = $this->Users->patchEntity($user_save, $data);
            if ($this->Users->save($user_save)) {
                $result = ['type' => 'success'];
            } else {
                $result = ['type' => 'error'];
            }

            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
    }
}
