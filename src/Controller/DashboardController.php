<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class DashboardController extends AppController
{
    public function index()
    {
        $Reserves = TableRegistry::get('Reserves');
        $reservados = $Reserves->find()
                     ->hydrate(false)
					 ->where([
						'date_start >=' => date('Y-m-d'),
					 ]);
		if (count($reservados)){
		    $reservados=$reservados->toArray();
		
		} else{
		    $reservados=false;
		}
        $this->set(compact('dashboard', 'reservados'));
        $this->set('_serialize', ['dashboard', 'reservados']);
    }
}

