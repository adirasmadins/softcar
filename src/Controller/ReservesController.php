<?php
namespace App\Controller;

use App\Lib\Utils;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

class ReservesController extends AppController
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
        $query = $this->Reserves->find();
        if (isset($data['plate']) && !empty($data['plate'])) {
            $id =  Utils::getVehicleId($data['plate']);
            $query->where(['vehicle_id' => $id]);
        };
        $reserves = $this->paginate($query);

        $this->set(compact('reserves'));
        $this->set('_serialize', ['reserves']);
    }

    public function add()
    {
        $reserve = $this->Reserves->newEntity();
        if ($this->request->is('post')) {
            $reserve = $this->Reserves->patchEntity($reserve, $this->request->data);

            $reserve->date_start = Utils::brToDate($reserve->date_start);
            $reserve->date_end = Utils::brToDate($reserve->date_end);
            $reserve->reserve_date = date('Y-m-d');
            $reserve->total = str_replace('.', '', number_format(str_replace('R$ ', '', (float) $reserve->total), 2, ',','.'));
            $reserve->status = 1;

            if ($this->Reserves->save($reserve)) {
                $this->Flash->success(__('Reserva salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Reserva'));
            }
        }
        $situacao = 'Cadastrar Reserva';

        $clients = $this->Reserves->Clients->find('list');
        $this->set(compact('reserve', 'situacao','clients'));
        $this->set('_serialize', ['reserve']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $reserve = $this->Reserves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reserve = $this->Reserves->patchEntity($reserve, $this->request->data);

            $reserve->date_start = Utils::brToDate($reserve->date_start);
            $reserve->date_end = Utils::brToDate($reserve->date_end);
            $reserve->total = str_replace('.', '', number_format(str_replace('R$ ', '', (float) $reserve->total), 2, ',','.'));
            if ($this->Reserves->save($reserve)) {
                $this->Flash->success(__('Reserva salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Reserva'));
            }
        }
        $situacao = 'Editar Reserva';
        $clients = $this->Reserves->Clients->find('list');

        $Vehicles = TableRegistry::get('Vehicles');
        $urlAndDayPrice = $Vehicles->find()
            ->select([
                'picture',
                'day_price'
            ])
            ->where([
                'id' => $reserve->vehicle_id
            ])
            ->first();

        $reserve->vehicle_picture = str_replace('//','/', $this->request->webroot . $urlAndDayPrice->picture);
        $reserve->day_price_vehicle = $urlAndDayPrice->day_price;
        $reserve->date_start = $reserve->date_start->i18nFormat('dd/MM/yyyy');
        $reserve->date_end = $reserve->date_end->i18nFormat('dd/MM/yyyy');
        $reserve->remove_schedule = $reserve->remove_schedule->i18nFormat('H:i');
        $reserve->devolution_schedule = $reserve->devolution_schedule->i18nFormat('H:i');

        $this->set(compact('reserve', 'situacao','clients'));
        $this->set('_serialize', ['reserve']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $reserve = $this->Reserves->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Reserves->delete($reserve)) {
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

    public function getVehiclesByDateAndSchedule(){
        $result = ['type' => 'error', 'data' => false];
        if($this->request->is('post')){
            $data = $this->request->data;
            $Vehicles = TableRegistry::get('Vehicles');

            $date_start = Utils::brToDate($data['date_start']);
            $date_end = Utils::brToDate($data['date_end']);

            $this->loadModel('Reserves');
            $teste = $this->Reserves->teste($date_start, $date_end);

            debug($teste);die();

            if(!empty($data['idVehicleAllow'])){
                $result->where([
                    'vehicle_id <>' => (int) $data['idVehicleAllow']
                ]);
            }

            if(count($result->toArray())){

                $result = $result->toArray();

                $ids = [];
                foreach($result as $vehicle){
                    array_push($ids, $vehicle['vehicle']);
                }

                $vehicles_list = $Vehicles->find()
                    ->select([
                        'id',
                        'model',
                        'plate',
                        'picture',
                        'day_price'
                    ])
                    ->where([
                        'id NOT IN' => $ids
                    ]);

                if(count($vehicles_list->toArray())){
                    $result = $vehicles_list->toArray();
                } else {
                    $result = false;
                }
            } else {
                $vehicles_list = $Vehicles->find();
                if(count($vehicles_list->toArray())){
                    $result = $vehicles_list->toArray();
                } else {
                    $result = false;
                }
            }
            $result = ['type' => 'success', 'data' => $result];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function export(){
        $cars = $this->Reserves->find()
            ->select([
                'ids' => 'DISTINCT vehicle_id'
            ]);

        if(count($cars->toArray())){
            $cars = $cars->toArray();

            $vehicles_ids = [];
            foreach($cars as $item){
                array_push($vehicles_ids, $item['ids']);
            }

            $this->Reserves->Vehicles->displayField('model');
            $vehicles = $this->Reserves->Vehicles->find('list')
                ->where([
                    'id in' => $vehicles_ids
                ]);
            $vehicles = $vehicles->toArray();
        } else {
            $cars = false;
            $vehicles = ['0' => 'Não há reservas'];
        }

        $this->set(compact('vehicles','reserves_list'));
        $this->set('_serialize', ['vehicles','reserves_list']);
    }

    public function generateExport($exportConfig = 'default') {
        $result = ['status' => 'error', 'message' => 'Não foi possível gerar o arquivo xls.', 'url' => ''];
        if ($this->request->is('post')) {
            $data = $this->request->data;

            $config = Configure::read('EntityOptions.Reserves.export.' . $exportConfig);

            if (!empty($data['vehicle_ids'])) {
                $config['config']['conditions'][] = ['where' => ['Reserves.vehicle_id in' => $data['vehicle_ids']]];
            }

            if (!empty($data['date_start'])) {
                list($d, $m, $y) = explode('/', $data['from_date']);
                $config['config']['conditions'][] = ['where' => ['Reserves.date_start >=' => $y . '-' . $m . '-' . $d]];
            }

            if (!empty($data['date_end'])) {
                list($d, $m, $y) = explode('/', $data['to_date']);
                $config['config']['conditions'][] = ['where' => ['Reserves.date_end <=' => $y . '-' . $m . '-' . $d]];
            }

            $config['config']['order'] = 'Reserves.reserve_date DESC';

            $url = $this->XLSXExporter->buildExport('Reserves', $config, 'Relatorio_de_Reservas.xlsx', 'Reserves');

            if ($url) {
                $result = ['status' => 'success', 'message' => 'Arquivo de exportação gerado.', 'url' => $url];
            } else {
                $result = ['status' => 'error', 'message' => 'Erro ao exportar o arquivo.'];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function getInformations(){
        $result = ['status' => 'error'];
        if($this->request->is('post')){
            $data = $this->request->data;
            $reserve = $this->Reserves->get($data['id']);

            $reserve->client_name = Utils::getClientOnlyName($reserve->client_id);
            $reserve->date_start = $reserve->date_start->i18nFormat('dd/MM/yyyy');
            $reserve->date_end = $reserve->date_end->i18nFormat('dd/MM/yyyy');
            $reserve->remove_schedule = $reserve->remove_schedule->i18nFormat('H:mm');
            $reserve->devolution_schedule = $reserve->devolution_schedule->i18nFormat('H:mm');

            $result = ['status' => 'success', 'data' => $reserve];
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function updateStatus(){
        $result = ['type' => 'error'];

        if($this->request->is('post')){
            $data = $this->request->data;
            $reserve = $this->Reserves->get($data['id']);

            $reserve = $this->Reserves->patchEntity($reserve, $data);
            $reserve->status = 0;
            if ($this->Reserves->save($reserve)) {
                die('deu');
                $result = ['type' => 'success','message' => 'Pagamento efetuado com sucesso', 'data' => $reserve];
            } else {
                $result = ['type' => 'error','message' => 'Ocorreu um problema ao efetuar o pagamento'];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
