<?php
namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Potholes Controller
 *
 * @property \App\Model\Table\PotholesTable $Potholes
 *
 * @method \App\Model\Entity\Pothole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PotholesController extends AppController
{
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        $this->Auth->allow(['publicView', 'publicDashboard']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'limit' => 1
        ];
        $potholes = $this->paginate($this->Potholes);

        $this->set(compact('potholes'));
    }

    /**
     * View method
     *
     * @param string|null $id Pothole id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('non_auth');
        $pothole = $this->Potholes->get($id, [
            'contain' => ['Users', 'Constituencies', 'PotholeVerifications']
        ]);
        $title = $pothole['location'] . " | " . $pothole['constituency']['name'];
        $userProfileName = $this->Auth->user('first_name') . " " . $this->Auth->user('last_name');
        $userId = $this->Auth->user('id');
        $this->set('userProfileName', $userProfileName);
        $this->set('title', $title);
        $this->set('pothole', $pothole);
        $this->set('userId', $userId);
    }

    public function publicView($id = null)
    {
        $this->viewBuilder()->setLayout('non_auth');
        $pothole = $this->Potholes->get($id, [
            'contain' => ['Users', 'Constituencies']
        ]);
        $title = $pothole['location'] . " | " . $pothole['constituency']['name'];
        $imageMetaUrl = json_decode($pothole['image'])->image_0;
        $this->set('imageMetaUrl', $imageMetaUrl);
        $this->set('title', $title);
        $this->set('pothole', $pothole);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $pothole = $this->Potholes->newEntity();
        if ($this->request->is('post')) {
            $pothole = $this->Potholes->patchEntity($pothole, $this->request->getData());
            if ($this->Potholes->save($pothole)) {
                $this->Flash->success(__('The pothole has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pothole could not be saved. Please, try again.'));
        }
        $users = $this->Potholes->Users->find('list', ['limit' => 200]);
        $this->set(compact('pothole', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Pothole id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $pothole = $this->Potholes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $pothole = $this->Potholes->patchEntity($pothole, $this->request->getData());
            if ($this->Potholes->save($pothole)) {
                $this->Flash->success(__('The pothole has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The pothole could not be saved. Please, try again.'));
        }
        $users = $this->Potholes->Users->find('list', ['limit' => 200]);
        $this->set(compact('pothole', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Pothole id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $pothole = $this->Potholes->get($id);
        if ($this->Potholes->delete($pothole)) {
            $this->Flash->success(__('The pothole has been deleted.'));
        } else {
            $this->Flash->error(__('The pothole could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function uploadPothole() {
        $pothole = $this->Potholes->newEntity();
        $pothole['user_id'] = $this->Auth->user('id');
        $pothole['location'] = $this->request->getData('location');
        $pothole['address'] = $this->request->getData('address');
        $pothole['constituency_id'] = $this->request->getData('constituency_id');
        $pothole['severity'] = $this->request->getData('severity');
        $pothole['description'] = !empty($this->request->getData('description')) ? $this->request->getData('description') : '';
        if($result = $this->Potholes->save($pothole)) {
            $potholeId = $result->id;
            $images = [];
            for($i = 1; $i <=3 ; $i++) {
                array_push($images, $this->request->getData('image_' . $i));
            }
            $this->processImagesAndSave($potholeId, $images);
        $users = $this->Potholes->Users->find('list', ['limit' => 200]);
            $this->Flash->success(__('Thank you! We are processing your submission.'));
            return $this->redirect(['action' => 'dashboard', 'controller' => 'potholes']);
        }
        $this->Flash->error(__('The pothole could not be saved. Please, try again.'));
    }


    public function processImagesAndSave($potholeId, $images) {
        $imageDirectory =  WWW_ROOT . '/' . "files" . '/' . $this->Auth->user('id') . '/' . $potholeId;
        if (!is_dir($imageDirectory)) {
            mkdir($imageDirectory, 0777, true);
        }
        foreach ($images as $key => $image) {
            if($image['size']) {
                $imagePath['image_' . $key] = '/' . "files" . '/' . $this->Auth->user('id') . '/' . $potholeId . '/' . $image['name'];
                move_uploaded_file($image['tmp_name'], $imageDirectory . '/' . $image['name']);
            }
        }
        $imagePath = json_encode($imagePath);
        $potholes= TableRegistry::get('Potholes');
        $pothole = $potholes->get($potholeId);
        $pothole->image = $imagePath;
        $potholes->save($pothole);
        return;
    }

    public function dashboard() {
        $this->viewBuilder()->setLayout('non_auth');
        $conditions = array("is_admin_approved" => 1);
        $filter = '';
        if(!empty($this->request->getQuery('filter'))) {
            $filter = $this->request->getQuery('filter');
            // $filterCondition = array('constituency_id' => $filter);
            $conditions["constituency_id"] = $filter;
            $filteredConstituencyName = $this->Potholes->Constituencies->get($filter);
        }
        $constituencies = $this->Potholes->Constituencies->find('list', ['fields' => ['id', 'name'], 'order' => ['name' => 'ASC']])->toArray();
        $this->paginate = [
            'contain' => ['Users', 'Constituencies', 'PotholeVerifications'],
            'limit' => 10,
            'join' => ([
                'table' => 'pothole_verifications',
                'type' => 'LEFT',
                'alias' => 'pv',
                'conditions' => ['pv.pothole_id = Potholes.id']
                ]),
            'conditions' => $conditions,
            'order' => ['created' => 'DESC'],
            'group' => 'Potholes.id'
        ];
        $potholes = $this->paginate($this->Potholes)->toArray();
        $userId = $this->Auth->user('id');
        $userProfileName = $this->Auth->user('first_name') . " " . $this->Auth->user('last_name');
        // $userSubmissions = $this->Potholes->find('all', ['conditions' => ['user_id' => $this->Auth->user('id')]])->count();
        $title = !empty($filteredConstituencyName) ? $filteredConstituencyName['name'] . " | " : '';
        $this->set('title', $title . "Potholes Dashboard");
        $this->set(compact('constituencies', 'potholes', 'filter', 'userId', 'userProfileName'));
    }

    public function publicDashboard() {
        $this->viewBuilder()->setLayout('non_auth');
        $conditions = array("is_admin_approved" => 1);
        $this->set('title', 'Public Dashboard');
        $filter = '';
        if(!empty($this->request->getQuery('filter'))) {
            $filter = $this->request->getQuery('filter');
            // $conditions = array('constituency_id' => $filter);
            $conditions["constituency_id"] = $filter;
        }
        $constituencies = $this->Potholes->Constituencies->find('list', ['fields' => ['id', 'name']])->toArray();
        $this->paginate = [
            'contain' => ['Users', 'Constituencies', 'PotholeVerifications'],
            'limit' => 10,
            'join' => ([
                'table' => 'pothole_verifications',
                'type' => 'LEFT',
                'alias' => 'pv',
                'conditions' => ['pv.pothole_id = Potholes.id']
                ]),
            'conditions' => $conditions,
            'order' => ['created' => 'DESC'],
            'group' => 'Potholes.id'
        ];
        $potholes = $this->paginate($this->Potholes)->toArray();
        $userId = $this->Auth->user('id');
        $this->set(compact('constituencies', 'potholes', 'filter', 'userId'));
    }

    public function statistics() {
        $this->viewBuilder()->setLayout('non_auth');
        $this->set('title', 'Statistics');
        $potholeStatisticsQuery = "SELECT count(p.id) as p_count, p.id ,c.name FROM constituencies as c left join potholes as p on p.constituency_id = c.id group by c.id ORDER BY  p_count DESC ";
        $connection = ConnectionManager::get('default');
        $potholeStatistics = $connection->execute($potholeStatisticsQuery)->fetchAll('assoc');
        $this->set(compact('potholeStatistics'));
    }

    public function getConstituencyLabels() {
        $potholeStatisticsQuery = "SELECT count(p.id) as p_count, p.id ,c.name FROM constituencies as c left join potholes as p on p.constituency_id = c.id group by c.id ORDER BY c.id ASC";

        $connection = ConnectionManager::get('default');
        $potholeStatistics = $connection->execute($potholeStatisticsQuery)->fetchAll('assoc');

        $labels = [];
        foreach ($potholeStatistics as $key => $stats) {
            array_push($labels, $stats['name']);
        }
        echo json_encode($labels); exit;
    }

    public function getValues() {
        $potholeStatisticsQuery = "SELECT count(p.id) as p_count, p.id ,c.name FROM constituencies as c left join potholes as p on p.constituency_id = c.id group by c.id ORDER BY c.id ASC ";

        $connection = ConnectionManager::get('default');
        $potholeStatistics = $connection->execute($potholeStatisticsQuery)->fetchAll('assoc');

        $labels = [];
        foreach ($potholeStatistics as $key => $stats) {
            array_push($labels, $stats['p_count']);
        }
        echo json_encode($labels); exit;
    }

    public function verifyPothole($potholeId, $userId) {
        $pothole = $this->Potholes->newEntity();
        $pothole['pothole_id'] = $potholeId;
        $pothole['user_id'] = $userId;
        if ($this->request->is('post')) {
            if ($this->Potholes->PotholeVerifications->save($pothole)) {
                $this->Flash->success(__('You have verified this pothole.'));
                return $this->redirect(['action' => 'dashboard']);
            }
            $this->Flash->error(__('The pothole could not be saved. Please, try again.'));
        }
        
    }
}
