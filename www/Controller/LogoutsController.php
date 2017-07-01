<?php
App::uses('AppController', 'Controller');

class LogoutsController extends AppController {

	public $name = 'Logouts';
	public $uses = array('User','Role');
	//public $components = array('PortalHelper');

	public function index() {

		$this->layout = 'blank';
		$this->autoRender = false;

		$this->Session->delete('AuthUser');
		$this->Session->destroy();

		$url = '../Logins';
		//$url = Configure::read('Application.Domain').'Logins';
		$this->redirect($url);
	
	}

}
?>