<?php
App::uses('AppController', 'Controller');

class ZonesController extends AppController {

	public $name = 'Zones';
	public $uses = array('Zone','Province');
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
				$total = $this->Zone->find('count',$conditions);
				$zones = $this->Zone->find('all',$conditions); 
	  
								 
			}else{
				
				$default = array();
				$default = $dataRequest;
				$this->set('default',$default);                    
				//intitial
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				
				$offset = $dataRequest['offset'];
				
				$name = $dataRequest['name'];
				$province_id = $dataRequest['province_id'];

				if(!empty($name))
				$whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
				if(!empty($province_id))
				$whereConditions['province_id'] = $province_id;
				
				$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
									'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   ); 
				$total = $this->Zone->find('count', array('conditions' => $whereConditions ));
				$zones = $this->Zone->find('all',$conditions); 

				
				
			}              

			$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('name'),'order' =>  array('order_sort' => 'asc'),); 
			$provinces = $this->Province->find('list',$conditions); 
			$this->set('provinces',$provinces); 


			$breadcrumb = array (   'controller' => array(   
									'name' => 'ข้อมูลอำเภอ' ,
									'url' => ''
									)
			);
			$this->set('breadcrumb',$breadcrumb);  
			$this->set('zones',$zones);  
			$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Zone','pages' => 5);
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
                    $zones = $this->Zone->find('all',$conditions);  
                    
                    foreach($zones[0]['Zone'] as $key => $value)
                        $default[$key] = $value;
                    
                    $this->set('default',$default);          
                    
            }
			$conditions = array('conditions' => array('deleted' => 'N'),'fields' => array('name'),
							   ); 
			$provinces = $this->Province->find('list',$conditions); 
			$this->set('provinces',$provinces);               

	}       
        
	public function save($id=null) {
            $this->autoRender = false;
             
            $data = $this->request->data;    
            
                if(!empty($data)){    
                    
                    if(!empty($id)){
                        
                        $this->Zone->id = $id;
                        if($this->Zone->exists())
                        $status = $this->Zone->save($data) ? 'SUCCESS' : 'FAILED'; 
                        else $status = 'FAILED';    
                        
                    }else{
                            $data['id'] = $this->Generator->getID(); 
                            $this->Zone->create();
                            $status = $this->Zone->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
					$this->Zone->id = $id;
					if($this->Zone->exists())
					$status = $this->Zone->save($data) ? 'SUCCESS' : 'FAILED'; 
					else $status = 'FAILED';    

				}else $status =  'FAILED';   
			   
			}
				  
			echo json_encode(array('status' => $status));
	}

	public function getZone($provinceId = null){
			$this->layout = 'blank';
            $this->autoRender = false;
			$this->disableCache();

			if(!empty($provinceId)){
				
				$condition = array();
				$condition['province_id'] = $provinceId;        
				$condition['deleted'] = 'N';
				$Zones = $this->Zone->find('all', array('conditions' => $condition, 'fields'=>array('id','name'),'order' => array('order_sort' => 'asc')));
				
				$data_array= array();
				foreach ($Zones as $Zone) {
					//pr($Zone);
					$data_array[] ='<option value="'.$Zone['Zone']['id'].'">'.$Zone['Zone']['name'].'</option>';
				}

				print_r($data_array);
			}
	}
        
}
?>