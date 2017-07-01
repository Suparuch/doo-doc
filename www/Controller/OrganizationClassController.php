<?php
App::uses('AppController', 'Controller');

class OrganizationClassController extends AppController {

	public $name = 'OrganizationClass';
	public $uses = array('OrganizationClass');
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
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$total = $this->OrganizationClass->find('count',$conditions);
			$OrganizationClasss = $this->OrganizationClass->find('all',$conditions); 
  
							 
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);
			//intitial
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$name = $dataRequest['name'];
			

			if(!empty($name))
			$whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
			
			$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   ); 
			$total = $this->OrganizationClass->find('count', array('conditions' => $whereConditions ));
			$OrganizationClasss = $this->OrganizationClass->find('all',$conditions); 

			
			
		}
												   
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ข้อมูลขนาดหน่วย' ,
								'url' => ''
								)
		);
		$this->set('breadcrumb',$breadcrumb);  
		$this->set('OrganizationClasss',$OrganizationClasss);  
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'OrganizationClass','pages' => 5);
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
				$OrganizationClass = $this->OrganizationClass->find('all',$conditions);  
				
				foreach($OrganizationClass[0]['OrganizationClass'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}	

	}       
        
	public function save($id=null) {
		$this->autoRender = false;
		 
		$data = $this->request->data;    
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->OrganizationClass->id = $id;
				if($this->OrganizationClass->exists())
				$status = $this->OrganizationClass->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{

					$data['id'] = $this->Generator->getID(); 
					$this->OrganizationClass->create();
					$status = $this->OrganizationClass->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
				$this->OrganizationClass->id = $id;
				if($this->OrganizationClass->exists())
				$status = $this->OrganizationClass->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
		   
		}                    
		
		echo json_encode(array('status' => $status));
	} 
        
}
?>