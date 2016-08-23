<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


class ProfilesController extends AppController
{

    public function index()
    {
        $profiles = $this->paginate($this->Profiles);

        $this->set(compact('profiles'));
        $this->set('_serialize', ['profiles']);
    }

    public function add()
    {
        $profile = $this->Profiles->newEntity();
        if ($this->request->is('post')) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The profile could not be saved. Please, try again.'));
            }
        }
        $situacao = 'Cadastrar Perfil';

        $Menus = TableRegistry::get('Menus');
        $menus = $Menus->find('list')->where(['controller not is null']);

        $this->set(compact('profile','situacao','menus'));
        $this->set('_serialize', ['profile']);
        $this->render('form');
    }

    public function edit($id = null)
    {
        $profile = $this->Profiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $profile = $this->Profiles->patchEntity($profile, $this->request->data);
            if ($this->Profiles->save($profile)) {
                $this->Flash->success(__('The profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The profile could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('profile'));
        $this->set('_serialize', ['profile']);
        $this->render('form');
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $profile = $this->Profiles->get($id);
        if ($this->Profiles->delete($profile)) {
            $this->Flash->success(__('The profile has been deleted.'));
        } else {
            $this->Flash->error(__('The profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
