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
        $this->loadComponent('XLSXExporter');
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

            /* Definindo Permissões de acordo com usuário online */
            $UsersEntity = TableRegistry::get('Users');
            $user_online = $UsersEntity->find()
                ->hydrate(false)
                ->select([
                    'id' => 'Users.id',
                    'name' => 'Users.name',
                    'profile_id' => 'profile_id',
                    'profile_name' => 'p.name',
                ])
                ->where([
                    'Users.id' => $user_online['id']
                ])
                ->innerJoin(['p' => 'profiles'],['Users.profile_id = p.id'])
                ->first();

            $ProfileMenus = TableRegistry::get('ProfileMenus');

            $profile = $ProfileMenus->find()
                ->hydrate(false)
                ->contain(['Menus'])
                ->where(['profile_id' => $user_online['profile_id']])
                ->toArray();

            if(count($profile) == 0){
              return $this->redirect(['controller' => 'Home', 'action' => 'logout']);
            }

            $modules = [];
            foreach ($profile as $module) {
                array_push($modules, $module['menu']['controller']);
            }

            $Menus = TableRegistry::get('Menus');

            $NavMenus = $Menus->find('threaded')
                ->hydrate(false)
                ->where(['controller in' => $modules])
                ->orWhere('controller is null')
                ->order('sequence')
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

            if ($this->request->action == 'logout' || $this->request->controller == 'Utils' || $this->request->controller == 'Charts' || $this->request->controller == 'DomPdf') {
                $hasPermission = true;
            }

            if($this->request->is('ajax')){
              $hasPermission = true;
            }

            if (!$hasDash) {
              foreach($NavMenus as $k => $v):
                if(is_null($v['controller'])){
                  $firstPermission = $v['children']['0']['controller'];
                } else {
                  $firstPermission = $NavMenus[$k]['controller'];
                }
              endforeach;
            }

            if (!$hasPermission) {
                if (isset($firstPermission)) {
                    return $this->redirect(['controller' => $firstPermission]);
                }
                throw new NotFoundException();
            }

            /* Fim Definição de Permissões */

            /* Verificando tarifas */
            $RatesEntity = TableRegistry::get('Rates');
            $rates_list = $RatesEntity->find()
                ->hydrate(false)
                ->select([
                    'id' => 'Rates.id',
                    'vehicle' => 'v.model',
                    'plate' => 'v.plate',
                    'dpvat_status' => 'Rates.depvat_status',
                    'dpvat' => 'DATEDIFF(Rates.depvat_expiration, CURDATE())',
                    'ipva_status' => 'Rates.ipva_status',
                    'ipva' => 'DATEDIFF(Rates.ipva_expiration, CURDATE())',
                    'licensing_status' => 'Rates.licensing_status',
                    'licensing' => 'DATEDIFF(Rates.licensing_expiration, CURDATE())'
                ])
                ->where([
                    'Rates.depvat_expiration >=' => date('Y-m-d')
                ])
                ->orWhere([
                    'Rates.ipva_expiration >=' => date('Y-m-d')
                ])
                ->orWhere([
                    'Rates.licensing_expiration >=' => date('Y-m-d')
                ])
                ->where([
                    'Rates.ipva_status' => 0
                ])
                ->orWhere([
                    'Rates.depvat_status' => 0
                ])
                ->orWhere([
                    'Rates.licensing_status' => 0
                ])
                ->innerJoin(['v' => 'vehicles'],['Rates.vehicle_id = v.id']);

            if(count($rates_list)){
                $rates_list = $rates_list->toArray();
            } else {
                $rates_list = false;
            }

            foreach($rates_list as $key1 => $rate){
                foreach($rate as $key2 => $value){
                    if(strpos($key2, 'status')){
                        $type = explode("_", $key2);
                        if($value != 0){
                            unset($rates_list[$key1][$type[0]]);
                            unset($rates_list[$key1][$type[0] . '_status']);
                            unset($rates_list[$key1][$key2]);
                        }
                    }
                    if($value < 0 || $value > 30){
                        unset($rates_list[$key1][$key2]);
                    }
                }
            }

            /* Fim verificação Tarifas*/

            /* Inicio Verificação Multas */
            $TicketsEntity = TableRegistry::get('Tickets');
            $tickets_list = $TicketsEntity->find()
                ->hydrate(false)
                ->select([
                    'id' => 'Tickets.id',
                    'vehicle' => 'v.model',
                    'plate' => 'v.plate',
                    'days' => 'DATEDIFF(Tickets.due_date, CURDATE())',
                ])
                ->innerJoin(['v' => 'vehicles'],['Tickets.vehicle_id = v.id'])
                ->where([
                    'Tickets.status' => 0
                ]);

            if(count($tickets_list)){
                $tickets_list = $tickets_list->toArray();
            } else {
                $tickets_list = false;
            }

            foreach($tickets_list as $key => $ticket){
                foreach($ticket as $key2 => $value){
                    if($value < 0 || $value > 30){
                        unset($tickets_list[$key]);
                    }
                }
            }
            /* Fim Verificação Multas */

            /* Verificando porcentagem de veículos locados */
            $Locations = TableRegistry::get('Locations');
            $Vehicles = TableRegistry::get('Vehicles');
            $qtdCarros = $Vehicles->find()
                ->hydrate(false)
                ->select([
                    'qtd' => 'COUNT(*)'
                ])->first();

            $qtdCarrosLocados = $Locations->find()
                ->hydrate(false)
                ->select([
                    'qtd' => 'COUNT(DISTINCT vehicle_id)'
                ])
                ->where([
                    'status' => 0
                ])->first();

            if($qtdCarros['qtd'] > 0){
              $p = ($qtdCarrosLocados['qtd'] / $qtdCarros['qtd'])*100;
              $percentual = number_format($p, 2,',','.');
            } else {
              $percentual = '0,00';
            }
        }

        $this->set(compact('NavMenus','user_online', 'rates_list','tickets_list','percentual'));
    }

    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function verifyDuplicity($type, $entity, $value, $id = false){
      $Entity = TableRegistry::get($entity);
      $result = $Entity->find()
                ->where([
                  $type => $value,
                  'id <>' => $id
                ])
                ->limit(1)
                ->first();

      if(count($result)){
        return true;
      } else {
        return false;
      }
    }
}
