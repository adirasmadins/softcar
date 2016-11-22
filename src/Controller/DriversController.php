<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\ORM\TableRegistry;

/**
 * Drivers Controller
 *
 * @property \App\Model\Table\DriversTable $Drivers
 */
class DriversController extends AppController
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
        $query = $this->Drivers->find();
        if (isset($data['name']) && !empty($data['name'])) {
            $query->where([
                'name LIKE' => '%' . Utils::r_acc($data['name']) . '%'
            ]);
        };
        $drivers = $this->paginate($query);

        $this->set(compact('drivers'));
        $this->set('_serialize', ['drivers']);
    }

    public function add()
    {
        $driver = $this->Drivers->newEntity();
        if ($this->request->is('post')) {
            $driver = $this->Drivers->patchEntity($driver, $this->request->data);
            $driver->birth_date=Utils::brToDate($driver->birth_date);
            $driver->first_license=Utils::brToDate($driver->first_license);
            $driver->validity_cnh=Utils::brToDate($driver->validity_cnh);

            $save = true;

            if(strlen($driver->cpf) < 14){
                $this->Flash->error(__('O CPF está incorreto!'));
                $save = false;
            }

            $verifyCpf = $this->verifyDuplicity('cpf', 'Drivers', $driver->cpf);

            if($verifyCpf){
              $this->Flash->error(__('Já existe um motorista com CPF ' . $driver->cpf));
              $save = false;
            }

            if($save){
              if ($this->Drivers->save($driver)) {
                  $this->Flash->success(__('Motorista salvo com sucesso'));

                  return $this->redirect(['action' => 'index']);
              } else {
                  $this->Flash->error(__('Ocorreu um problema ao salvar o Motorista'));
              }
            }
        }
        $situacao='Cadastrar Motorista';
        $States=TableRegistry::get('States');
        $states=$States->find('list');
        $Cities=TableRegistry::get('Cities');
        $cities=$Cities->find('list');
        $this->set(compact('driver','situacao','states','cities'));
        $this->set('_serialize', ['driver']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $driver = $this->Drivers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $driver = $this->Drivers->patchEntity($driver, $this->request->data);
            $driver->birth_date=Utils::brToDate($driver->birth_date);
            $driver->first_license=Utils::brToDate($driver->first_license);
            $driver->validity_cnh=Utils::brToDate($driver->validity_cnh);

            $save = true;

            if(strlen($driver->cpf) < 14){
                $this->Flash->error(__('O CPF está incorreto!'));
                $save = false;
            }

            $verifyCpf = $this->verifyDuplicity('cpf', 'Drivers', $driver->cpf, $driver->id);

            if($verifyCpf){
              $this->Flash->error(__('Já existe um motorista com CPF ' . $driver->cpf));
              $save = false;
            }

            if($save){
              if ($this->Drivers->save($driver)) {
                  $this->Flash->success(__('Motorista salvo com sucesso'));

                  return $this->redirect(['action' => 'index']);
              } else {
                  $this->Flash->error(__('Ocorreu um problema ao salvar o Motorista'));
              }
            }
        }
        $cities = $this->Drivers->Cities->find('list');
        $states = $this->Drivers->States->find('list');
        $situacao = 'Editar Motorista';
        if(!is_string($driver->birth_date)){
            $driver->birth_date = $driver->birth_date->i18nFormat('dd/MM/yyyy');
        }
        if(!is_string($driver->validity_cnh)){
            $driver->validity_cnh = $driver->validity_cnh->i18nFormat('dd/MM/yyyy');
        }
        if(!is_string($driver->first_license)){
            $driver->first_license = $driver->first_license->i18nFormat('dd/MM/yyyy');
        }
        $this->set(compact('driver', 'cities', 'states', 'situacao'));
        $this->set('_serialize', ['driver']);
        $this->render('form');
    }

    public function delete($id = null)
    {
      $this->request->allowMethod(['post', 'delete']);
      $data = $this->request->data;
      $driver = $this->Drivers->get($data['id']);
      $result = ['type' => 'error'];

      try{
          if ($this->Drivers->delete($driver)) {
              $result = ['type' => 'success','data' => $driver['name']];
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
