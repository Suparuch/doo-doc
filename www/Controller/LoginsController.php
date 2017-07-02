<?php
App::uses('AppController', 'Controller');
//Configure::write('debug', 2);
class LoginsController extends AppController {

	public $name = 'Logins';
	public $uses = array('User','Role','AclRoleAction','AclAction','ModelUserGroupList');
	//public $components = array('PortalHelper');

	public function index() {
	//$this->Session->write('attempt',0);

		$attempt = ceil($this->Session->read('attempt'));
		if($attempt>=3){
			$this->Session->setFlash('Login ผิดเกินจำนวนครั้ง กรุณาติดต่อเจ้าหน้าที่ ');
		}
        /*
       if(!isset($_COOKIE['allow']) || $_COOKIE['allow']!=1){
           $this->Session->setFlash('Login ไม่ปลอดภัย <a href="MIS://mis-doc-url">ตรวจสอบความปลอดภัย</a>');
       }
       */
		$this->layout = 'login';
	
	}

	public function authenticate() {

		$this->layout = 'blank';
		$this->autoRender = false;

		//$url = $this->PortalHelper->makeUrl('Folders','index');
		//if(!empty($this->request->data)){
		
		$this->Session->write('attempt',0);
		$attempt = 0;
		
		if(empty($this->request->data)){
			$this->request->data = $_REQUEST;
		}
		
		if(!empty($this->request->data["username"]) && !empty($this->request->data["password"])){

				$username = $this->request->data['username'];
				$password = $this->request->data['password'];

				$conditions = array(   //'limit' =>  '1',
									   'conditions' => array(
										   'User.deleted' => 'N',
										   'username' => $username,
										   'password' => $password,
									   ),
									   'recursive'=>2
									  );
				$authUser = $this->User->find('first',$conditions);
				//die($this->User->getLastQuery());
				if(!empty($authUser)){

					$conditions = array();
					$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name','category'),'cache' => 'List', 'cacheConfig' => 'short');
					$AclActions = $this->AclAction->find('all',$conditions);
					//pr($AclActions);
					//die;
					$customAction = array();
					foreach($AclActions as $AclAction){					
						$customAction[$AclAction['AclAction']['id']] = $AclAction['AclAction'];					
					}

					$role_id = $authUser['RoleUser']['role_id'];
					
//print_r($authUser);
					$conditions = array();
					$conditions = array(   //'limit' =>  '1',
										   'conditions' => array(
											   'deleted' => 'N',
											   'role_id' => $role_id,
										   ),
										   'order' => array('action_id')
										   //'recursive'=>2
										  );
					$AclRoleActions = $this->AclRoleAction->find('all',$conditions);

					$customAclRoleAction = array();
					$menu = array();
					$menulist = array();
					foreach($AclRoleActions as $AclRoleAction){
						
						$action_id = $AclRoleAction['AclRoleAction']['action_id'];

						//$AclRoleAction['AclRoleAction']['controller'] = $customAction[$action_id]['name'];
						//$AclRoleAction['AclRoleAction']['action'] = $customAction[$action_id]['category'];
						if(isset($customAction[$action_id])){
						$controller  = $customAction[$action_id]['name'];
						$action  = $customAction[$action_id]['category'];

						$customAclRoleAction[$controller][$action] = $AclRoleAction['AclRoleAction'];	
						$menu['action_id'] = $action_id;
						$menu['add']=  $AclRoleAction['AclRoleAction']['add'];
						$menu['access']=  $AclRoleAction['AclRoleAction']['access'];
						$menu['list']=  $AclRoleAction['AclRoleAction']['list'];
						$menu['edit']=  $AclRoleAction['AclRoleAction']['edit'];
						$menu['delete']=  $AclRoleAction['AclRoleAction']['delete'];
						$menu['detail']=  $AclRoleAction['AclRoleAction']['detail'];
						$menulist[] = $menu;
						}
					}
					
					
					//pr($customAclRoleAction);

					$authUser['menulist'] = $menulist;
					$authUser['AclRoleAction'] = $customAclRoleAction;
					
					$modelist = array();
					$conditions = array(   //'limit' =>  '1',
										   'conditions' => array(
											   'deleted' => 'N',
											   'group_id' => $authUser["User"]["unit_id"],
										   ),
										   'order' => array('group_id')
										   //'recursive'=>2
										  );
					$ModelGroupList = $this->ModelUserGroupList->find('all',$conditions);
				//	echo $this->ModelUserGroupList->getLastQuery();
				foreach($ModelGroupList as $model){
					$modelist[] = $model;
					
				}
					$authUser['ModelList'] = $modelist;
					
					
	
				//if(!empty($authUser)){
					$this->Session->Write('AuthUser', $authUser);
					$bError = true;
					$this->Session->Write('AuthUser', $authUser);
					$this->Session->write('attempt',0);
				}else{
					$attempt = ceil($this->Session->read('attempt'));
					$attempt++;
					$this->Session->write('attempt', $attempt);
					if($attempt>3)
						$this->Session->setFlash('Login ผิดเกินจำนวนครั้ง กรุณาติดต่อเจ้าหน้าที่ ' . $attempt);
					else
						$this->Session->setFlash('รหัสผู้ใช้ไม่ถูกต้อง !');
					$bError = false;
				}

		}else{
				$bError = false;
		}


		if ($bError) {
	//	print_r($authUser['User'] );
		$doc_level = $authUser['User']['doc_level'];
	//	die($doc_level);
			if($doc_level=="U")
			{
				$url = "../Users/";
			}else if($doc_level=="R")
			{
				$url = "../Document/index";
			}else if($doc_level=="S")
			{
				$url = "../Document/index2/?act=staff";
			}
			else if($doc_level=="D")
			{
				$url = "../Document/index2/?act=director";
			}else if($doc_level=="A")
			{
				$url = "../Document/index2/?act=assist";
			}else if($doc_level=="O")
			{
				$url = "../Document/mainmenu";
			}else if($doc_level=="X")
			{
				$url = "../Document/index3";
			}else{
				$url = '../Dashboards';
			}
			$this->redirect($url);
			
			//$this->PortalHelper->redirect($url);
		}else{
			$url = '../Logins';
			$this->redirect($url);
			//$this->PortalHelper->redirect($url);
		}
	
	}

}
?>