<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public function beforeRender(Event $event) {
        $userSubmissions = 0;
        if($this->Auth) {
            $this->loadModel('Potholes');
            $userSubmissions = $this->Potholes->find('all', ['conditions' => ['user_id' => $this->Auth->user('id')]])->count();
        }
        $this->set('Auth', $this->Auth);
        $this->set('userSubmissions', $userSubmissions);
    }

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');

         $this->loadComponent(
            'Auth', [
                'authenticate' =>[
                    'Form' => [
                        'fields' => [
                                    'username' => 'email',
                                    'password' => 'password'
                                ]
                    ]
                ],
                'loginRedirect' => [
                    'controller' => 'potholes',
                    'action' => 'dashboard'
                ],
                'logoutRedirect' => [
                    'controller' => 'users',
                    'action' => 'login'
                ],
                'authorize' => 'Controller'
            ]
        );

        /*
         * Enable the following component for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
    }

    public function isAuthorized() {
        // Any registered user can access public functions
        if(empty($this->request->params['prefix'])) {
            return true;
        }
        // Only admins can access admin functions
        if(isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
            if(!$this->Auth->user('is_admin')) {
                $this->Flash->error('You are not authorized to access this location');
                return $this->redirect(array('controller' => 'potholes', 'action' => 'dashboard', 'prefix' => false));
            }
            return $this->Auth->user('is_admin');
        }
        return false;
    }


    public function beforeFilter(Event $event) {
        $this->Auth->allow(['register', 'statistics', 'getConstituencyLabels', 'getValues', 'feedback', 'forgotPassword', 'resetPassword']);
    }
}
