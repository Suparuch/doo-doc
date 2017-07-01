<?php
App::uses('AppController', 'Controller');
set_time_limit(500);
class ModelRatesController extends AppController {

	public $name = 'ModelRates';
	public $uses = array('ModelRate','ModelType','ModelStatus','ModelDocument','ModelProperty','ModelEquipment','ModelDivision','ModelPosition','ModelGroup','Organization','OrganizationModel','Equipment','Corp','Rank');
	public $components = array("FileStorageComponent","Generator");
	//public $helpers = array('TinyMCE');

	function beforeFilter(){
		$currentUser = $this->Session->check('AuthUser');
		if(empty($currentUser)){
			$this->Session->delete('AuthUser');
			$this->Session->destroy();

			$url = Configure::read('Application.Domain').'Logins';
			$this->redirect($url);
		}
	}

	public function index($model_type_id = null) {

		$data = $this->request->data;
		
		$model_type_id = empty($data['model_type_id'])? 1 : $data['model_type_id'];
	
		$whereConditions = array();
		if(empty($data)){
			$offset = 0;
			
			if(!empty($model_type_id))
			$whereConditions[] = "model_type_id = '".$model_type_id."'";
			$whereConditions['deleted'] = 'N';            
			$conditions = array('limit' =>  '20',
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$ModelRates = $this->ModelRate->find('all',$conditions);
			$total = $this->ModelRate->find('count',$conditions);
		}else{
			
			$default = array();
			$default = $data;
			$this->set('default',$default);                      
			//intitial
			$whereCOnditions['deleted'] = 'N';
			
			$offset = $data['offset'];
			
			$code = $data['code'];

			if(!empty($model_type_id))
			$whereConditions[] = "model_type_id = '".$model_type_id."'";
			//$whereConditions['OR'] = array(array('name ILIKE \'%'.$code.'%\''));

			if(!empty($code))
			$whereConditions[] = 'code ILIKE \'%'.$code.'%\'';
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions,
							   );
			$ModelRates = $this->ModelRate->find('all',$conditions); 
			$total = $this->ModelRate->find('count', array('conditions' => $whereConditions ));              
		}            
	 
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$ModelTypes = $this->ModelType->find('list',$conditions);
		$ModelStatus = $this->ModelStatus->find('list',$conditions);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longShortNameList', 'cacheConfig' => 'long');
		$ModelTypeShorts = $this->ModelType->find('list',$conditions);

		$breadcrumb = array (   'controller' => array(   
								'name' => $ModelTypes[$model_type_id],
								'url' => ''
								)
		);

		$this->set('breadcrumb',$breadcrumb);
		
		$actions = array(   'is_used' => true,
							'action' => array( 'add' => true,
											   'edit' => true,
											   'delete' => true,
											   'lock' => true,
											   'copy' => true
							),
							'name_th' => 'อัตราการจัดและยุทโธปกรณ์'
		);
		$this->set('actions',$actions); 
		
		$this->set('model_type_id',$model_type_id);
		$this->set('ModelRates',$ModelRates);
		$this->set('ModelStatus',$ModelStatus);
		$this->set('ModelTypes',$ModelTypes);
		$this->set('ModelTypeShorts',$ModelTypeShorts);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'ModelRate','pages' => 5);
		$this->set('pagination',$pagination);                 
	}

	public function addModelRate($id = null){
		$this->layout = 'blank';

	}

	public function editModelRate($id = null) {

		set_time_limit(0);
		ini_set('memory_limit','3000M');

		$this->layout = 'blank';

		$whereConditions = array();
		if(!empty($id))
		$whereConditions[] = "id = '".$id."'";
		$whereConditions['deleted'] = 'N';            
		$conditions = array('conditions' => $whereConditions);
		$ModelRates = $this->ModelRate->find('first',$conditions);

		$whereConditions = array();
		$whereConditions[] = "model_id = '".$id."'";
		$whereConditions['deleted'] = 'N';
		$conditions = array(
							'order' =>  array('model_category_id' => 'asc','id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelDocuments = $this->ModelDocument->find('all',$conditions);

		$conditions = array(
							'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions,
							'recursive' => 3
						   );
		$ModelDivisions = $this->ModelDivision->find('all',$conditions);
		//pr($ModelDivisions);
		//die;

		/*
		$conditions = array(
							'order' =>  array('model_division_id' => 'asc','id' => 'asc'),//order_sort
							'conditions' => $whereConditions,
							'fields' => array('id','name','comment','model_division_id')
						   );
		$ModelPositions = $this->ModelPosition->find('list',$conditions);

		$conditions = array(
							'order' =>  array('model_division_id' => 'asc','model_position_id' => 'asc','corp_id' => 'asc','rank_id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelProperties = $this->ModelProperty->find('all',$conditions);

		$conditions = array(
							'order' =>  array('model_division_id' => 'asc','id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelEquipments = $this->ModelEquipment->find('all',$conditions);
		*/
		$conditions = array(
							'conditions' => $whereConditions
						   );
		$OrganizationModels = $this->OrganizationModel->find('all',$conditions);

		$whereConditions = array();
		$whereConditions[] = "model_parent_id = '".$id."'";
		$whereConditions['deleted'] = 'N';

		$conditions = array(
							'conditions' => $whereConditions
						   );
		$ModelGroups = $this->ModelGroup->find('all',$conditions);
		
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$ListOrganizations = $this->Organization->find('list',$conditions);
		//$ModelDivisions = $this->ModelDivision->find('list',$conditions);
		//$ModelPositions = $this->ModelPosition->find('list',$conditions);
		//$ListEquipments = $this->Equipment->find('list',$conditions);

		//$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		//$ModelTypes = $this->ModelType->find('list',$conditions);
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longShortNameList', 'cacheConfig' => 'long');
		$ModelTypeShorts = $this->ModelType->find('list',$conditions);
		$Corps = $this->Corp->find('list',$conditions);
		$Ranks = $this->Rank->find('list',$conditions);	

		$this->set('ModelRates',$ModelRates);
		$this->set('ModelDocuments',$ModelDocuments);
		//$this->set('ModelProperties',$ModelProperties);
		//$this->set('ModelEquipments',$ModelEquipments);
		$this->set('ModelDivisions',$ModelDivisions);
		$this->set('ModelGroups',$ModelGroups);
		//$this->set('ModelPositions',$ModelPositions);
		$this->set('OrganizationModels',$OrganizationModels);

		$this->set('ListOrganizations',$ListOrganizations);
		//$this->set('Equipments',$Equipments);

		$this->set('ModelTypeShorts',$ModelTypeShorts);
		$this->set('Corps',$Corps);
		$this->set('Ranks',$Ranks);
		
	}

	public function detailModelRate($id = null) {

		set_time_limit(0);
		ini_set('memory_limit','3000M');

		$this->layout = 'blank';

		$whereConditions = array();
		if(!empty($id))
		$whereConditions[] = "id = '".$id."'";
		$whereConditions['deleted'] = 'N';
		$conditions = array('conditions' => $whereConditions);
		$ModelRates = $this->ModelRate->find('first',$conditions);

		$whereConditions = array();
		$whereConditions[] = "model_id = '".$id."'";
		$whereConditions['deleted'] = 'N';

		$conditions = array(
							'order' =>  array('model_category_id' => 'asc','id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelDocuments = $this->ModelDocument->find('all',$conditions);

		$conditions = array(
							'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions,
							'recursive' => 3
						   );
		$ModelDivisions = $this->ModelDivision->find('all',$conditions);
		//pr($ModelDivisions);
		//die;

		/*

		$conditions = array(
							'order' =>  array('model_division_id' => 'asc','model_position_id' => 'asc','corp_id' => 'asc','rank_id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelProperties = $this->ModelProperty->find('all',$conditions);

		$conditions = array(
							'order' =>  array('model_division_id' => 'asc','id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelEquipments = $this->ModelEquipment->find('all',$conditions);
		*/
		$conditions = array(
							'conditions' => $whereConditions
						   );
		$OrganizationModels = $this->OrganizationModel->find('all',$conditions);

		$whereConditions = array();
		$whereConditions[] = "model_parent_id = '".$id."'";
		$whereConditions['deleted'] = 'N';

		$conditions = array(
							'conditions' => $whereConditions
						   );
		$ModelGroups = $this->ModelGroup->find('all',$conditions);
		
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$ListOrganizations = $this->Organization->find('list',$conditions);
		//$ModelDivisions = $this->ModelDivision->find('list',$conditions);
		//$ModelPositions = $this->ModelPosition->find('list',$conditions);
		//$Equipments = $this->Equipment->find('list',$conditions);

		//$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		//$ModelTypes = $this->ModelType->find('list',$conditions);
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longShortNameList', 'cacheConfig' => 'long');
		$ModelTypeShorts = $this->ModelType->find('list',$conditions);
		$Corps = $this->Corp->find('list',$conditions);
		$Ranks = $this->Rank->find('list',$conditions);
		
		$this->set('ModelRates',$ModelRates);
		$this->set('ModelDocuments',$ModelDocuments);
		$this->set('ModelProperties',$ModelProperties);
		//$this->set('ModelEquipments',$ModelEquipments);
		$this->set('ModelDivisions',$ModelDivisions);
		$this->set('ModelGroups',$ModelGroups);
		$this->set('ModelPositions',$ModelPositions);
		$this->set('OrganizationModels',$OrganizationModels);

		$this->set('ListOrganizations',$ListOrganizations);
		$this->set('Equipments',$Equipments);

		$this->set('ModelTypeShorts',$ModelTypeShorts);
		$this->set('Corps',$Corps);
		$this->set('Ranks',$Ranks);
		
	}

	public function append($id = null){

		$this->layout = "blank";
		$data = $this->request->data;
		//$model_id = $data['model_id'];
		//$index = $data['index'];
		$model = empty($data['model'])? '' : $data['model'];
		$model_id = empty($data['model_id'])? '' : $data['model_id'];
		$model_division_id = empty($data['model_division_id'])? '' : $data['model_division_id'];
		
		//$whereConditions['deleted'] = 'N';            
		//$conditions = array('conditions' => $whereConditions);
		//$ModelDivisions = $this->ModelDivision->find('first',$conditions);
		//$ModelEquipments = $this->ModelEquipment->find('first',$conditions);
		//$ModelPositions = $this->ModelPosition->find('first',$conditions);
		//$model = 'equipment';
		$savedata = array();
		if($model == 'division') {
			
			$model_division_id = $this->Generator->getID();
			$savedata['ModelDivision']['id'] = $model_division_id;
			$savedata['ModelDivision']['model_id'] = $model_id;
			//$savedata['ModelDivision']['order_sort'] = $model_id;
			$this->ModelDivision->save($savedata);
			$this->set('model_division_id',$model_division_id);

		}else if($model == 'position') {

			$model_position_id = $this->Generator->getID();
			$savedata['ModelPosition']['id'] = $model_position_id;
			$savedata['ModelPosition']['model_id'] = $model_id;
			$savedata['ModelPosition']['model_division_id'] = $model_division_id;
			//$savedata['ModelDivision']['order_sort'] = $model_id;
			$this->ModelPosition->save($savedata);
			$this->set('model_position_id',$model_position_id);

		}else if($model == 'property') {

			$model_property_id = $this->Generator->getID();
			$savedata['ModelProperty']['id'] = $model_property_id;
			$savedata['ModelProperty']['model_id'] = $model_id;
			$savedata['ModelProperty']['model_division_id'] = $model_division_id;
			//$savedata['ModelProperty']['model_position_id'] = $model_position_id;
			//$savedata['ModelDivision']['order_sort'] = $model_id;
			$this->ModelProperty->save($savedata);
			$this->set('model_property_id',$model_property_id);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Corps = $this->Corp->find('list',$conditions);
			$Ranks = $this->Rank->find('list',$conditions);
			$this->set('Corps',$Corps);
			$this->set('Ranks',$Ranks);

		}else if($model == 'equipment') {

			$model_equipment_id = $this->Generator->getID();
			$savedata['ModelEquipment']['id'] = $model_equipment_id;
			$savedata['ModelEquipment']['model_id'] = $model_id;
			$savedata['ModelEquipment']['model_division_id'] = $model_division_id;
			//$savedata['ModelProperty']['model_position_id'] = $model_position_id;
			//$savedata['ModelDivision']['order_sort'] = $model_id;
			$this->ModelEquipment->save($savedata);
			$this->set('model_equipment_id',$model_equipment_id);


		}else if($model == 'modelgroup') {

			$model_group_id = $this->Generator->getID();
			$savedata['ModelGroup']['id'] = $model_group_id;
			//$savedata['ModelGroup']['model_id'] = $model_id;
			$savedata['ModelGroup']['model_parent_id'] = $model_parent_id;
			$this->ModelGroup->save($savedata);
			$this->set('model_group_id',$model_group_id);

		}
		//pr($savedata);
		$this->set('model_id',$model_id);
		$this->set('model',$model);
	}

	public function getData($model = null,$key = null){

		$this->layout = 'blank';
		$this->autoRender = false;
		
		$data = array();

		//if(!empty($key)){
			$data = array();
			$whereConditions = array();
			$whereConditions['deleted'] = 'N'; 
			$whereConditions[] = 'name ILIKE \'%'.$key.'%\'';

			$conditions = array('conditions' => $whereConditions,'limit' =>  '10','order'=>array('name' => 'asc'),'fields' => array('id','name'));
			$data = $this->$model->find('list',$conditions);
		//}

		echo json_encode($data);
	
	}

	public function saveModelRate($id = null){
			
		$this->layout = 'blank';
		$this->autoRender = false;
		$data = $this->request->data;    
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->ModelRate->id = $id;
				if($this->ModelRate->exists())
					$status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{
				$this->ModelRate->create();
				$model_id = $this->Generator->getID();
				$data['id'] = $model_id;
				if($data['model_date'] == '--') $data['model_date'] = '';
				$data['model_status_id'] = 1;
				$data['model_class_id'] = 1;
				//$data['organization_id'] = xxx;
				$status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';
			}

			echo json_encode(array('status' => $status,'id' => $model_id));
		}

	}

	public function save($id = null){
		
		$this->autoRender = false;
		$data = $this->request->data;
		pr($data);
		die();
		
			if(!empty($data)){    
				
				if(!empty($id)){
					
					$this->ModelRate->id = $id;
					if($this->ModelRate->exists())
					$status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED'; 
					else $status = 'FAILED';    
					
				}else{
						$sql = "SELECT order_sort + 1 as new_order_sort  FROM ModelRates WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
						$results = $this->ModelRate->query($sql);   
						$data['order_sort'] = $results[0][0]['new_order_sort'];                        
						$data['id'] = $this->Generator->getID(); 
						$this->ModelRate->create();
						$status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
				$this->ModelRate->id = $id;
				if($this->ModelRate->exists())
				$status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}



	public function action() {
		$this->layout = 'blank';
	}

	public function detailRateProperty() {
		$this->layout = 'blank';
	
	}

	public function detailRateEquipment() {
		$this->layout = 'blank';
	
	}

	public function assignProperty() {
		$this->layout = 'blank';
	
	}

	public function assignEquipment() {
		$this->layout = 'blank';
	
	}

	public function lockModelRate() {
	
	}

	public function copyModelRate($id = null) {

		set_time_limit(0);
		ini_set('memory_limit','3000M');

		$this->layout = 'blank';

		$this->autoRender = false;
		$whereConditions = array();
		if(!empty($id))
		$whereConditions[] = "id = '".$id."'";
		$whereConditions['deleted'] = 'N';            
		$conditions = array(
							'conditions' => $whereConditions,
							'fields' => array('id','code','name','model_category_id','comment','model_type_id','model_class_id','is_group','is_group')
						   );
		$ModelRates = $this->ModelRate->find('first',$conditions);

		$whereConditions = array();
		$whereConditions[] = "model_id = '".$id."'";
		$whereConditions['deleted'] = 'N';

		/*
		$conditions = array(
							'order' =>  array('model_category_id' => 'asc','id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelDocuments = $this->ModelDocument->find('all',$conditions);
		*/

		$conditions = array(
							'order' =>  array('model_division_id' => 'asc','model_position_id' => 'asc','corp_id' => 'asc','rank_id' => 'asc'),
							'conditions' => $whereConditions,
							'fields' => array('id','model_id','model_division_id','model_position_id','rate_full','rate_decrease_1','rate_decrease_2','rate_decrease_3','rate_structure','comment','weapon_id','rank_id','corp_id','mos')
						   );
		$ModelProperties = $this->ModelProperty->find('all',$conditions);

		$conditions = array(
							'order' =>  array('model_division_id' => 'asc','id' => 'asc'),
							'conditions' => $whereConditions,
							'fields' => array('id','model_id','model_division_id','equipment_id','rate_full','rate_decrease_1','rate_decrease_2','rate_decrease_3','rate_structure','comment')
						   );
		$ModelEquipments = $this->ModelEquipment->find('all',$conditions);

		$model_id = $this->Generator->getID();
		pr($model_id); 

		$data = array();
		$data = $ModelRates;
		$data['ModelRate']['id'] = $model_id;
		$data['ModelRate']['name'] .= ' ( สำเนา)';

		$this->ModelRate->create();
		$this->ModelRate->save($data);
		
		$data = array();
		foreach($ModelProperties as $ModelProperty) {

			$data = $ModelProperty;
			$data['ModelProperty']['id'] = $this->Generator->getID();
			$data['ModelProperty']['model_id'] = $model_id;

			$this->ModelProperty->create();
			$this->ModelProperty->save($data);
		}
		
		$data = array();
		foreach($ModelEquipments as $ModelEquipment) {

			$data = $ModelEquipment;
			$data['ModelEquipment']['id'] = $this->Generator->getID();
			$data['ModelEquipment']['model_id'] = $model_id;

			$this->ModelEquipment->create();
			$this->ModelEquipment->save($data);		
		}
		
	}

	public function printModelRate() {

		$this->layout = 'blank';

	}

	public function printPdf() {

		$this->layout = 'blank';

	}
}
?>