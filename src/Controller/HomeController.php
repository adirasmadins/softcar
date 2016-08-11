<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Home Controller
 *
 * @property \App\Model\Table\HomeTable $Home
 */
class HomeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $home = $this->paginate($this->Home);

        $this->set(compact('home'));
        $this->set('_serialize', ['home']);
    }

    /**
     * View method
     *
     * @param string|null $id Home id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $home = $this->Home->get($id, [
            'contain' => []
        ]);

        $this->set('home', $home);
        $this->set('_serialize', ['home']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $home = $this->Home->newEntity();
        if ($this->request->is('post')) {
            $home = $this->Home->patchEntity($home, $this->request->data);
            if ($this->Home->save($home)) {
                $this->Flash->success(__('The home has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The home could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('home'));
        $this->set('_serialize', ['home']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Home id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $home = $this->Home->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $home = $this->Home->patchEntity($home, $this->request->data);
            if ($this->Home->save($home)) {
                $this->Flash->success(__('The home has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The home could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('home'));
        $this->set('_serialize', ['home']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Home id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $home = $this->Home->get($id);
        if ($this->Home->delete($home)) {
            $this->Flash->success(__('The home has been deleted.'));
        } else {
            $this->Flash->error(__('The home could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
