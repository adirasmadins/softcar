<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Lib\Utils;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;


class TicketsController extends AppController
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
        $query = $this->Tickets->find();
        if (isset($data['plate']) && !empty($data['plate'])) {
            $id =  Utils::getVehicleId($data['plate']);
            $query->where(['vehicle_id' => $id]);
        };
        $tickets = $this->paginate($query);

        $this->set(compact('tickets'));
        $this->set('_serialize', ['tickets']);
    }

    public function add()
    {
        $ticket = $this->Tickets->newEntity();
        if ($this->request->is('post')) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);

            $ticket->due_date = Utils::brToDate($ticket->due_date);
            $ticket->ticket_date = Utils::brToDate($ticket->ticket_date);
            $ticket->status = 0;
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Multa salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Multa'));
            }
        }

        $situacao = 'Cadastrar Multa';
        $this->Tickets->Vehicles->displayField('model');
        $vehicles = $this->Tickets->Vehicles->find('list');
        $clients = $this->Tickets->Clients->find('list');

        $this->set(compact('ticket','situacao','vehicles','clients'));
        $this->set('_serialize', ['ticket']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $ticket = $this->Tickets->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ticket = $this->Tickets->patchEntity($ticket, $this->request->data);
            if ($this->Tickets->save($ticket)) {
                $this->Flash->success(__('Multa salva com sucesso'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar a Multa'));
            }
        }
        $situacao = 'Editar Multa';
        $this->Tickets->Vehicles->displayField('model');
        $vehicles = $this->Tickets->Vehicles->find('list');
        $clients = $this->Tickets->Clients->find('list');

        if($ticket->due_date){
            $ticket->due_date = $ticket->due_date->i18nFormat('dd/MM/YYYY');
        }
        if($ticket->ticket_date){
            $ticket->ticket_date = $ticket->ticket_date->i18nFormat('dd/MM/YYYY');
        }

        $this->set(compact('ticket','situacao','vehicles','clients'));
        $this->set('_serialize', ['ticket']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $data = $this->request->data;
        $ticket = $this->Tickets->get($data['id']);
        $result = ['type' => 'error'];

        try{
            if ($this->Tickets->delete($ticket)) {
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

    public function payTicket(){
        $result = ['type' => 'error'];

        if($this->request->is('post')){
            $data = $this->request->data;
            $ticket = $this->Tickets->get($data['id']);

            $ticket = $this->Tickets->patchEntity($ticket, $data);
            $ticket->status = 1;
            if ($this->Tickets->save($ticket)) {
                $result = ['type' => 'success','message' => 'Pagamento efetuado com sucesso', 'data' => $ticket];
            } else {
                $result = ['type' => 'error','message' => 'Ocorreu um problema ao efetuar o pagamento'];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function generateExport($exportConfig = 'default') {
        $result = ['status' => 'error', 'message' => 'Não foi possível gerar o arquivo xls.', 'url' => ''];
        if ($this->request->is('post')) {
            $data = $this->request->data;

            $config = Configure::read('EntityOptions.Tickets.export.' . $exportConfig);

            if (!empty($data['status']) || isset($data['status'])) {
                if($data['status'] != 'todos'){
                    $config['config']['conditions'][] = ['where' => ['Tickets.status =' => $data['status']]];
                }
            }

            if (!empty($data['vehicle_ids'])) {
                $config['config']['conditions'][] = ['where' => ['Tickets.vehicle_id in' => $data['vehicle_ids']]];
            }

            if (!empty($data['from_date'])) {
                list($d, $m, $y) = explode('/', $data['from_date']);
                $config['config']['conditions'][] = ['where' => ['Tickets.ticket_date >=' => $y . '-' . $m . '-' . $d]];
            }

            if (!empty($data['to_date'])) {
                list($d, $m, $y) = explode('/', $data['to_date']);
                $config['config']['conditions'][] = ['where' => ['Tickets.ticket_date <=' => $y . '-' . $m . '-' . $d]];
            }

            $config['config']['order'] = 'Tickets.ticket_date DESC';

            $url = $this->XLSXExporter->buildExport('Tickets', $config, 'Relatorio_de_Multas.xlsx', 'Tickets');

            if ($url) {
                $result = ['status' => 'success', 'message' => 'Arquivo de exportação gerado.', 'url' => $url];
            } else {
                $result = ['status' => 'error', 'message' => 'Erro ao exportar o arquivo.'];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function export(){
        $this->Tickets->Vehicles->displayField('model');
        $cars = $this->Tickets->find()
            ->hydrate(false)
            ->select([
                'ids' => 'DISTINCT vehicle_id'
            ]);

        if(count($cars)){
            $cars = $cars->toArray();
        } else {
            $cars = false;
        }

        $vehicles_ids = [];
        foreach($cars as $item){
            array_push($vehicles_ids, $item['ids']);
        }

        $vehicles = $this->Tickets->Vehicles->find('list')
            ->where([
                'id in' => $vehicles_ids
            ]);

        $this->set(compact('vehicles','tickets_list'));
        $this->set('_serialize', ['vehicles','tickets_list']);
    }

    public function populateGraph(){
        $result = ['type' => 'error', 'data' => ''];
        if($this->request->is('post')){
            $data = $this->request->data;

            $entity = $this->Tickets->find()->hydrate(false);

            if (!empty($data['vehicle']['_ids'])) {
                $tickets_list = $entity->where([
                    'Tickets.vehicle_id in' => $data['vehicle']['_ids']
                ]);
            }

            if (!empty($data['from_date'])) {
                list($d, $m, $y) = explode('/', $data['from_date']);
                $tickets_list = $entity->where([
                    'Tickets.ticket_date >=' => $y . '-' . $m . '-' . $d
                ]);
            }

            if (!empty($data['to_date'])) {
                list($d, $m, $y) = explode('/', $data['to_date']);
                $tickets_list = $entity->where([
                    'Tickets.ticket_date <=' => $y . '-' . $m . '-' . $d
                ]);
            }

            $tickets_list = $entity
                ->select([
                    'id' => 'Tickets.id',
                    'model' => 'v.model',
                    'plate' => 'v.plate',
                    'qtdTickets' => 'count(vehicle_id)'
                ])
                ->innerJoin(['v' => 'vehicles'],['Tickets.vehicle_id = v.id'])
                ->group('Tickets.vehicle_id');

            if(count($tickets_list)){
                $tickets_list = $tickets_list->toArray();
                $result = ['type' => 'success', 'data' => $tickets_list];
            } else {
                $tickets_list = false;
                $result = ['type' => 'error', 'data' => ''];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
}
