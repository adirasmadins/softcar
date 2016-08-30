<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\ORM\TableRegistry;


class RatesController extends AppController
{

    public function index()
    {
        $data = $this->request->query;
        $query = $this->Rates->find();
        if (isset($data['plate']) && !empty($data['plate'])) {
            $id =  Utils::getVehicleId($data['plate']);
            $query->where(['vehicle_id' => $id]);
        };
        $rates = $this->paginate($query);

        $this->set(compact('rates'));
        $this->set('_serialize', ['rates']);
    }

    public function add()
    {
        $rate = $this->Rates->newEntity();
        if ($this->request->is('post')) {
            $rate = $this->Rates->patchEntity($rate, $this->request->data);

            $rate->ipva_expiration = Utils::brToDate($rate->ipva_expiration);
            $rate->depvat_expiration = Utils::brToDate($rate->depvat_expiration);
            $rate->licensing_expiration = Utils::brToDate($rate->licensing_expiration);

            if ($this->Rates->save($rate)) {
                $this->Flash->success(__('Tarifa salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Tarifa'));
            }
        }

        $situacao = 'Cadastrar Tarifa';
        $this->Rates->Vehicles->displayField('model');
        $vehicles = $this->Rates->Vehicles->find('list');

        $this->set(compact('rate', 'situacao','vehicles'));
        $this->set('_serialize', ['rate']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $rate = $this->Rates->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $rate = $this->Rates->patchEntity($rate, $this->request->data);

            $rate->ipva_expiration = Utils::brToDate($rate->ipva_expiration);
            $rate->depvat_expiration = Utils::brToDate($rate->depvat_expiration);
            $rate->licensing_expiration = Utils::brToDate($rate->licensing_expiration);

            if ($this->Rates->save($rate)) {
                $this->Flash->success(__('Tarifa salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Tarifa'));
            }
        }

        $rate->ipva_expiration = $rate->ipva_expiration->i18nFormat('dd/MM/yyyy');
        $rate->depvat_expiration = $rate->depvat_expiration->i18nFormat('dd/MM/yyyy');
        $rate->licensing_expiration = $rate->licensing_expiration->i18nFormat('dd/MM/yyyy');

        $situacao = 'Editar Tarifa';
        $this->Rates->Vehicles->displayField('model');
        $vehicles = $this->Rates->Vehicles->find('list');

        $this->set(compact('rate','situacao','vehicles'));
        $this->set('_serialize', ['rate']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $rate = $this->Rates->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Rates->delete($rate)) {
                $result = ['type' => 'success','data' => ''];
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
