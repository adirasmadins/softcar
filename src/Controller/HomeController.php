<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class HomeController extends AppController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function login() {
        $this->viewBuilder()->layout(false);
        $result = ['type' => 'error'];
        if ($this->request->is('post')) {
            $data = $this->request->data;

            $user = $this->Auth->identify($data);

            if ($user) {
                if($user['status'] == 1){
                    $ProfileMenus = TableRegistry::get('ProfileMenus');
                    $permissions = $ProfileMenus->find()
                        ->where([
                            'profile_id' => $user['profile_id']
                        ])
                        ->limit(1)
                        ->first();
                        
                    if(count($permissions)){
                        $result = [
                            'type' => 'success',
                            'title' => 'Bem vindo(a), ' . $user['name'],
                            'text' => 'Você será redirecionado(a) em 3 segundos',
                        ];
                        $this->Auth->setUser($user);
                    } else {
                        $result = [
                            'type' => 'error',
                            'title' => 'Encontramos um problema ao entrar',
                            'text' => 'Não há nenhuma permissão para seu perfil'
                        ];
                    }
                } else {
                    $result = [
                        'type' => 'error',
                        'title' => 'Encontramos um problema ao entrar',
                        'text' => 'Seu usuário está inativo'
                    ];
                }
            } else {
                $result = [
                    'type' => 'error',
                    'title' => 'Encontramos um problema ao entrar',
                    'text' => 'Usuário ou senha incorretos'
                ];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}
