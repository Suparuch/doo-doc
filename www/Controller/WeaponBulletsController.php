<?php
App::uses('AppController', 'Controller');

class WeaponBulletsController extends AppController {

	public $name = 'WeaponBullets';
	public $uses = array('WeaponBullet','WeaponType','WeaponBulletDocument');
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
			$dataRequest = $this->request->data;
			if(empty($dataRequest)){
				$offset = 0;
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';            
				$conditions = array('limit' =>   $this->Generator->setLimit(),
									//'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   );
				$total = $this->WeaponBullet->find('count',$conditions);
				$WeaponBullets = $this->WeaponBullet->find('all',$conditions); 
	  
								 
			}else{
				
				$default = array();
				$default = $dataRequest;
				$this->set('default',$default);
				//intitial
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				
				$offset = $dataRequest['offset'];

				$weapon_type_id = $dataRequest['weapon_type_id'];
				$name = $dataRequest['name'];

				if(!empty($weapon_type_id)) $whereConditions[] = "weapon_type_id = '".$weapon_type_id."'";
				if(!empty($name)) $whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
				
				$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
									//'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   ); 
				$total = $this->WeaponBullet->find('count', array('conditions' => $whereConditions ));
				$WeaponBullets = $this->WeaponBullet->find('all',$conditions); 

			}              

			$breadcrumb = array (   'controller' => array(   
									'name' => 'ข้อมูลคุณลักษณะกระสุนและวัตถุระเบิด ' ,
									'url' => ''
									)
			);

			$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$WeaponTypes = $this->WeaponType->find('list',$conditions);

			$this->set('breadcrumb',$breadcrumb);
			$this->set('WeaponTypes',$WeaponTypes);
			$this->set('WeaponBullets',$WeaponBullets);  
			$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'WeaponBullet','pages' => 5);
			$this->set('pagination',$pagination);                    
	}

	public function form($id = null) {
            $this->layout = 'blank';
            $default = array();
            if(!empty($id)){
                
                    $whereConditions = array();
                    $whereCOnditions['deleted'] = 'N';
                    $whereConditions['id'] = $id;
                    $conditions = array('limit' =>  '1',
                                        'order' =>  array('name' => 'asc'),
                                        'conditions' => $whereConditions
                                       );
                    $WeaponBullets = $this->WeaponBullet->find('all',$conditions);  
                    
                    foreach($WeaponBullets[0]['WeaponBullet'] as $key => $value)
                        $default[$key] = $value;
					
                    $this->set('default',$default);
					
            }	
			$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$WeaponTypes = $this->WeaponType->find('list',$conditions);
			
			$this->set('WeaponTypes',$WeaponTypes);

	}
	
	public function document($id = null) {
            $this->layout = 'blank';
            $default = array();
            if(!empty($id)){
                
                    $whereConditions = array();
                    $whereCOnditions['deleted'] = 'N';
                    $whereConditions['id'] = $id;
                    $conditions = array('limit' =>  '1',
                                        'order' =>  array('name' => 'asc'),
                                        'conditions' => $whereConditions
                                       );
                    $WeaponBullets = $this->WeaponBullet->find('all',$conditions);  
                    
                    foreach($WeaponBullets[0]['WeaponBullet'] as $key => $value)
                        $default[$key] = $value;
					
					
                    $whereConditions = array();
                    $whereCOnditions['deleted'] = 'N';
                    $whereConditions['weapon_bullet_id'] = $id;
                    $conditions = array(//'order' =>  array('name' => 'asc'),
                                        'conditions' => $whereConditions
                                       );
					$WeaponBulletDocuments = $this->WeaponBulletDocument->find('all',$conditions);

					$this->set('WeaponBulletDocuments',$WeaponBulletDocuments);
                    $this->set('default',$default);

            }	
			$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$WeaponTypes = $this->WeaponType->find('list',$conditions);
			
			$this->set('WeaponTypes',$WeaponTypes);

	}
        
	public function save($id=null) {
            $this->autoRender = false;
             
            $data = $this->request->data;    
            
			if(!empty($data)){    
				
				if(!empty($id)){
					
					$this->WeaponBullet->id = $id;
					if($this->WeaponBullet->exists())
					$status = $this->WeaponBullet->save($data) ? 'SUCCESS' : 'FAILED'; 
					else $status = 'FAILED';    
					
				}else{

						$data['id'] = $this->Generator->getID(); 
						$this->WeaponBullet->create();
						$status = $this->WeaponBullet->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
					$this->WeaponBullet->id = $id;
					if($this->WeaponBullet->exists())
					$status = $this->WeaponBullet->save($data) ? 'SUCCESS' : 'FAILED'; 
					else $status = 'FAILED';    

				}else $status =  'FAILED';                                      
			   
			}                    
			
			echo json_encode(array('status' => $status));
	} 
        
}
?>