<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

		public $theme = 'Gebo';
		public $components = array("Tracker","Session");


		function beforeFilter(){
			$this->_setTracker();
			$locale = Configure::read('Config.language');
		}

		function beforeRender () {
			//$this->_setTracker();
			//$this->_setErrorSession();
			$this->_setErrorLayout();
		}

		function _setErrorSession() {
			$currentUser = $this->Session->read('AuthUser');
			if(empty($currentUser)){
				$this->Session->delete('AuthUser');
				$this->Session->destroy();

				$url = Configure::read('Application.Domain').'Logins';
				$this->redirect($url);
				//$this->PortalHelper->PortalRedirect($url);
			}
		}

		function _setTracker(){
			//echo '1';
			//pr($this);
			//die;
			//pr($this->request->params['action']);
			//$currentUser = empty($this->Session->read('AuthUser'))? array():$this->Session->read('AuthUser');
			
			
			//pr($currentUser);
			//die;
			
			$user_id = '1';
			$module_name = $this->request->params['controller'];			
			$action = $this->request->params['action'];
			
			$request_pass = empty($this->request->params['pass'])? '':json_encode($this->request->params['pass']);
			$request_data = empty($this->request->data)? '':json_encode($this->request->data);

			$ip = $_SERVER['REMOTE_ADDR'];

			if(!empty($module_name) && !empty($action)){
				if($action == '["favicon.ico"]' && $request_pass == '["favicon.ico"]') return false;
				if($module_name == 'img' && $action == 'photos') return false;

				//if($module_name == 'accounts' && $action == 'saveAccount') $request_data = empty($this->request->data['Profile'])? '':json_encode($this->request->data['Profile']);

				$this->Tracker->setTracker($user_id,$module_name,$action,$request_pass,$request_data,$ip);
			}
		
		}

		function _setErrorLayout() {
			if($this->name == 'CakeError') {
				$this->layout = 'error';
			}
		}

}
