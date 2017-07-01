<?php
App::uses('AppController', 'Controller');

class EmployeeRatesController extends AppController {

	public $name = 'EmployeeRates';
	public $uses = array('EmployeeOrganization','EmployeeRate','PositionGroup');
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
									'conditions' => $whereConditions
								   );
				$total = $this->EmployeeOrganization->find('count',$conditions);
				$EmployeeOrganizations = $this->EmployeeOrganization->find('all',$conditions); 
	  
								 
			}else{
				
				$default = array();
				$default = $dataRequest;
				$this->set('default',$default);

				//intitial
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				
				$offset = $dataRequest['offset'];
				
				$organization_code = $dataRequest['organization_code'];
				$organization_name = $dataRequest['organization_name'];
				

				if(!empty($organization_code)) $whereConditions[] = 'organization_code ILIKE \'%'.$organization_code.'%\'';
				if(!empty($organization_name)) $whereConditions[] = 'organization_name ILIKE \'%'.$organization_name.'%\'';
				
				$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
									'conditions' => $whereConditions
								   ); 
				$total = $this->EmployeeOrganization->find('count', array('conditions' => $whereConditions ));
				$EmployeeOrganizations = $this->EmployeeOrganization->find('all',$conditions); 
									 
			}              

			$breadcrumb = array (   'controller' => array(   
									'name' => 'ข้อมูล อัตราพนักงานราชการ' ,
									'url' => ''
									)
			);
			$this->set('breadcrumb',$breadcrumb);  
			$this->set('EmployeeOrganizations',$EmployeeOrganizations);  
			$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'EmployeeOrganization','pages' => 5);
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
                    $EmployeeOrganizations = $this->EmployeeOrganization->find('all',$conditions);  
                    
                    foreach($EmployeeOrganizations[0]['EmployeeOrganization'] as $key => $value)
                        $default[$key] = $value;
                    
                    $this->set('default',$default);
                
            }	

	}       

	public function formRate($id = null) {
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
                    $EmployeeOrganizations = $this->EmployeeOrganization->find('all',$conditions);  
                    
                    foreach($EmployeeOrganizations[0]['EmployeeOrganization'] as $key => $value)
                        $default[$key] = $value;
                    
                    $this->set('default',$default);

                    $whereConditions = array();
                    $whereCOnditions['deleted'] = 'N';
                    //$whereConditions['employee_organization_id'] = $id;
                    $conditions = array('conditions' => $whereConditions);
                    $EmployeeRates = $this->EmployeeRate->find('all',$conditions);

					$this->set('EmployeeRates',$EmployeeRates);

					//$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
					//$PositionGroups = $this->PositionGroup->find('list',$conditions);

					//$this->set('PositionGroups',$PositionGroups);
                
            }	

	}       
        
	public function save($id=null) {
            $this->autoRender = false;
             
            $data = $this->request->data;    
            
			if(!empty($data)){    
				
				if(!empty($id)){
					
					$this->EmployeeOrganization->id = $id;
					if($this->EmployeeOrganization->exists())
					$status = $this->EmployeeOrganization->save($data) ? 'SUCCESS' : 'FAILED'; 
					else $status = 'FAILED';    
					
				}else{

					$data['id'] = $this->Generator->getID(); 
					$this->EmployeeOrganization->create();
					$status = $this->EmployeeOrganization->save($data) ? 'SUCCESS' : 'FAILED';
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
					$this->EmployeeOrganization->id = $id;
					if($this->EmployeeOrganization->exists())
					$status = $this->EmployeeOrganization->save($data) ? 'SUCCESS' : 'FAILED'; 
					else $status = 'FAILED';    

				}else $status =  'FAILED';                                      
			   
			}                    
			
			echo json_encode(array('status' => $status));
	} 
        
}
?>