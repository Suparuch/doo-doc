<?php
App::uses('AppController', 'Controller');

class TrainingsController extends AppController {

	public $name = 'Trainings';
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
		$this->layout = 'blank';
		$this->autoRender = false;
		echo 'ข้อมูลการฝึก';
	}

	public function detail() {
		$this->layout = 'blank';
		$this->autoRender = false;
		echo 'ข้อมูลการฝึก';
	}


}
?>