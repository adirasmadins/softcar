<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\Core\Configure;

class ServicesController extends AppController
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
        $query = $this->Services->find();
        if (isset($data['plate']) && !empty($data['plate'])) {
            $id =  Utils::getVehicleId($data['plate']);
            $query->where(['vehicle_id' => $id]);
        };
        $services = $this->paginate($query);

        $this->set(compact('services'));
        $this->set('_serialize', ['services']);
    }

    public function add()
    {
        $service = $this->Services->newEntity();
        if ($this->request->is('post')) {
            $service = $this->Services->patchEntity($service, $this->request->data);

            $service->make_date = Utils::brToDate($service->make_date);
            if ($this->Services->save($service)) {
                $this->Flash->success(__('Serviço salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Serviço'));
            }
        }
        $situacao = 'Cadastrar Serviço/Manutenção';

        $this->Services->Vehicles->displayField('model');
        $vehicles = $this->Services->Vehicles->find('list');

        $this->set(compact('service', 'situacao','vehicles'));
        $this->set('_serialize', ['service']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $service = $this->Services->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $service = $this->Services->patchEntity($service, $this->request->data);
            $service->make_date = Utils::brToDate($service->make_date);
            if ($this->Services->save($service)) {
                $this->Flash->success(__('Serviço salvo com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Serviço'));
            }
        }

        $situacao = 'Editar Serviço/Manutenção';

        if(count($service->make_date)){
            $service->make_date = $service->make_date->i18nFormat('dd/MM/yyyy');
        }

        $this->Services->Vehicles->displayField('model');
        $vehicles = $this->Services->Vehicles->find('list');

        $this->set(compact('service', 'situacao','vehicles'));
        $this->set('_serialize', ['service']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $service = $this->Services->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Services->delete($service)) {
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

    public function export(){
        $this->Services->Vehicles->displayField('model');
        $cars = $this->Services->find()
            ->hydrate(false)
            ->select([
                'ids' => 'DISTINCT vehicle_id'
            ]);

        if(count($cars->toArray())){
            $cars = $cars->toArray();

            $vehicles_ids = [];
        foreach($cars as $item){
            array_push($vehicles_ids, $item['ids']);
        }

        $vehicles = $this->Services->Vehicles->find('list')
            ->where([
                'id in' => $vehicles_ids
            ]);

            $vehicles = $vehicles->toArray();
        } else {
            $cars = false;
            $vehicles = ['0' => 'Não há veículo com manutenção'];
        }

        $this->set(compact('vehicles'));
        $this->set('_serialize', ['vehicles']);
    }

    public function generateExport($exportConfig = 'default') {
        $result = ['status' => 'error', 'message' => 'Não foi possível gerar o arquivo xls.', 'url' => ''];
        if ($this->request->is('post')) {
            $data = $this->request->data;

            $config = Configure::read('EntityOptions.Services.export.' . $exportConfig);

            if (!empty($data['vehicle_ids'])) {
                $config['config']['conditions'][] = ['where' => ['Services.vehicle_id in' => $data['vehicle_ids']]];
            }

            if (!empty($data['service_type'])) {
                if($data['service_type'] != 'todos'){
                    $config['config']['conditions'][] = ['where' => ['Services.service_type =' => $data['service_type']]];
                }
            }

            if (!empty($data['from_date'])) {
                list($d, $m, $y) = explode('/', $data['from_date']);
                $config['config']['conditions'][] = ['where' => ['Services.make_date >=' => $y . '-' . $m . '-' . $d]];
            }

            if (!empty($data['to_date'])) {
                list($d, $m, $y) = explode('/', $data['to_date']);
                $config['config']['conditions'][] = ['where' => ['Services.make_date <=' => $y . '-' . $m . '-' . $d]];
            }

            $config['config']['order'] = 'Services.make_date DESC';

            $url = $this->XLSXExporter->buildExport('Services', $config, 'Relatorio_de_Servicos.xlsx', 'Services');

            if ($url) {
                $result = ['status' => 'success', 'message' => 'Arquivo de exportação gerado.', 'url' => $url];
            } else {
                $result = ['status' => 'error', 'message' => 'Erro ao exportar o arquivo.'];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function populateGraph(){
        $result = ['type' => 'error', 'data' => ''];
        if($this->request->is('post')){
            $data = $this->request->data;

            $entity = $this->Services->find()->hydrate(false);

            if (!empty($data['vehicle']['_ids'])) {
                $services_list = $entity->where([
                    'Services.vehicle_id in' => $data['vehicle']['_ids']
                ]);
            }

            if (!empty($data['from_date'])) {
                list($d, $m, $y) = explode('/', $data['from_date']);
                $services_list = $entity->where([
                    'Services.make_date >=' => $y . '-' . $m . '-' . $d
                ]);
            }

            if (!empty($data['to_date'])) {
                list($d, $m, $y) = explode('/', $data['to_date']);
                $services_list = $entity->where([
                    'Services.make_date <=' => $y . '-' . $m . '-' . $d
                ]);
            }

            if (!empty($data['service_type'])) {
              if($data['service_type'] == 'r' || $data['service_type'] == 't' || $data['service_type'] == 'o'){
                $locations_list = $entity->where([
                    'Services.service_type' => $data['service_type']
                ]);
              }
            }

            $tickets_list = $entity
                ->select([
                    'id' => 'Services.id',
                    'model' => 'v.model',
                    'plate' => 'v.plate',
                    'qtdService' => 'count(vehicle_id)'
                ])
                ->innerJoin(['v' => 'vehicles'],['Services.vehicle_id = v.id'])
                ->group('Services.vehicle_id');

            if(count($tickets_list)){
                $services_list = $services_list->toArray();
                $result = ['type' => 'success', 'data' => $services_list];
            } else {
                $services_list = false;
                $result = ['type' => 'error', 'data' => ''];
            }
        }

        $this->set(compact('result','services_list'));
        $this->set('_serialize', ['result','services_list']);
    }
}
