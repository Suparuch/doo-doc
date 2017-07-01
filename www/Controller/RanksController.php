<?php
App::uses('AppController', 'Controller');

class RanksController extends AppController {

	public $name = 'Ranks';
	public $uses = array('Rank');
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
			$conditions = array('limit' =>  '20',
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$ranks = $this->Rank->find('all',$conditions);
			$total = $this->Rank->find('count',$conditions);
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);                      
			//intitial
			$whereConditions = array();
			$whereCOnditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$name = $dataRequest['name'];

			if(!empty($name))
			$whereConditions[] = 'name ILIKE \'%'.$name.'%\' OR short_name ILIKE \'%'.$name.'%\'';
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$ranks = $this->Rank->find('all',$conditions); 
			$total = $this->Rank->find('count', array('conditions' => $whereConditions ));              
		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ข้อมูลยศ' ,
								'url' => ''
								)
		);
		$this->set('breadcrumb',$breadcrumb);         
		
		$this->set('ranks',$ranks);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Rank','pages' => 5);
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
									'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   );
				$ranks = $this->Rank->find('all',$conditions);  
				
				foreach($ranks[0]['Rank'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}
            
	}       
        
	public function save($id = null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->Rank->id = $id;
				if($this->Rank->exists())
				$status = $this->Rank->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{
					$sql = "SELECT order_sort + 1 as new_order_sort  FROM ranks WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
					$results = $this->Rank->query($sql);   
					$data['order_sort'] = $results[0][0]['new_order_sort'];                        
					$data['id'] = $this->Generator->getID(); 
					$this->Rank->create();
					$status = $this->Rank->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
				$this->Rank->id = $id;
				if($this->Rank->exists())
				$status = $this->Rank->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}
}
?>