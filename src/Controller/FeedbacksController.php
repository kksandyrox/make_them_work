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

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Mailer\Email;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class FeedbacksController extends AppController
{

	public function feedback() {
        $this->viewBuilder()->setLayout('non_auth');
        $this->set('title', 'Submit Feedback');
		if($this->request->is('post')) {
			$sentStatus = $this->sendFeedback($this->request->getData());
			if($sentStatus) {
				$this->Flash->success('Your feedback has been sent to the admin.');
			}
			else {
				$this->Flash->success('There was a problem sending your feedback. Please try again');
			}
			$this->redirect($this->referer());
		}
	}

	private function sendFeedback($feedbackData) {
		// pr($feedbackData);
		$Email = new Email('default');
		$Email->setConfig(array('config' => 'smtp'));
		$Email->setFrom(array($feedbackData['email'] => 'Make them Work'))
		    ->setTo('admin@makethemwork.org')
		    ->setSubject('Feedback');
		    // ->emailFormat('html')
		    // ->viewVars(array('content' => $feedbackData['feedback']));
		if($Email->send($feedbackData['feedback'])) {
			return true;
		}
		return false;
	}

}

?>