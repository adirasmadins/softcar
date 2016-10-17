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
                'status' => 1
            ]);

        if (count($reservados)){
            $reservados=$reservados->toArray();

        } else{
            $reservados=false;
        }

        $Locations = TableRegistry::get('Locations');
        $locados = $Locations->find()
            ->hydrate(false)
            ->where([
                'status' => '0'
            ]);

        if (count($locados)){
            $locados=$locados->toArray();

        } else{
            $locados=false;
        }

        $this->set(compact('dashboard', 'reservados','locados'));
        $this->set('_serialize', ['dashboard', 'reservados','locados']);
    }
}

