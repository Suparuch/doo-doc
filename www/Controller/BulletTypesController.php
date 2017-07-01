<?php
App::uses('AppController', 'Controller');

class BulletTypesController extends AppController {

	public $name = 'BulletTypes';
	public $uses = array('BulletType');
	public $components = array("Generator");

	function beforeFilter(){
		$currentUser = $this->Session->check('AuthUser');
		if(empty($currentUser)){
			$this->Session->delete('AuthUser');
			$this->Session->destroy();

			$url = Configure::read('Application.Domain').'Logins';
			$this->redirect($url);
		}
	}

	public function append() {
		$this->layout = 'blank';
		$dataRequest = $this->request->data;

		if(!empty($dataRequest)){
			$data['id'] = $this->Generator->getID(); 
			$data['weapon_id'] = $dataRequest['weapon_id']; 
			$this->BulletType->create();
			$this->BulletType->save($data); 
		
		}
	}
        
}
?>