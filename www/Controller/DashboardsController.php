<?php
App::uses('AppController', 'Controller');

class DashboardsController extends AppController {

	public $name = 'Dashboards';
	public $uses = array();

	function beforeFilter(){
		$currentUser = $this->Session->check('AuthUser');
		if(empty($currentUser)){
			$this->Session->delete('AuthUser');
			$this->Session->destroy();

			$url = Configure::read('Application.Domain').'Logins';
			$this->redirect($url);
		}
	}

	public function index() {
	
	}
}
?>