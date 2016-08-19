<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

class AppController extends Controller
{
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Token');
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Home',
                'action' => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'Home',
                'action' => 'login'
            ],
            'unauthorizedRedirect' => [
                'controller' => 'Home',
                'action' => 'login'
            ],
            'authenticate' => [
                'Form' => [
                    'passwordHasher' => [
                        'className' => 'Sha512',
                    ],
                    'fields' => ['username' => 'login'],
                    // 'finder' => 'auth',
                    'userModel' => 'Users'
                ],
            ],
        ]);
        $user_online =  $this->request->session()->read('Auth.User');

        /* Validações de Menus */
        $Menus = TableRegistry::get('Menus');

        $NavMenus = $Menus->find('threaded')
            ->hydrate(false)
            ->toArray();

        $this->set(compact('NavMenus','user_online'));
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
