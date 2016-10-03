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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cities', 'States']
        ];
        $drivers = $this->paginate($this->Drivers);

        $this->set(compact('drivers'));
        $this->set('_serialize', ['drivers']);
    }

    /**
     * View method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $driver = $this->Drivers->get($id, [
            'contain' => ['Cities', 'States', 'Locations']
        ]);

        $this->set('driver', $driver);
        $this->set('_serialize', ['driver']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $driver = $this->Drivers->newEntity();
        if ($this->request->is('post')) {
            $driver = $this->Drivers->patchEntity($driver, $this->request->data);
            $driver->birth_date=Utils::brToDate($driver->birth_date);
            $driver->first_license=Utils::brToDate($driver->first_license);
            $driver->validity_cnh=Utils::brToDate($driver->validity_cnh);
            if ($this->Drivers->save($driver)) {
                $this->Flash->success(__('The driver has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The driver could not be saved. Please, try again.'));
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


    /**
     * Edit method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $driver = $this->Drivers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $driver = $this->Drivers->patchEntity($driver, $this->request->data);
            if ($this->Drivers->save($driver)) {
                $this->Flash->success(__('The driver has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The driver could not be saved. Please, try again.'));
            }
        }
        $cities = $this->Drivers->Cities->find('list');
        $states = $this->Drivers->States->find('list');
        $situacao = 'Editar Motorista';
        if($driver->birth_date){
            $driver->birth_date = $driver->birth_date->i18nFormat('dd/MM/yyyy');
        }
        if($driver->validity_cnh){
            $driver->validity_cnh = $driver->validity_cnh->i18nFormat('dd/MM/yyyy');
        }
        if($driver->first_license){
            $driver->first_license = $driver->first_license->i18nFormat('dd/MM/yyyy');
        }
        $this->set(compact('driver', 'cities', 'states', 'situacao'));
        $this->set('_serialize', ['driver']);
        $this->render('form');
    }

    /**
     * Delete method
     *
     * @param string|null $id Driver id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $driver = $this->Drivers->get($id);
        if ($this->Drivers->delete($driver)) {
            $this->Flash->success(__('The driver has been deleted.'));
        } else {
            $this->Flash->error(__('The driver could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
