<?php
App::uses('AppController', 'Controller');

class ReportsController extends AppController {

	public $name = 'Reports';
	public $uses = array('ModelRate','ModelProperty','ModelType','ModelStatus','ModelPosition','Organization','OrganizationModel','OrganizationScience','Corp','Rank');
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

	public function byModel() {

		set_time_limit(0);
		ini_set('memory_limit','3000M');

		//$this->layout = 'blank';
		//$this->autoRender = false;
		$dataRequest = $this->request->data;
	
		if(empty($dataRequest)){

			$setIndex = false;
			$offset = 0;
			//$whereConditions = array();
			//$whereConditions['deleted'] = 'N';            
			//$conditions = array('limit' =>  '20',
			//					'order' =>  array('order_sort' => 'asc'),
			//					'conditions' => $whereConditions
			//				   );
			//$ModelRates = $this->ModelRate->find('all',$conditions);
			//$total = $this->ModelRate->find('count',$conditions);
			$ModelRates = array();
			$total = 0;

		}else{
			
			$setIndex = true;
			$offset = $dataRequest['offset'];
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);
			
			//-------------------------------------------------------------------------------------------------------------------------
			$code = $dataRequest['code'];
			$name = $dataRequest['name'];
			$organization_id = $dataRequest['organization_id'];
			$organization_science_id = $dataRequest['organization_science_id'];
			$model_position_id = $dataRequest['model_position_id'];
			$model_status_id = $dataRequest['model_status_id'];
			$mos = $dataRequest['mos'];
			$corp_id = $dataRequest['corp_id'];
			$rank_id = $dataRequest['rank_id'];

			//$organization_id = 172;
			//$rank_id = 8;

			//-------------------------------------------------------------------------------------------------------------------------
			$OrganizationModels = array();
			if(!empty($organization_id)){
				$whereConditions = array();
				$whereCOnditions['deleted'] = 'N';
				$whereConditions[] = "organization_id = '".$organization_id."'";
				$conditions = array(
									'conditions' => $whereConditions,
									'fields' => array('model_id')
								   );
				$OrganizationModels = $this->OrganizationModel->find('list',$conditions);
			}
			//pr($OrganizationModels);

			//-------------------------------------------------------------------------------------------------------------------------
			$ModelProperties = array();
			if(!empty($model_position_id) || !empty($mos) || !empty($corp_id) || !empty($rank_id)){
				$whereConditions = array();
				$whereCOnditions['deleted'] = 'N';
				if(!empty($model_position_id)) $whereConditions[] = "model_position_id = '".$model_position_id."'";
				if(!empty($mos)) $whereConditions[] = "mos = '".$mos."'";
				if(!empty($corp_id)) $whereConditions[] = "corp_id = '".$corp_id."'";
				if(!empty($rank_id)) $whereConditions[] = "rank_id = '".$rank_id."'";
				$conditions = array(
									'conditions' => $whereConditions,
									'fields' => array('model_id')
								   );
				$ModelProperties = $this->ModelProperty->find('list',$conditions);
			}
			//pr($ModelProperties);
			//-------------------------------------------------------------------------------------------------------------------------
			
			$arr_list_model = array_intersect($OrganizationModels, $ModelProperties);
			$list_model = implode(",", $arr_list_model);
			//pr($list_model);

			//-------------------------------------------------------------------------------------------------------------------------
			$whereConditions = array();
			$whereCOnditions['deleted'] = 'N';
			if(!empty($code)) $whereConditions[] = 'code ILIKE \'%'.$code.'%\'';
			if(!empty($name)) $whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
			if(!empty($organization_science_id)) $whereConditions[] = "organization_science_id = '".$organization_science_id."'";
			if(!empty($model_status_id)) $whereConditions[] = "model_status_id = '".$model_status_id."'";
			if(!empty($list_model)) $whereConditions[] = "id in ('".$list_model."')";
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$ModelRates = $this->ModelRate->find('all',$conditions); 
			$total = $this->ModelRate->find('count', array('conditions' => $whereConditions ));		
			//pr($ModelRates);
			//die();
			
			//-------------------------------------------------------------------------------------------------------------------------

		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'อัตราการจัด ตามแบบ' ,
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
							'name_th' => 'อัตราการจัด ตามแบบ' 
		);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$ModelPositions = array();
		//$ModelPositions = $this->ModelPosition->find('list',$conditions);
		$ModelTypes = $this->ModelType->find('list',$conditions);
		$ModelStatuss = $this->ModelStatus->find('list',$conditions);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Organizations = $this->Organization->find('list',$conditions);
		$OrganizationSciences = $this->OrganizationScience->find('list',$conditions);
		$Corps = $this->Corp->find('list',$conditions);
		$Ranks = $this->Rank->find('list',$conditions);

