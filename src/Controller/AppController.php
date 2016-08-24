<?php

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;

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

        if($user_online) {
            $ProfileMenus = TableRegistry::get('ProfileMenus');

            $profile = $ProfileMenus->find()
                ->hydrate(false)
                ->contain(['Menus'])
                ->where(['profile_id' => $user_online['profile_id']])
                ->toArray();

            $modules = [];
            foreach ($profile as $module) {
                array_push($modules, $module['menu']['controller']);
            }

            /* Validações de Menus */
            $Menus = TableRegistry::get('Menus');

            $NavMenus = $Menus->find('threaded')
                ->hydrate(false)
                ->where(['controller in' => $modules])
                ->orWhere('controller is null')
                ->toArray();

            $hasPermission = false;
            $hasDash = false;
            foreach ($NavMenus as $key => $item) {
                if (empty($item['children']) && empty($item['controller'])) {
                    unset($NavMenus[$key]);
                }
                if (in_array($this->request->controller, $item)) {
                    $hasPermission = true;
                }
                if (in_array('Dashboard', $item)) {
                    $hasDash = true;
                }
                if (!empty($item['children'])) {
                    foreach ($item['children'] as $child) {
                        if (in_array($this->request->controller, $child)) {
                            $hasPermission = true;
                        }
                    }
                }
            }

            if ($this->request->action == 'logout' || $this->request->controller == 'Utils') {
                $hasPermission = true;
            }

            if (!$hasDash) {
                $firstPermission = $NavMenus['0']['controller'];
            }

            if (!$hasPermission) {
                if (isset($firstPermission)) {
                    return $this->redirect(['controller' => $firstPermission]);
                }
                throw new NotFoundException();
            }
        }

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
