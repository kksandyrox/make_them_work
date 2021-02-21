<?php
namespace App\Controller;

use Cake\Auth\DefaultPasswordHasher;
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\Mailer\Email;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Potholes']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function register() {
        $this->viewBuilder()->setLayout('non_auth');
        $this->set('title', 'Register');
        $users = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($users, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error(__('Please fill up the form properly.'));
            }
        }
        $this->set(compact('users'));
    }

    public function login() {        
        $this->viewBuilder()->setLayout('non_auth');
        $this->set('title', 'Login');
        if(!empty($this->Auth->user())) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = $this->Auth->identify();
                if ($user) {
                    $this->Auth->setUser($user);
                    $this->Flash->success('You are successfuly logged in.');
                    return $this->redirect($this->Auth->redirectUrl());
                } else {
                    $this->Flash->error('Your username or password is incorrect.');
                }
            } else {
                $this->Flash->error('Invalid email address. Please check.');
            }
        }
    }

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['logout']);
    }

    public function logout() {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function dashboard() {
        $this->viewBuilder()->setLayout('auth');
        $constituencies = $this->Users->Potholes->Constituencies->find('list', ['fields' => ['id', 'name']])->toArray();
        $potholes = $this->Users->Potholes->find('all')->toArray();
        $this->set(compact('constituencies', 'potholes'));
    }

    public function forgotPassword() {
        $this->viewBuilder()->setLayout('non_auth');
        $this->set('title', 'Forgot Password');
        if($this->request->is('post')) {
            $email = $this->request->getData('email');
            $users  = TableRegistry::get('Users');
            $users  = TableRegistry::getTableLocator()->get('Users');
            $query =  $users->findByEmail($email);
            $user = $query->first();
            if($user) {
                $resetToken = $this->Users->generateRandomString();
                // pr($user); die;
                $user = $users->get($user['id']); // Return article with id 12

                $user->token = $resetToken;
                if($users->save($user)) {
                    $this->sendForgotPasswordEmail($user, $resetToken);
                    $this->Flash->success(__('Check your email to reset password'));
                    $this->redirect(array('action' => 'login'));
                }
            }
            else {
                $this->Flash->error(__('Email not found. Please enter valid email'));
            }
        }
    }

    public function resetPassword($userId = null, $resetToken = null) {
        $this->viewBuilder()->setLayout('non_auth');
        $this->set('title', 'Reset Password');
        if(empty($userId) || empty($resetToken)) {
            $this->Flash->error(__('Your are not authorized to view this page'));
            $this->redirect(array('action' => 'login'));
        }
        $isCorrectUser = $this->Users->isCorrectUser($userId, $resetToken);
        if (!$isCorrectUser) {
            $this->Flash->error(__('Your are not authorized to view this page'));
            $this->redirect(array('action' => 'login'));
        }
        if ($this->request->is('post')) {
            $this->passwordHandler($userId);
        }
    }

    public function sendForgotPasswordEmail($user, $resetToken) {
        $userId = $user['id'];
        $userEmail = $user['email'];
        $passwordResetLink = Router::fullbaseUrl() . Router::url(array(
                'controller' => 'users',
                'action' => 'reset_password',
                $userId,
                $resetToken
            )
        );
        $logoHost = Router::fullbaseUrl();
        // pr($passwordResetLink); die;
        // $Email = new Email('default');
        // $Email->setConfig(array('config' => 'smtp'));
        // $Email->setFrom(array('admin@makethemwork.org' => 'Make them Work'))
        //     ->setTo($userEmail)
        //     ->setSubject('Forgot Password');
        // if($Email->send($passwordResetLink)) {
        //     return true;
        // }
        // return false;            
        $userName = $user['first_name'];
        $Email = new Email('default');
        $Email->setConfig(array('config' => 'smtp'));
        $Email->setFrom(array('admin@makethemwork.org' => 'Make them Work'))
            ->setTo($userEmail)
            ->setTemplate('fancy')
            ->setSubject('Forgot Password')
            ->setEmailFormat('html')
            ->setViewVars(array($userName, $passwordResetLink, $logoHost));
        if($Email->send()) {
            return true;
        }
        return false;             
    }

    private function passwordHandler($userId) {
        $user = $this->Users->get($userId);
        $data = $this->request->getData();
        $user->token = "";
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your password has been updated.'));
                return $this->redirect(['action' => 'login']);
            }
    }
 
}
