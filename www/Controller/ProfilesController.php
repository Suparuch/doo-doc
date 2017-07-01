<?php
App::uses('AppController', 'Controller');

class ProfilesController extends AppController {

	public $name = 'Profiles';
	public $uses = array('Users');

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
	
	}

	public function checkProfile() {
		$this->layout = 'blank';
		$this->autoRender = false;

		$data = $this->request->data;
		
		if(!empty($data)){

			$username = $data['username'];
			$password = $data['password'];

			//$username = 'admin';
			//$password = 'password';
			
			if(!empty($username) && !empty($password)){
				
				$conditions = array('conditions' => array('username'=>$username,'password'=>$password,'deleted'=>'N'));
				$users = $this->Users->find('first',$conditions);
				if(!empty($users)){
					$status = 'SUCCESS';
				}else{
					$status = 'FAILED';
				}

			}else{
				$status = 'FAILED';
			}
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));
	
	}

	public function changePassword() {
		$this->layout = 'blank';
		$this->autoRender = false;

		$data = $this->request->data;    
		
		if(!empty($data)){

			$username = $data['username'];
			$password = $data['password'];
			$new_password = $data['new_password'];

			//$username = 'admin';
			//$password = 'password';
			//$new_password = 'passwordss';
			
			if(!empty($username) && !empty($password) && !empty($new_password)){
				
				$conditions = array('conditions' => array('username'=>$username,'password'=>$password,'deleted'=>'N'));
				$users = $this->Users->find('first',$conditions);
				if(!empty($users)){
					$data['Users']['id'] = $users['Users']['id'];
					$data['Users']['password'] = $new_password;
					$this->Users->save($data);
					$status = 'SUCCESS';
				}else{
					$status = 'FAILED';
				}

			}else{
				$status = 'FAILED';
			}
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));
	
	}
	
}
?>