<?php
namespace App\Controller\Admin;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use App\Controller\AppController;

/**
 * Potholes Controller
 *
 * @property \App\Model\Table\PotholesTable $Potholes
 *
 * @method \App\Model\Entity\Pothole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PotholesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->viewBuilder()->setLayout('auth');
        
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => 10
        ];
        $potholes = $this->paginate($this->Potholes);

        $this->set(compact('potholes'));
    }

    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('non_auth');
        $hostUrl = Router::fullbaseUrl();

        $pothole = $this->Potholes->get($id, [
            'contain' => ['Constituencies']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $is_admin_approved = $this->request->getData()['is_admin_approved'];
            $pothole = $this->Potholes->patchEntity($pothole, $this->request->getData());
            $pothole->is_admin_approved = $is_admin_approved;
            if ($this->Potholes->save($pothole)) {
                $this->Flash->success(__('The pothole has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pothole could not be saved. Please, try again.'));
        }
        $users = $this->Potholes->Users->find('list', ['limit' => 200]);
        $this->set('title', 'Admin Section');
        $this->set(compact('pothole', 'users', 'hostUrl'));
    }

    public function delete()
    {
        $this->viewBuilder()->setLayout('auth');
        
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => 10
        ];
        $potholes = $this->paginate($this->Potholes);

        $this->set(compact('potholes'));
    }


}