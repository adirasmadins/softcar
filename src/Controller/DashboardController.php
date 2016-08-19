<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dashboard Controller
 *
 * @property \App\Model\Table\DashboardTable $Dashboard
 */
class DashboardController extends AppController
{
    public function index()
    {
        $this->set(compact('dashboard'));
        $this->set('_serialize', ['dashboard']);
    }
}
