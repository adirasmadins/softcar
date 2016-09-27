<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contract Controller
 *
 * @property \App\Model\Table\ContractTable $Contract
 */
class ContractController extends AppController
{
    public function view($id = null)
    {
        $contract = $this->Contract->find();
        
        $situacao = 'Editar Contrato';

        $this->set(compact('contract','situacao'));
        $this->set('_serialize', ['contract']);
    }
}