		$this->set('actions',$actions);
		$this->set('setIndex',$setIndex);

		$this->set('ModelRates',$ModelRates);
		$this->set('ModelPositions',$ModelPositions);
		$this->set('ModelTypes',$ModelTypes);
		$this->set('ModelStatuss',$ModelStatuss);

		$this->set('Organizations',$Organizations);
		$this->set('OrganizationSciences',$OrganizationSciences);
		$this->set('Corps',$Corps);
		$this->set('Ranks',$Ranks);	
		
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'ModelRate','pages' => 5);
		$this->set('pagination',$pagination);
	}

	public function byOrganization() {

		set_time_limit(0);
		ini_set('memory_limit','3000M');

		//$this->layout = 'blank';
		//$this->autoRender = false;
		$dataRequest = $this->request->data;
		$whereConditions= array();
		if(empty($dataRequest)){

			$setIndex = false;
			$offset = 0;
			//$whereConditions = array();
			//if(!empty($model_type_id))
			//$whereConditions[] = "model_type_id = '".$model_type_id."'";
			//$whereConditions['deleted'] = 'N';            
			//$conditions = array('limit' =>  '20',
			//					'order' =>  array('order_sort' => 'asc'),
			//					'conditions' => $whereConditions
			//				   );
			//$ModelRates = $this->ModelRate->find('all',$conditions);
			//$total = $this->ModelRate->find('count',$conditions);
			$ModelRates = array();
			$total = 0;

		}else{
			
			$setIndex = true;
			$offset = $dataRequest['offset'];
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);

			//-------------------------------------------------------------------------------------------------------------------------
			$code = $dataRequest['code'];
			$name= $dataRequest['codename'];	
			$corp = $dataRequest['corp'];
			//-------------------------------------------------------------------------------------------------------------------------
			
			if(!empty($name))
				$whereConditions[] = "name ILIKE '%$name%'";
			if(!empty($code ))
				$whereConditions[] = "code ILIKE '%$code%'";
			if(!empty($corp ))
				$whereConditions[] = "code ILIKE '%$corp %'";
//data[corp_id]
			$whereCondition = "";
			if(count($whereConditions>0))
				$whereCondition = implode(" AND ",$whereConditions);	

			$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereCondition 
							   ); 
			//$total = $this->OrganizationClass->find('count', array('conditions' => $whereConditions ));

			$total = $this->Organization->find('count', array('conditions' => $whereCondition ));
			//$OrganizationClasss = $this->OrganizationClass->find('all',$conditions);              

			$OrganizationClasss = $this->Organization->find('all',$conditions);          
