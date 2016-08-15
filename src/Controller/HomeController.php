<?php
namespace App\Controller;

use App\Controller\AppController;


class HomeController extends AppController
{
    public function login() {
        $this->viewBuilder()->layout(false);
        $result = ['type' => 'error'];
        if ($this->request->is('post')) {
            $data = $this->request->data;

            $user = $this->Auth->identify($data);
            if ($user) {
                $result = ['type' => 'success', 'data' => $user['name']];
                $this->Auth->setUser($user);
            } else {
                $result = ['type' => 'error'];
            }
        }

        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
}
