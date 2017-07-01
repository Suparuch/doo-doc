<?php
App::uses('AppController', 'Controller');

class EmployeePositionsController extends AppController {

	public $name = 'EmployeePositions';
	public $uses = array('EmployeePosition','PositionGroup');
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
			$total = $this->EmployeePosition->find('count',$conditions);
			$EmployeePositions = $this->EmployeePosition->find('all',$conditions); 
  
							 
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);
			//intitial
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$name = $dataRequest['name'];
			$position_group_id = $dataRequest['position_group_id'];
			
			if(!empty($name)) $whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
			if(!empty($position_group_id)) $whereConditions[] = 'position_group_id ='.$position_group_id;
			
			$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   ); 
			$total = $this->EmployeePosition->find('count', array('conditions' => $whereConditions ));
			$EmployeePositions = $this->EmployeePosition->find('all',$conditions); 
								  
		}
		
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ข้อมูล ตำแหน่งของพนักงานราชการ' ,
								'url' => ''
								)
		);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$PositionGroups = $this->PositionGroup->find('list',$conditions);

		$this->set('breadcrumb',$breadcrumb);
		$this->set('PositionGroups',$PositionGroups);
		$this->set('EmployeePositions',$EmployeePositions);  
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'EmployeePosition','pages' => 5);
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
			$EmployeePositions = $this->EmployeePosition->find('all',$conditions);  
			
			foreach($EmployeePositions[0]['EmployeePosition'] as $key => $value)
				$default[$key] = $value;
			
			$this->set('default',$default);
			
		}
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$PositionGroups = $this->PositionGroup->find('list',$conditions);
		$this->set('PositionGroups',$PositionGroups);

	}       
        
	public function save($id=null) {
		$this->autoRender = false;
		 
		$data = $this->request->data;
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->EmployeePosition->id = $id;
				if($this->EmployeePosition->exists())
				$status = $this->EmployeePosition->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{

				$data['id'] = $this->Generator->getID(); 
				$this->EmployeePosition->create();
				$status = $this->EmployeePosition->save($data) ? 'SUCCESS' : 'FAILED';
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
				$this->EmployeePosition->id = $id;
				if($this->EmployeePosition->exists())
				$status = $this->EmployeePosition->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
		   
		}                    
		
		echo json_encode(array('status' => $status));
	} 
        
}
?>