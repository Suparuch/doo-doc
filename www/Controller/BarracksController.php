<?php
App::uses('AppController', 'Controller');

class BarracksController extends AppController {

	public $name = 'Barracks';
	public $uses = array('Area','Barrack','Province','Zone','District');
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
			$Barracks = $this->Barrack->find('all',$conditions);
			$total = $this->Barrack->find('count',$conditions);
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);

			//intitial
			$whereConditions = array();
			$whereCOnditions['deleted'] = 'N';
			
			$offset = empty($dataRequest['offset'])? '':$dataRequest['offset'];                 
			$name = empty($dataRequest['name'])? '':$dataRequest['name'];
			$area_id = empty($dataRequest['area_id'])? '':$dataRequest['area_id'];
			$province_id = empty($dataRequest['province_id'])? '':$dataRequest['province_id'];
			$zone_id = empty($dataRequest['zone_id'])? '':$dataRequest['zone_id'];
			$district_id = empty($dataRequest['district_id'])? '':$dataRequest['district_id'];
			$strat_command_date = empty($dataRequest['strat_command_date'])? '':$dataRequest['strat_command_date'];
			$end_command_date = empty($dataRequest['end_command_date'])? '':$dataRequest['end_command_date'];

			if(!empty($name)) $whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
			if(!empty($area_id)) $whereConditions[] = 'area_id = '.$area_id;
			if(!empty($province_id)) $whereConditions[] = 'province_id = '.$province_id;
			if(!empty($zone_id)) $whereConditions[] = 'zone_id = '.$zone_id;
			//if(!empty($strat_command_date)) $whereConditions[] = 'strat_command_date = '.$strat_command_date;
			//if(!empty($end_command_date)) $whereConditions[] = 'end_command_date = '.$end_command_date;
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$Barracks = $this->Barrack->find('all',$conditions); 
			$total = $this->Barrack->find('count', array('conditions' => $whereConditions ));              
		}

		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Areas = $this->Area->find('list',$conditions);

		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Provinces = $this->Province->find('list',$conditions);
		$Zones = array();
		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Zones = $this->Zone->find('list',$conditions);
	
		
		$Districts  = array();
		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Districts = $this->District->find('list',$conditions);
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ข้อมูลค่ายทหาร' ,
								'url' => ''
								)
		);
		$this->set('breadcrumb',$breadcrumb);         

		$this->set('Areas',$Areas);
		$this->set('Provinces',$Provinces);
		$this->set('Barracks',$Barracks);
		$this->set('Zones',$Zones);
		$this->set('Districts',$Districts);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Barrack','pages' => 5);
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
				$Barracks = $this->Barrack->find('all',$conditions);  
				
				foreach($Barracks[0]['Barrack'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);                
		}

		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Areas = $this->Area->find('list',$conditions);

		$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Provinces = $this->Province->find('list',$conditions);
		$Zones = array();
		$Districts  = array();
		if(!empty($default['province_id']))
		{	
			$conditions = array('conditions' => array('deleted' => 'N','province_id'=>$default['province_id']),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Zones = $this->Zone->find('list',$conditions);
		}
		if(!empty($default['zone_id']))
		{	
			$conditions = array('conditions' => array('deleted' => 'N','zone_id'=>$default['zone_id']),'fields' => array('id','name'),'order' =>  array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Districts = $this->District->find('list',$conditions);
		}
		
		$this->set('Areas',$Areas);
		$this->set('Provinces',$Provinces);
        $this->set('Zones',$Zones);
		$this->set('Districts',$Districts);
	}       
        
	public function save($id = null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->Barrack->id = $id;
				if($this->Barrack->exists())
				$status = $this->Barrack->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{
					//$sql = "SELECT order_sort + 1 as new_order_sort  FROM Barracks WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
					//$results = $this->Barrack->query($sql); 
					//$data['order_sort'] = $results[0][0]['new_order_sort'];                        
					$data['id'] = $this->Generator->getID(); 
					$this->Barrack->create();
					$status = $this->Barrack->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
				$this->Barrack->id = $id;
				if($this->Barrack->exists())
				$status = $this->Barrack->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}
}
?>