<?php
App::uses('AppController', 'Controller');

class WeaponRelationsController extends AppController {

	public $name = 'WeaponRelations';
	public $uses = array('WeaponRelations');
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
			$this->WeaponRelations->create();
			$status = $this->WeaponRelations->save($data); 
		
		}
	}
        
}
?>