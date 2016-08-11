<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

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
                    'fields' => ['username' => 'email'],
                    // 'finder' => 'auth',
                    'userModel' => 'Users'
                ],
            ],
        ]);
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
