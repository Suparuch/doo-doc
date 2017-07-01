<?php

App::uses('AppController', 'Controller');

class UsersController extends AppController {

	public $name = 'Users';
	public $uses = array('User','UserProfile','AclRole','AclRoleUser','Unit','Rank');
	public $components = array("FileStorageComponent","Generator");

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
		//$this->layout = 'blank';
		//$this->autoRender = false;
		//error_reporting(0);
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ข้อมูลผู้ใช้งาน' ,
								'url' => ''
								)
		);
		$this->set('breadcrumb',$breadcrumb);    
		$dataRequest = $this->request->data;
		
		$whereConditions = array();
		if(!empty($dataRequest)){		
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);   
			
			$name = $dataRequest['name'];

			if(!empty($name)) $whereConditions[] = 'name ILIKE \'%'.$name.'%\' OR username ILIKE \'%'.$name.'%\'';
		}
		// ################### Get all user ID ###################
		$conditions = array(//'limit' =>  '20',
							'order' =>  array('id' => 'asc'),
							'conditions' => array('deleted' => 'N'),
							'conditions' => $whereConditions
						   );
		$users = $this->User->find('all',$conditions);

		//pr($users);
		$user_ids = array();
		
		
		// COLLECT USER_IDs
		foreach($users as $user)
		$user_ids[] = $user['User']['id'];
		
		
		// ################### Get all userProfile ###################
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$whereConditions['user_id'] = $user_ids;
		
		$conditions = array(//'limit' =>  '20',
							//'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$userprofiles = $this->UserProfile->find('all',$conditions);                      
		
		$userprofileTemps = array();
	  
		//MERGE NEW ARRAY USE USER_ID TO INDEX
		foreach($userprofiles as $userprofile){
			$userprofileTemps[$userprofile['UserProfile']['user_id']] = $userprofile;
		}
		

		// ################### Get all userRole by USER_ID ###################
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$whereConditions['user_id'] = $user_ids;
		
		$conditions = array(//'limit' =>  '20',
							//'order' =>  array('id' => 'asc'),
							'fields' => array('user_id','role_id'),
							'conditions' => $whereConditions
						   );
		$roleusers = $this->AclRoleUser->find('list',$conditions);                     
	   
		//COLLECT ALL ROLE_ID FROM USER ID
		$role_ids = array();
		$role_ids = $roleusers;
		//pr($role_ids);
		
		
		// ################### Get all ROLE BY USER_ID ###################
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$whereConditions['id'] = $role_ids;
		
		$conditions = array(//'limit' =>  '20',
							//'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$AclRoles = $this->AclRole->find('all',$conditions);
		//pr($roles);
		
		$roleTemps = array();
		
		
		//MERGE NEW ARRAY
		foreach($AclRoles as $AclRole){
			$roleTemps[$AclRole['AclRole']['id']] = $AclRole;
		}
		//pr($userprofileTemps);
		//pr($roleTemps);
		//die;

		//Intitial Users
		
		foreach($users as $key => $user){
			//pr($user['User']['id']);
			if(!isset($users[$key]))
				$users[$key] = 0;
			$users[$key] += $userprofileTemps[$user['User']['id']];
			//$users[$key] += $roleTemps[$roleusers[$user['User']['id']]];
		}
		
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$conditions = array(//'limit' =>  '20',
			'fields' => array('id','name'),
			'order' =>  array('order_sort' => 'asc'),
			'conditions' => $whereConditions
		);
		$Units = $this->Unit->find('list',$conditions);
		//pr($users);
		//die;
		$this->set('users',$users);
		$this->set('Units',$Units);
                    
	}

	public function create() {
			
		$this->disableCache();
		$this->layout = 'blank';
		//$this->autoRender = false;
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','name'),
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$AclRoles = $this->AclRole->find('list',$conditions);
		$Units = $this->Unit->find('list',$conditions);

		$conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Ranks = $this->Rank->find('list', $conditions2);
		
        
		$default['id'] = "";
		$default['username'] = "";
		$default['password'] = "";
		$default['name'] ="";
		$default['surname'] = "";
		$default['unit_id'] = "";
		$default['role_id'] ="";
		$default['rank_id'] ="";
		$default['doc_level'] ="";
		$default['doc_secrete'] ="";
		
		
		$this->set('default',$default);
        $this->set('Ranks', $Ranks);

		$this->set('AclRoles',$AclRoles);
		$this->set('Units',$Units);
		
	}      

	public function edit($user_id = null) {
			
		$this->disableCache();
		$this->layout = 'blank';
		//$this->autoRender = false;

		//------------------------------------------------------------------
		$whereConditions = array();
		$whereConditions['"User"."deleted"'] = 'N';
		$whereConditions['"User"."id"'] = $user_id;
		
		$conditions = array(
							'conditions' => $whereConditions,
							
						   );
		$Users = $this->User->find('first',$conditions);
		
		
		//------------------------------------------------------------------
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$whereConditions['user_id'] = $user_id;
		
		$conditions = array(
							'conditions' => $whereConditions
						   );
		$UserProfiles = $this->UserProfile->find('first',$conditions);
		//pr($UserProfiles);

		//------------------------------------------------------------------
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$whereConditions['user_id'] = $user_id;
		
		$conditions = array(
							'conditions' => $whereConditions
						   );
		$AclRoleUser = $this->AclRoleUser->find('first',$conditions);  
		//pr($AclRoleUser);

		//------------------------------------------------------------------
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','name'),
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$AclRoles = $this->AclRole->find('list',$conditions);
		$Units = $this->Unit->find('list',$conditions);
		//------------------------------------------------------------------
		
		$default['id'] = $user_id;
		$default['username'] = empty($Users['User']['username'])? '':$Users['User']['username'];
		$default['password'] = empty($Users['User']['password'])? '':$Users['User']['password'];
		$default['name'] = empty($UserProfiles['UserProfile']['name'])? '':$UserProfiles['UserProfile']['name'];
		$default['surname'] = empty($UserProfiles['UserProfile']['surname'])? '':$UserProfiles['UserProfile']['surname'];
		$default['unit_id'] = empty($Users['User']['unit_id'])? '':$Users['User']['unit_id'];
		$default['role_id'] = empty($AclRoleUser['AclRoleUser']['role_id'])? '':$AclRoleUser['AclRoleUser']['role_id'];
		$default['rank_id'] = empty($Users['User']['rank_id'])? '':$Users['User']['rank_id'];
		$default['doc_level'] = empty($Users['User']['doc_level'])? '':$Users['User']['doc_level'];
		$default['doc_secrete'] = empty($Users['User']['doc_secrete'])? '':$Users['User']['doc_secrete'];
	
 		$conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Ranks = $this->Rank->find('list', $conditions2);
		
        
        $this->set('Ranks', $Ranks);
		$this->set('AclRoles',$AclRoles);
		$this->set('Units',$Units);
		$this->set('default',$default);


	}      
        
	public function detail() {
	
	}

	public function save($id = null){
		
		$this->autoRender = false;
		$data = $this->request->data;;
		//pr($data);
		//die;
	
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->User->id = $id;
				if($this->User->exists()){
					
				
					$status = $this->User->save($data) ? 'SUCCESS' : 'FAILED';
					$this->UserProfile->id = $id;
					$status = $this->UserProfile->save($data) ? 'SUCCESS' : 'FAILED';						
					//$data['AclRoleUser']
					$this->AclRoleUser->id = $id;
					$status = $this->AclRoleUser->save($data) ? 'SUCCESS' : 'FAILED';

				}else{
					$status = 'FAILED';
				}
				
			}else{
					//$sql = "SELECT order_sort + 1 as new_order_sort  FROM rack_floors WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
					//$results = $this->User->query($sql);   
					//$data['order_sort'] = $results[0][0]['new_order_sort'];
					$data['id'] = $this->Generator->getID();

					$userData = array();
					$userData['id'] = $this->Generator->getID();
					$userData['username'] = $data['username'];
					$userData['password'] = $data['password'];
					$userData['name'] = $data['name'];
					$userData['surname'] = $data['surname'];
					$userData['unit_id'] = $data['unit_id'];
					$userData['rank_id'] = $data['rank_id'];
					$userData['doc_level'] = $data['doc_level'];
					$userData['doc_secrete'] = $data['doc_secrete'];
					$this->User->create();
					$status = $this->User->save($userData) ? 'SUCCESS' : 'FAILED';

					$userProfileData = array();
					$userProfileData['id'] = $userData['id'];
					$userProfileData['user_id'] = $userData['id'];
					$userProfileData['name'] = $data['name'];
					$userProfileData['surname'] = $data['surname'];
					$this->UserProfile->create();
					$status = $this->UserProfile->save($userProfileData) ? 'SUCCESS' : 'FAILED';

					$AclRoleUser = array();
					$AclRoleUser['id'] = $userData['id'];
					$AclRoleUser['user_id'] = $userData['id'];
					$AclRoleUser['role_id'] = $data['role_id'];
					$this->UserProfile->create();
					$status = $this->AclRoleUser->save($AclRoleUser) ? 'SUCCESS' : 'FAILED';

			}
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));
	}
	public function delete() {
            
		$this->autoRender = false;  
		$status = '';
	   
		$ids = array();
		$ids = $this->request->data['ids'];             
		foreach($ids as $id){           
			
			if(!empty($id)){

				$data = array();
				$data['deleted'] = "Y";
				$this->User->id = $id;
				if($this->User->exists())
				$status = $this->User->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}

}
?>