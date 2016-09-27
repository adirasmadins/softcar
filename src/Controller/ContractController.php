<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ContractController extends AppController
{
    public function edit()
    {
        $contract = $this->Contract->get(1);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contract = $this->Contract->patchEntity($contract, $this->request->data);
            if ($this->Contract->save($contract)) {
                $this->Flash->success(__('Contrato salvo com sucesso'));

                return $this->redirect(['action' => 'edit']);
            } else {
                $this->Flash->error(__('Ocorreu um problema ao salvar o Contrato'));
            }
        }

        $situacao = 'Editar Contrato';

        $this->set(compact('contract', 'situacao'));
        $this->set('_serialize', ['contract']);
        $this->render('view');
    }
}