$ModelRates = $this->ModelRate->find('all',$conditions);    
		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'อัตราการจัด ตามหน่วยงาน' ,
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
							'name_th' => 'อัตราการจัด ตามหน่วยงาน' 
		);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$ModelTypes = $this->ModelType->find('list',$conditions);
		$ModelStatus = $this->ModelStatus->find('list',$conditions);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Corps = $this->Corp->find('list',$conditions);
		$Ranks = $this->Rank->find('list',$conditions);

		$this->set('actions',$actions); 
		$this->set('setIndex',$setIndex);

		$this->set('ModelRates',$ModelRates);
		$this->set('ModelStatus',$ModelStatus);

		$this->set('Corps',$Corps);
		$this->set('Ranks',$Ranks);	

		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'ModelRate','pages' => 5);
		$this->set('pagination',$pagination);
	}

	public function compareModel() {
	
	}

	public function compareOrganizations() {
	
	}
	
	public function byScience() {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$dataRequest = $this->request->data;
		
		if(!empty($dataRequest['model_type_id']))
		$model_type_id = $dataRequest['model_type_id'];
	
		if(empty($dataRequest)){
			$offset = 0;
			$whereConditions = array();
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
			$default = $dataRequest;
			$this->set('default',$default);                      
			//intitial
			$whereConditions = array();
			$whereCOnditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$code = $dataRequest['code'];

			if(!empty($model_type_id))
			$whereConditions[] = "model_type_id = '".$model_type_id."'";

			if(!empty($code))
			$whereConditions[] = 'code ILIKE \'%'.$code.'%\'';
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$ModelRates = $this->ModelRate->find('all',$conditions); 
			$total = $this->ModelRate->find('count', array('conditions' => $whereConditions ));              
		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'อจย/อฉก ตาม สายวิทยาการ' ,
								'url' => ''
								)
		);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$ModelTypes = $this->ModelType->find('list',$conditions);
		$ModelStatus = $this->ModelStatus->find('list',$conditions);

		$this->set('breadcrumb',$breadcrumb);
		
		$actions = array(   'is_used' => true,
							'action' => array( 'add' => true,
											   'edit' => true,
											   'delete' => true,
											   'lock' => true,
											   'copy' => true

							),
							'name_th' => 'อจย/อฉก ตาม สายวิทยาการ' 
		);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Corps = $this->Corp->find('list',$conditions);
		$Ranks = $this->Rank->find('list',$conditions);

		$this->set('actions',$actions); 

		$this->set('Corps',$Corps);
		$this->set('Ranks',$Ranks);	
		$this->set('ModelRates',$ModelRates);
		$this->set('ModelStatus',$ModelStatus);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'ModelRate','pages' => 5);
		$this->set('pagination',$pagination);
	}
	
	public function compareModel_() {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$dataRequest = $this->request->data;
		
		if(!empty($dataRequest['model_type_id']))
		$model_type_id = $dataRequest['model_type_id'];
	
		if(empty($dataRequest)){
			$offset = 0;
			$whereConditions = array();
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
			$default = $dataRequest;
			$this->set('default',$default);                      
			//intitial
			$whereConditions = array();
			$whereCOnditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$code = $dataRequest['code'];

			if(!empty($model_type_id))
			$whereConditions[] = "model_type_id = '".$model_type_id."'";

			if(!empty($code))
			$whereConditions[] = 'code ILIKE \'%'.$code.'%\'';
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$ModelRates = $this->ModelRate->find('all',$conditions); 
			$total = $this->ModelRate->find('count', array('conditions' => $whereConditions ));              
		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'เปรียบเทียบ อจย/อฉก' ,
								'url' => ''
								)
		);

		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$ModelTypes = $this->ModelType->find('list',$conditions);
		$ModelStatus = $this->ModelStatus->find('list',$conditions);

		$this->set('breadcrumb',$breadcrumb);
		
		$actions = array(   'is_used' => true,
							'action' => array( 'add' => true,
											   'edit' => true,
											   'delete' => true,
											   'lock' => true,
											   'copy' => true
							),
							'name_th' => 'เปรียบเทียบ อจย/อฉก'
		);
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Corps = $this->Corp->find('list',$conditions);
		$Ranks = $this->Rank->find('list',$conditions);

		$this->set('actions',$actions); 

		$this->set('Corps',$Corps);
		$this->set('Ranks',$Ranks);	
		
		$this->set('ModelRates',$ModelRates);
		$this->set('ModelStatus',$ModelStatus);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'ModelRate','pages' => 5);
		$this->set('pagination',$pagination);

	}

}
?>