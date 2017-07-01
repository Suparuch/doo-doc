<?php
App::uses('AppController', 'Controller');

class DistrictsController extends AppController {

	public $name = 'Districts';
	public $uses = array('District','Zone');
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
			$total = $this->District->find('count',$conditions);
			$districts = $this->District->find('all',$conditions); 
  
							 
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);                    
			//intitial
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$name = $dataRequest['name'];
			$zone_id = $dataRequest['zone_id'];

			if(!empty($name))
			$whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
			if(!empty($zone_id))
			$whereConditions['zone_id'] = $zone_id;
			
			$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   ); 
			$total = $this->District->find('count', array('conditions' => $whereConditions ));
			$districts = $this->District->find('all',$conditions); 

			
			
		}              
                     

		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('name'),'order' =>  array('order_sort' => 'asc'),
						   ); 
		$zones = $this->Zone->find('list',$conditions); 
		$this->set('zones',$zones); 


		$breadcrumb = array ( 'controller' => array(   
							  'name' => 'ข้อมูลตำบล' ,
							  'url' => ''
							)
		);
		$this->set('breadcrumb',$breadcrumb);  
		$this->set('districts',$districts);  
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'District','pages' => 5);
		$this->set('pagination',$pagination);                    
	}

	public function form($id = null) {
		$this->layout = 'blank';
		$default = array();
		if(!empty($id)){
			
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';
			$whereConditions['id'] = $id;
			$conditions = array('limit' =>  '1',
								'conditions' => $whereConditions
							   );
			$districts = $this->District->find('all',$conditions);  
			
			foreach($districts[0]['District'] as $key => $value)
				$default[$key] = $value;
			
			$this->set('default',$default);          
				
		}
		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('name'),
						   ); 
		$zones = $this->Zone->find('list',$conditions); 
		$this->set('zones',$zones);               

	}       
        
	public function save($id=null) {
		$this->autoRender = false;
		 
		$data = $this->request->data;    
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->District->id = $id;
				if($this->District->exists())
				$status = $this->District->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{
					$data['id'] = $this->Generator->getID(); 
					$this->District->create();
					$status = $this->District->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
				$this->District->id = $id;
				if($this->District->exists())
				$status = $this->District->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';        
			
		}
			  
		echo json_encode(array('status' => $status));
	}

	public function getDistrict($zoneId = null){
		$this->layout = 'blank';
		$this->autoRender = false;
		$this->disableCache();

		if(!empty($zoneId)){
				$condition = array();
				$condition['zone_id'] = $zoneId;        
				$condition['deleted'] = 'N';
				$District = $this->District->find('all', array('conditions' => $condition, 'fields'=>array('id','name'),'order' => array('order_sort' => 'asc')));
				
				$data_array= array();
				foreach ($District as $District) {
					$data_array[] ='<option value="'.$District['District']['id'].'">'.$District['District']['name'].'</option>';
				}

				print_r($data_array);
		}
	

	}
        
}
?>