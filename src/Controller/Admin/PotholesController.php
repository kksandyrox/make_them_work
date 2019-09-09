<?php
namespace App\Controller\Admin;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
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

}