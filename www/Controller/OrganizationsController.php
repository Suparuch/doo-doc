<?php
App::uses('AppController', 'Controller');

class OrganizationsController extends AppController {

	public $name = 'Organizations';
	public $uses = array('Organization','OrganizationStructure','OrganizationType','OrganizationClass','OrganizationTarget','Corp','Province','Zone','District','ModelRate','ModelLevel','Barrack','ModelRate','Month','OrganizationNew');
	public $components = array("FileStorageComponent","Generator","Tracker","DateFormat");
	public $helpers = array('DateFormat');

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
			$total = $this->Organization->find('count',$conditions);
			$Organizations = $this->Organization->find('all',$conditions); 
  
							 
		}else{
			
			
			$default = array();
			$default = $dataRequest;

			$this->set('default',$default);                      
			//intitial
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];

			if(!empty($dataRequest['corp_id'])) $whereConditions[] = "corp_id ='".$dataRequest['corp_id']."'";
			if(!empty($dataRequest['organization_target_id'])) $whereConditions[] = "organization_target_id ='".$dataRequest['organization_target_id']."'";
			if(!empty($dataRequest['organization_type_id'])) $whereConditions[] = "organization_type_id ='".$dataRequest['organization_type_id']."'";
			if(!empty($dataRequest['organization_class_id'])) $whereConditions[] = "organization_class_id ='".$dataRequest['organization_class_id']."'";
			if(!empty($dataRequest['name'])) $whereConditions[] = 'name ILIKE \'%'.$dataRequest['name'].'%\'';
			if(!empty($dataRequest['short_name'])) $whereConditions[] = 'short_name ILIKE \'%'.$dataRequest['short_name'].'%\'';
			if(!empty($dataRequest['barrack_id'])) $whereConditions[] = "barrack_id ='".$dataRequest['barrack_id']."'";
			if(!empty($dataRequest['up_organization_name'])) $whereConditions[] = 'short_name ILIKE \'%'.$dataRequest['up_organization_name'].'%\'';
			if(!empty($dataRequest['under_organization_name'])) $whereConditions[] = 'short_name ILIKE \'%'.$dataRequest['under_organization_name'].'%\'';

			if(!empty($dataRequest['province_id'])) $whereConditions[] = "province_id ='".$dataRequest['province_id']."'";
			if(!empty($dataRequest['zone_id'])) $whereConditions[] = "zone_id ='".$dataRequest['zone_id']."'";
			if(!empty($dataRequest['district_id'])) $whereConditions[] = "district_id ='".$dataRequest['district_id']."'";					
			
			$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   ); 
			$total = $this->Organization->find('count', array('conditions' => $whereConditions ));
			$Organizations = $this->Organization->find('all',$conditions);   
		}

		$breadcrumb = array (   'controller' => array(
								'name' => 'ข้อมูลหน่วยทหาร' ,
								'url' => ''
								)
		);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$OrganizationTypes = $this->OrganizationType->find('list',$conditions);
		$OrganizationClasss = $this->OrganizationClass->find('list',$conditions);
		$OrganizationTargets = $this->OrganizationTarget->find('list',$conditions);
		$Barracks = $this->Barrack->find('list',$conditions);
		
		$Corps = $this->Corp->find('list',$conditions);
		$Provinces = $this->Province->find('list',$conditions);
		$Zones = $this->Zone->find('list',$conditions);
		$Districts = $this->District->find('list',$conditions);

		$this->set('breadcrumb',$breadcrumb);
		$this->set('OrganizationTypes',$OrganizationTypes);
		$this->set('OrganizationClasss',$OrganizationClasss);
		$this->set('OrganizationTargets',$OrganizationTargets);
		$this->set('Barracks',$Barracks);

		$this->set('Corps',$Corps); 
		$this->set('Provinces',$Provinces); 
		$this->set('Zones',$Zones); 
		$this->set('Districts',$Districts);

		$this->set('Organizations',$Organizations);  
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Organization','pages' => 5);
		$this->set('pagination',$pagination);
		
	}
	
	public function compare($id = null) {
		$this->layout = 'blank';
	
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
				$Organizations = $this->Organization->find('all',$conditions);  
				
				foreach($Organizations[0]['Organization'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('code' => 'asc'),'fields' => array('id','code'));
		$ModelRates = $this->ModelRate->find('list',$conditions);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$OrganizationTypes = $this->OrganizationType->find('list',$conditions);
		$OrganizationClasss = $this->OrganizationClass->find('list',$conditions);
		$OrganizationTargets = $this->OrganizationTarget->find('list',$conditions);
		$Barracks = $this->Barrack->find('list',$conditions);
		
		$Corps = $this->Corp->find('list',$conditions);
		$Provinces = $this->Province->find('list',$conditions);
		$Zones = $this->Zone->find('list',$conditions);
		$Districts = $this->District->find('list',$conditions);

		//$this->set('breadcrumb',$breadcrumb);

		$this->set('ModelRates',$ModelRates);
		$this->set('OrganizationTypes',$OrganizationTypes);
		$this->set('OrganizationClasss',$OrganizationClasss);
		$this->set('OrganizationTargets',$OrganizationTargets);
		$this->set('Barracks',$Barracks);

		$this->set('Corps',$Corps); 
		$this->set('Provinces',$Provinces); 
		$this->set('Zones',$Zones); 
		$this->set('Districts',$Districts);

	}       
        
	public function save($id=null) {

		$this->autoRender = false;
		 
		$data = $this->request->data;    
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->Organization->id = $id;
				if($this->Organization->exists())
				$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{
					$sql = "SELECT order_sort + 1 as new_order_sort  FROM organizations WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
					$results = $this->Organization->query($sql);   
					$data['order_sort'] = $results[0][0]['new_order_sort'];
					$data['id'] = $this->Generator->getID(); 
					$this->Organization->create();
					$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
					$this->Organization->id = $id;
					if($this->Organization->exists())
					$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED'; 
					else $status = 'FAILED';    
					
				}else $status =  'FAILED';                                      
					  
				echo json_encode(array('status' => $status));
		}
	} 

	public function create() {
		$this->layout = 'blank';
		$this->autoRender = false;
		 
		$data = $this->request->data;
		
		$organization_id = $this->Generator->getModelID();
		$data['id'] = $organization_id;
		$data['name'] = $data['short_name'];
		$data['level'] = $this->getOrganizationLevel($data['parent_id']) + 1;
		
		$parent_type = '';
		if(!empty($data['organization_type'])) $parent_type = 'organization_type_'.$data['organization_type'].'_';		
		$data['parent_'.$parent_type.'id'] = $data['parent_id'];
		if(!empty($parent_type)) unset($data['parent_id']);
		//pr($data);

		//$this->setStructure($organization_id,$data['parent_id'],$data['organization_type']);
		$this->setStructure($organization_id,$data['parent_'.$parent_type.'id'],$data['organization_type']);
		
		$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED';

		echo json_encode(array('status' => $status,'organization_id' => $organization_id));

	}

	public function move() {
		$this->layout = 'blank';
		$this->autoRender = false;

		$data = $this->request->data;

		$data['level'] = $this->getOrganizationLevel($data['parent_id']) + 1;
		
		$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED'; 

		$this->deleteStructure($data['id'],$data['organization_type']);
		$this->setStructure($data['id'],$data['parent_id'],$data['organization_type']);

		$Organizations = $this->getChildAll($data['id'],$data['organization_type']);
		pr($Organizations);
		//die;

		$parent_type = '';
		if(!empty($organization_type)) $parent_type = 'organization_type_'.$organization_type.'_';
		$conditions = array('conditions' => array('deleted' => 'N','id' => $Organizations),
							'fields' => array('id','parent_'.$parent_type.'id'),
							'order' => array('level' => 'asc')
							);
		$Organizations = $this->Organization->find('list',$conditions);
		pr($Organizations);

		foreach($Organizations as $organizatio_id => $parent_id){
			$this->deleteStructure($organizatio_id,$data['organization_type']);
			$this->setStructure($organizatio_id,$parent_id,$data['organization_type']);
		}
		
		echo json_encode(array('status' => $status));

	}

	public function remove() { //delete
		$this->layout = 'blank';
		$this->autoRender = false;
		 
		$data = $this->request->data;
		$data['deleted'] = 'Y';		
		$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED'; 

		$this->deleteStructure($data['id'],$data['organization_type']);
		
		echo json_encode(array('status' => $status));

	}

	public function edit() {
		$this->layout = 'blank';
	}

	public function info() {
		$this->layout = 'blank';
	}

	public function detail($id = null,$organization_type = null) {
		
		$this->layout = 'blank';

		$Province = array();
		$Zone = array();
		$District = array();
		$OrganizationType = array();
		$OrganizationTarget = array();
		$Barrack = array();

		$condition = array();
        $condition['deleted'] = 'N';
        $OrganizationAlls = $this->Organization->find('list', array('fields'=>array('id','short_name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc'),'cache' => 'longNameAllList', 'cacheConfig' => 'long'));

        $condition['id'] = $id;
        $Organizations = $this->Organization->find('first', array('conditions' => $condition, 'order' => array('order_sort' => 'asc')));

		$condition = array();
		$condition['deleted'] = 'N';
		$condition['organization_type_id'] = $organization_type;
		$condition['organization_id'] = $id;
		$OrganizationStructures = $this->OrganizationStructure->find('first',array('conditions' => $condition,'order' => array('order_sort' => 'asc')));

		$ModelRate = array();
		if(!empty($Organizations['Organization']['model_id'])){
			$condition = array();
			$condition['id'] = $Organizations['Organization']['model_id'];        
			$condition['deleted'] = 'N';
			$ModelRate = $this->ModelRate->find('first',array('conditions' => $condition));
		}	
		
		if(!empty($Organizations['Organization']['barrack_id'])){
			$condition = array();
			$condition['id'] = $Organizations['Organization']['barrack_id'];        
			$condition['deleted'] = 'N';
			$Barrack = $this->Barrack->find('first',array('conditions' => $condition, 'fields'=>array('id','name')));
		}		
		
		if(!empty($Organizations['Organization']['organization_type_id'])){
			$condition = array();
			$condition['id'] = $Organizations['Organization']['organization_type_id'];        
			$condition['deleted'] = 'N';
			$OrganizationType = $this->OrganizationType->find('first',array('conditions' => $condition, 'fields'=>array('id','name')));
		}

		if(!empty($Organizations['Organization']['organization_target_id'])){
			$condition = array();
			$condition['id'] = $Organizations['Organization']['organization_target_id'];        
			$condition['deleted'] = 'N';
			$OrganizationTarget = $this->OrganizationTarget->find('first',array('conditions' => $condition, 'fields'=>array('id','name')));
		}
		
		if(!empty($Organizations['Organization']['province_id'])){
			$condition = array();
			$condition['id'] = $Organizations['Organization']['province_id'];        
			$condition['deleted'] = 'N';
			$Province = $this->Province->find('first',array('conditions' => $condition, 'fields'=>array('name')));
		}

		if(!empty($Organizations['Organization']['zone_id'])){
			$condition = array();
			$condition['id'] = $Organizations['Organization']['zone_id'];        
			$condition['deleted'] = 'N';
			$Zone = $this->Zone->find('first',array('conditions' => $condition, 'fields'=>array('name')));
		}

		if(!empty($Organizations['Organization']['district_id'])){
			$condition = array();
			$condition['id'] = $Organizations['Organization']['district_id'];        
			$condition['deleted'] = 'N';
			$District = $this->District->find('first',array('conditions' => $condition, 'fields'=>array('name','code')));
		}

		$condition = array();      
        $condition['deleted'] = 'N';        
		$ModelLevels = $this->ModelLevel->find('list', array('fields'=>array('code','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));	

		$this->set('organization_type',$organization_type);
		$this->set('Organizations',$Organizations);
		$this->set('OrganizationAlls',$OrganizationAlls);
		$this->set('OrganizationStructures',$OrganizationStructures);
		$this->set('ModelRate',$ModelRate);
		$this->set('Province',$Province);
		$this->set('Zone',$Zone);
		$this->set('District',$District);
		$this->set('Barrack',$Barrack);
		$this->set('OrganizationType',$OrganizationType);
		$this->set('OrganizationTarget',$OrganizationTarget);
		$this->set('ModelLevels',$ModelLevels);
	
	}
	
	public function detail2($id = null,$organization_type = null) {
		
		$this->layout = 'blank';

		$Province = array();
		$Zone = array();
		$District = array();
		$OrganizationType = array();
		$OrganizationTarget = array();
		$Barrack = array();

		$condition = array();
        $condition['deleted'] = 'N';
        $OrganizationAlls = $this->OrganizationNew->find('list', array('fields'=>array('id','short_name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc'),'cache' => 'longNameAllList', 'cacheConfig' => 'long'));

        $condition['id'] = $id;
        $Organizations = $this->OrganizationNew->find('first', array('conditions' => $condition, 'order' => array('order_sort' => 'asc')));

		$condition = array();
		$condition['deleted'] = 'N';
		$condition['organization_type_id'] = $organization_type;
		$condition['organization_id'] = $id;
		$OrganizationStructures = $this->OrganizationStructure->find('first',array('conditions' => $condition,'order' => array('order_sort' => 'asc')));

		$ModelRate = array();
		if(!empty($Organizations['OrganizationNew']['model_id'])){
			$condition = array();
			$condition['id'] = $Organizations['OrganizationNew']['model_id'];        
			$condition['deleted'] = 'N';
			$ModelRate = $this->ModelRate->find('first',array('conditions' => $condition));
		}	
		
		if(!empty($Organizations['OrganizationNew']['barrack_id'])){
			$condition = array();
			$condition['id'] = $Organizations['OrganizationNew']['barrack_id'];        
			$condition['deleted'] = 'N';
			$Barrack = $this->Barrack->find('first',array('conditions' => $condition, 'fields'=>array('id','name')));
		}		
		
		if(!empty($Organizations['OrganizationNew']['organization_type_id'])){
			$condition = array();
			$condition['id'] = $Organizations['OrganizationNew']['organization_type_id'];        
			$condition['deleted'] = 'N';
			$OrganizationType = $this->OrganizationType->find('first',array('conditions' => $condition, 'fields'=>array('id','name')));
		}

		if(!empty($Organizations['OrganizationNew']['organization_target_id'])){
			$condition = array();
			$condition['id'] = $Organizations['OrganizationNew']['organization_target_id'];        
			$condition['deleted'] = 'N';
			$OrganizationTarget = $this->OrganizationTarget->find('first',array('conditions' => $condition, 'fields'=>array('id','name')));
		}
		
		if(!empty($Organizations['OrganizationNew']['province_id'])){
			$condition = array();
			$condition['id'] = $Organizations['OrganizationNew']['province_id'];        
			$condition['deleted'] = 'N';
			$Province = $this->Province->find('first',array('conditions' => $condition, 'fields'=>array('name')));
		}

		if(!empty($Organizations['OrganizationNew']['zone_id'])){
			$condition = array();
			$condition['id'] = $Organizations['OrganizationNew']['zone_id'];        
			$condition['deleted'] = 'N';
			$Zone = $this->Zone->find('first',array('conditions' => $condition, 'fields'=>array('name')));
		}

		if(!empty($Organizations['OrganizationNew']['district_id'])){
			$condition = array();
			$condition['id'] = $Organizations['OrganizationNew']['district_id'];        
			$condition['deleted'] = 'N';
			$District = $this->District->find('first',array('conditions' => $condition, 'fields'=>array('name','code')));
		}

		$condition = array();      
        $condition['deleted'] = 'N';        
		$ModelLevels = $this->ModelLevel->find('list', array('fields'=>array('code','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));	

		$this->set('organization_type',$organization_type);
		$this->set('Organizations',$Organizations);
		$this->set('OrganizationAlls',$OrganizationAlls);
		$this->set('OrganizationStructures',$OrganizationStructures);
		$this->set('ModelRate',$ModelRate);
		$this->set('Province',$Province);
		$this->set('Zone',$Zone);
		$this->set('District',$District);
		$this->set('Barrack',$Barrack);
		$this->set('OrganizationType',$OrganizationType);
		$this->set('OrganizationTarget',$OrganizationTarget);
		$this->set('ModelLevels',$ModelLevels);
	
	}

	public function control() {
		$condition = array();
        $condition['deleted'] = 'N';
        $OrganizationTypes = $this->OrganizationType->find('list', array('fields'=>array('id','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc'),'cache' => 'longNameList', 'cacheConfig' => 'long'));		
		$this->set('OrganizationTypes',$OrganizationTypes);
	}

    public function getData($parent_id = NULL,$organization_type = null) {

        $this->disableCache();
        $this->autoRender = false;

		$condition = array();
        //$condition['parent_id'] = $parent_id;
        $condition['deleted'] = 'N';

		if($organization_type == 0){
			$condition['parent_id'] = $parent_id; 
		}else{ 
			if(!empty($organization_type)) $condition['parent_organization_type_'.$organization_type.'_id'] = $parent_id;
		}
        $Organizations = $this->Organization->find('all', array('conditions' => $condition, 'order' => array('order_sort' => 'asc')));

        $i = 0;
		$data_array = array();
        if (!empty($Organizations)) {			
            foreach ($Organizations as $Organization) {

				$data_array[$i]['data']['title'] = $Organization['Organization']['short_name'];
				$data_array[$i]['data']['attr']['id'] = "0" . $Organization['Organization']['id'];
				//$data_array[$i]['data']['attr']['level'] = $Organization['Organization']['organization_level'];
				$data_array[$i]['data']['attr']['level'] = 1;
				$data_array[$i]['state'] = 'closed';
                $data_array[$i]['attr']['id'] = "0" . $Organization['Organization']['id'];
                $data_array[$i]['attr']['parent_id'] = $Organization['Organization']['parent_id'];
                //$data_array[$i]['attr']['level'] = $Organization['Organization']['organization_level'];
				$data_array[$i]['attr']['level'] = 1;
				$i++;
            }
        }
        print_r(json_encode($data_array));

    }
	
	public function getData2($parent_id = NULL,$organization_type = null) {

        $this->disableCache();
        $this->autoRender = false;

		$condition = array();
        //$condition['parent_id'] = $parent_id;
        $condition['deleted'] = 'N';

		if($organization_type == 0 || $organization_type == 9){
			$condition['parent_id'] = $parent_id; 
		}else{ 
			if(!empty($organization_type)) $condition['parent_organization_type_'.$organization_type.'_id'] = $parent_id;
		}
        $Organizations = $this->OrganizationNew->find('all', array('conditions' => $condition, 'order' => array('order_sort' => 'asc')));
        $i = 0;
		$data_array = array();
        if (!empty($Organizations)) {			
            foreach ($Organizations as $Organization) {

				$data_array[$i]['data']['title'] = $Organization['OrganizationNew']['short_name'];
				$data_array[$i]['data']['attr']['id'] = $Organization['OrganizationNew']['id'];
				//$data_array[$i]['data']['attr']['level'] = $Organization['Organization']['organization_level'];
				$data_array[$i]['data']['attr']['level'] = 1;
				$data_array[$i]['state'] = 'closed';
                $data_array[$i]['attr']['id'] = $Organization['OrganizationNew']['id'];
                $data_array[$i]['attr']['parent_id'] = $Organization['OrganizationNew']['parent_id'];
                //$data_array[$i]['attr']['level'] = $Organization['Organization']['organization_level'];
				$data_array[$i]['attr']['level'] = 1;
				$i++;
            }
        }
        print_r(json_encode($data_array));

    }

	public function editModel() {
		$this->layout = 'blank';
	
	}

	public function editModelProperty($id = null,$organization_type=null) {

		$this->layout = 'blank';

		$condition = array();      
        $condition['deleted'] = 'N';        
		$ModelLevels = $this->ModelLevel->find('list', array('fields'=>array('code','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));	
		
        $condition['id'] = $id;
        $Organizations = $this->Organization->find('first', array('fields'=>array('id','rate_property'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));

		$this->set('ModelLevels',$ModelLevels);
		$this->set('Organizations',$Organizations);
		$this->set('organization_type',$organization_type);
	
	}

	public function enableModelProperty($id = null,$organization_type=null) {
	
			$this->layout = 'blank';
	
			$condition = array();      
			$condition['deleted'] = 'N';        
			$ModelLevels = $this->ModelLevel->find('list', array('fields'=>array('code','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));	
			
			$condition['id'] = $id;
			$Organizations = $this->Organization->find('first', array('fields'=>array('id','rate_property'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));
	
			$this->set('ModelLevels',$ModelLevels);
			$this->set('Organizations',$Organizations);
			$this->set('organization_type',$organization_type);
		
		}

	public function setModelProperty() {
		$this->layout = 'blank';
		$this->autoRender = false;
		$this->disableCache();

		$data = $this->request->data;

		if(!empty($data)){
			$id = $this->request->data['id'];
			$this->Organization->id = $id;
			if($this->Organization->exists())
				$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED';
			else $status = 'FAILED';

			if($status == 'SUCCESS') $message = 'บันทึกข้อมูลเรียบร้อย';
			else $message = 'เกิดข้อผิดพลาด';
		}
		echo json_encode(array('status' => $status,'message' => $message));

	}

	public function editModelEquipment($id = null,$organization_type=null) {

		$this->layout = 'blank';

		$condition = array();      
        $condition['deleted'] = 'N';        
		$ModelLevels = $this->ModelLevel->find('list', array('fields'=>array('code','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));	
		
        $condition['id'] = $id;
        $Organizations = $this->Organization->find('first', array('fields'=>array('id','rate_equipment'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));
		
		$this->set('ModelLevels',$ModelLevels);
		$this->set('Organizations',$Organizations);
		$this->set('organization_type',$organization_type);
	
	}

	public function setModelEquipment() {
		$this->layout = 'blank';
		$this->autoRender = false;
		$this->disableCache();

		$data = $this->request->data;

		if(!empty($data)){
			$id = $this->request->data['id'];
			$this->Organization->id = $id;
			if($this->Organization->exists())
			$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED';  
			else $status = 'FAILED';
			 
			if($status == 'SUCCESS') $message = 'บันทึกข้อมูลเรียบร้อย';
			else $message = 'เกิดข้อผิดพลาด';
		}
		echo json_encode(array('status' => $status,'message' => $message));	
	
	}

	public function editDetail($id = null,$organization_type = null) {

		$this->layout = 'blank';

		$condition = array();
        $condition['deleted'] = 'N';
        $OrganizationAlls = $this->Organization->find('list', array('fields'=>array('id','short_name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc'),'cache' => 'longNameAllList', 'cacheConfig' => 'long'));

		$condition = array();
        $condition['id'] = $id;
        $condition['deleted'] = 'N';
        $Organizations = $this->Organization->find('first', array('conditions' => $condition, 'order' => array('order_sort' => 'asc')));
		//$Province = $this->Province->find('list',array('fields'=>array('id','name'),'order' => array('order_sort' => 'asc')));
		$OrganizationTypes = $this->OrganizationType->find('list',array('fields'=>array('id','name'),'order' => array('order_sort' => 'asc')));
		$Barracks = $this->Barrack->find('list',array('fields'=>array('id','name'),'order' => array('order_sort' => 'asc')));
		$OrganizationTargets = $this->OrganizationTarget->find('list',array('fields'=>array('id','name'),'order' => array('order_sort' => 'asc')));		
		$Months = $this->Month->find('list',array('fields'=>array('id','name'),'order' => array('order_sort' => 'asc')));		

		$conditions = array();
		$conditions = array('conditions' => array('deleted' => 'N','model_type_id' => 1),'order'=>array('code' => 'asc'),'fields' => array('id','code','name','model_date'));
		$ModelRates = $this->ModelRate->find('all',$conditions);		
		$ModelRateType1s = array('group1' => ' - - - อจย. - - - ');
		foreach($ModelRates as $ModelRate){		
			$ModelRateType1s[$ModelRate['ModelRate']['id']] = $ModelRate['ModelRate']['code'] . ' [ ' . $ModelRate['ModelRate']['name'] .' ] - '. $this->DateFormat->formatDateThai($ModelRate['ModelRate']['model_date']);
		}
		$ModelRateType1s = array('group1' => ' - - - อจย. - - - ') + $ModelRateType1s;

		$conditions = array();
		$conditions = array('conditions' => array('deleted' => 'N','model_type_id' => 2),'order'=>array('code' => 'asc'),'fields' => array('id','code','name','model_date'));
		$ModelRates = $this->ModelRate->find('all',$conditions);		
		$ModelRateType2s = array('group2' => ' - - - อฉก. - - - ');
		foreach($ModelRates as $ModelRate){		
			$ModelRateType2s[$ModelRate['ModelRate']['id']] = $ModelRate['ModelRate']['code'] . ' [ ' . $ModelRate['ModelRate']['name'] .' ] - '. $this->DateFormat->formatDateThai($ModelRate['ModelRate']['model_date']);
		}

		//$ModelRates = array_merge($ModelRateType1s, $ModelRateType2s);
		$ModelRates = $ModelRateType1s + $ModelRateType2s;
		//pr($ModelRates);

		$Province = array();
		$condition = array();
        $condition['deleted'] = 'N';
        $Province = $this->Province->find('list',array('fields'=>array('id','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));

		$Zone = array();
		if(!empty($Organizations['Organization']['province_id'])){
			$condition = array();
			$condition['deleted'] = 'N';
			$condition['province_id'] = $Organizations['Organization']['province_id'];
			$Zone = $this->Zone->find('list',array('fields'=>array('id','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));
		}

		$District = array();
		if(!empty($Organizations['Organization']['zone_id'])){
			$condition = array();
			$condition['deleted'] = 'N';
			$condition['zone_id'] = $Organizations['Organization']['zone_id'];
			$District = $this->District->find('list',array('fields'=>array('id','name'),'conditions' => $condition, 'order' => array('order_sort' => 'asc')));
		}
	 
		$condition = array();
		$condition['deleted'] = 'N';
		$condition['organization_type_id'] = $organization_type;
		$condition['organization_id'] = $id;
		$OrganizationStructures = $this->OrganizationStructure->find('first',array('conditions' => $condition,'order' => array('order_sort' => 'asc')));

		$this->set('OrganizationAlls',$OrganizationAlls);
		$this->set('Organizations',$Organizations);
		$this->set('OrganizationStructures',$OrganizationStructures);

		$this->set('Province',$Province);
		$this->set('Zone',$Zone);
		$this->set('District',$District);
		$this->set('OrganizationTypes',$OrganizationTypes);
		$this->set('Barracks',$Barracks);
		$this->set('OrganizationTargets',$OrganizationTargets);
		$this->set('Months',$Months);

		$this->set('ModelRates',$ModelRates);

		$start_year = 1950;
		$current_year = date("Y");
		for($year = $start_year;$year<=$current_year;$year++){
			$Years[$year] = $year + 543;		
		}
		$this->set('Years',$Years);

	}

	public function update($id = null){
		$this->layout = 'blank';
		$this->autoRender = false;
		$this->disableCache();

		$data = $this->request->data;
		//pr($data);
		//die;

		 if(!empty($id)){
			 if(!empty($data)){

				 $this->Organization->id =$id;
					 if($this->Organization->exists())
					//	$status = $this->Organization->save($data) ? 'SUCCESS' : 'FAILED'; 
					 	$status = $this->Organization->save($data) ? 'บันทึกข้อมูลเรียบร้อย' : 'แก้ไขล้มเหลว'; 
					else $status = 'FAILED';    
				
		

				/* pr($data);*/
			 }//-End if data -//
		 }//-End if id -//
		 echo $status;
		// echo json_encode(array('status' => $status));	
	}

	public function organizationType($organization_type_id){

		$this->layout = 'blank';
		//$this->autoRender = false;
		$this->disableCache();

		//pr($organization_type_id);
		$this->set('organization_type_id',$organization_type_id);

	}

	public function genOrganizationStructure($organization_type_id = null){

		$this->layout = 'blank';
		$this->autoRender = false;
		$this->disableCache();

		$parent_type = '';
		if($organization_type_id !='') $parent_type = 'organization_type_'.$organization_type_id.'_';

		$condition =array();		
		$OrganizationAlls =  $this->Organization->find('all',array('fields' => array('id','parent_'.$parent_type.'id'),'conditions' => $condition,'order' => array('id' => 'asc')));

		foreach($OrganizationAlls as $Organization){
			$Organizations[$Organization['Organization']['id']] = $Organization['Organization'];			
		}

		$data = array();
		foreach($Organizations as $key => $Organization){

			$id = $key;
			//$parent[$id] = $this->getParentArr($Organizations,$id);
			$parents = $this->getParentArr($Organizations,$id,$parent_type);
			pr($parents);
			$level = count($parents)-1;
			pr($level);
			unset($parents[$level]);
			//array_splice($parents, 0, 1);
			pr($parents);			
			$level = count($parents);
			$i = $level-1;
			$data = array();
			$data['id'] = $this->Generator->getID();
			$data['organization_type_id'] = empty($organization_type_id)? 0:$organization_type_id;
			$data['organization_id'] = $id;
			$data['organization_level'] = $level;
			foreach($parents as $parent){
				$data['level_'.$i] = $parent;
				$i--;
			}
			
			$data['max_level'] = $level;
			pr($data);
			//die;
			$this->OrganizationStructure->save($data);
			pr('<hr>');

			$data = array();
			$data['id'] = $id;
			$data['level'] = $level;
			$this->Organization->save($data);
			
		}
	
	}

	function getOrganizationLevel($organization_id){

		$this->layout = 'blank';
		$this->autoRender = false;
		$this->disableCache();

		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$whereConditions['id'] = $organization_id;		
		$conditions = array('limit' =>   $this->Generator->setLimit(),
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Organizations = $this->Organization->find('first',$conditions);

		return $Organizations['Organization']['level'];
	}

	function getParentArr($elements, $id,$parent_type){
		
		$arr_parent = array();
		$arr_parent[] = $id;
		$parent_id = $id;
		while($elements[$parent_id]['parent_'.$parent_type.'id'] != -1){
			$arr_parent[] = $elements[$parent_id]['parent_'.$parent_type.'id'];
			$parent_id = $elements[$parent_id]['parent_'.$parent_type.'id'];
		}
		$arr_parent[] = $elements[$parent_id]['parent_'.$parent_type.'id'];
		//asort($arr_parent);
		return $arr_parent;
	
	}

	function deleteStructure($organization_id,$organization_type_id){

		$this->layout = 'blank';
		$this->autoRender = false;
		
		$condition = array('organization_id' => $organization_id,'organization_type_id' => $organization_type_id );
		$this->OrganizationStructure->deleteAll($condition);

	}

	function setStructure($organization_id,$parent_organization_id,$organization_type_id){

		$this->layout = 'blank';
		$this->autoRender = false;

		$conditions = array(
							'conditions' => array('deleted' => 'N','organization_id' => $parent_organization_id,'organization_type_id' => $organization_type_id),
							'fields' => array('organization_level','level_0','level_1','level_2','level_3','level_4','level_5','level_6','level_7','level_8')
						   );
		$OrganizationStructures = $this->OrganizationStructure->find('first',$conditions);

		if(!empty($OrganizationStructures)){

			$next_level = $OrganizationStructures['OrganizationStructure']['organization_level'];

			$data = $OrganizationStructures['OrganizationStructure'];
			$data['id'] = $this->Generator->getID();
			$data['organization_id'] = $organization_id;
			$data['organization_level'] = $next_level+1;
			$data['name'] = 'move';
			$data['level_'.$next_level] = $organization_id;
			$data['max_level'] = $next_level+1;

			$this->OrganizationStructure->save($data);

			$data = array();
			$data['id'] = $organization_id;
			$data['level'] = $next_level+1;
			$this->Organization->save($data);

		}
	
	}

	function getChildAll($Organizations,$organization_type){

		$this->layout = 'blank';
		$this->autoRender = false;
		$MergeOrganizations = array();
		$Organizations = $this->getChild($Organizations,$organization_type,$MergeOrganizations);
		return $Organizations;

	}

	function getChild($Organizations,$organization_type,$MergeOrganizations){

		$this->layout = 'blank';
		$this->autoRender = false;

		$parent_type = '';
		if(!empty($organization_type)) $parent_type = 'organization_type_'.$organization_type.'_';
		$conditions = array('conditions' => array('deleted' => 'N','parent_'.$parent_type.'id' => $Organizations),
							//'fields' => array('id','parent_'.$parent_type.'id')
							'fields' => array('id')
							);
		$Organizations = $this->Organization->find('list',$conditions);
		$MergeOrganizations = array_merge($MergeOrganizations, $Organizations);
		if(!empty($Organizations)) $Organizations = $this->getChild($Organizations,$organization_type,$MergeOrganizations);
		$MergeOrganizations = array_merge($MergeOrganizations, $Organizations);
		
		return $MergeOrganizations;

	}

	function insertChild($organization_id,$organization_type){

		$this->layout = 'blank';
		//$this->autoRender = false;
		
		$this->set('organization_id',$organization_id);
		$this->set('organization_type',$organization_type);
	}

	/*
	function getParentAll($elements, $id,$parent_type){
		
		$this->layout = 'blank';
		$this->autoRender = false;

		$parent_type = '';
		if(!empty($organization_type)) $parent_type = 'organization_type_'.$organization_type.'_';
		$conditions = array('conditions' => array('deleted' => 'N','parent_'.$parent_type.'id' => $Organizations),
							//'fields' => array('id','parent_'.$parent_type.'id')
							'fields' => array('id')
							);
		$Organizations = $this->Organization->find('list',$conditions);
		$MergeOrganizations = array_merge($MergeOrganizations, $Organizations);
		if(!empty($Organizations)) $Organizations = $this->getParent($Organizations,$organization_type,$MergeOrganizations);
		$MergeOrganizations = array_merge($MergeOrganizations, $Organizations);
		
		return $MergeOrganizations;
	
	}

	function getParent($Organizations,$organization_type,$MergeOrganizations){

		$this->layout = 'blank';
		$this->autoRender = false;

		$parent_type = '';
		if(!empty($organization_type)) $parent_type = 'organization_type_'.$organization_type.'_';
		$conditions = array('conditions' => array('deleted' => 'N','parent_'.$parent_type.'id' => $Organizations),
							//'fields' => array('id','parent_'.$parent_type.'id')
							'fields' => array('id')
							);
		$Organizations = $this->Organization->find('list',$conditions);
		$MergeOrganizations = array_merge($MergeOrganizations, $Organizations);
		if(!empty($Organizations)) $Organizations = $this->getChild($Organizations,$organization_type,$MergeOrganizations);
		$MergeOrganizations = array_merge($MergeOrganizations, $Organizations);
		
		return $MergeOrganizations;

	}
	*/
}
?>
