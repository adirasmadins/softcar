<?php
namespace App\Controller;

use App\Controller\AppController;

class DashboardController extends AppController
{
    public function index()
    {
        $this->set(compact('dashboard'));
        $this->set('_serialize', ['dashboard']);
    }
}
