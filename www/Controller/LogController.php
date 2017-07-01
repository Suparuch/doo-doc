<?php
App::uses('AppController', 'Controller');
error_reporting(0);
class LogController extends AppController {

	public $name = 'Log';
	public $uses = array('Log','Month','User');
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
				$whereConditions['Log.deleted'] = 'N';            
				$conditions = array('limit' =>   $this->Generator->setLimit(),
									'order' =>  array('Log.id' => 'desc'),
									'conditions' => $whereConditions
								   );
				$total = $this->Log->find('count',$conditions);
				$log = $this->Log->find('all',$conditions); 
	  
								 
			}else{
				
				$default = array();
				$default = $dataRequest;
				$this->set('default',$default);                    
				//intitial
				$whereConditions = array();
				$whereConditions['Log.deleted'] = 'N';
				
				$offset = $dataRequest['offset'];
				
				$name = $dataRequest['name'];

				if(!empty($name))
					$whereConditions[] = '(module_name ILIKE \'%'.$name.'%\' or action ILIKE \'%'.$name.'%\' or ip ILIKE \'%'.$name.'%\')';
				
				if(isset($_POST['data']['start_date']) )
				{
					
					$start_date = $_POST['data']['start_date'];
					$start_date['year'] = ($start_date['year']==""?"1000":$start_date['year']);
					$start_date['month'] = ($start_date['month']==""?"01":$start_date['month']);
					$start_date['day'] = ($start_date['day']==""?"01":$start_date['day']);
					$d = sprintf("%1$04d-%2$02d-%3$02d",$start_date['year'],$start_date['month'] , $start_date['day']);
				
					$whereConditions[] = '(Log.created >=\'' . $d . '\' )';
//					$whereConditions[] = '(module_name ILIKE \'%'.$name.'%\' or action ILIKE \'%'.$name.'%\' or ip ILIKE \'%'.$name.'%\')';
				}
				if(isset($_POST['data']['end_date']) )
				{
					$end_date = $_POST['data']['end_date'];
						$end_date['year'] = ($end_date['year']==""?"3000":$end_date['year']);
					$end_date['month'] = ($end_date['month']==""?"12":$end_date['month']);
					$end_date['day'] = ($end_date['day']==""?"29":$end_date['day']);
					$d = sprintf("%1$04d-%2$02d-%3$02d",$end_date['year'],$end_date['month'] , $end_date['day']);
				
					$whereConditions[] = '(Log.created <=\'' . $d . '\' )';
				
					//$whereConditions[] = '(module_name ILIKE \'%'.$name.'%\' or action ILIKE \'%'.$name.'%\' or ip ILIKE \'%'.$name.'%\')';
				}
				$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
									'order' =>  array('Log.id' => 'desc'),
									'fields' => array('*'),
									'conditions' => $whereConditions,
									'joins' => array(
									array(
										'table' => 'users',
										'alias' => 'user',
										'type' => 'inner',
										'foreignKey' => false,
										'conditions'=> array('Log.user_id = user.id')
									))
									
								   ); 
				$total = $this->Log->find('count', array('conditions' => $whereConditions ));
				$this->Log->contain(array(
					'User',
				));
				$log = $this->Log->find('all',$conditions); 

				
				
			}              
			
			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longIdList', 'cacheConfig' => 'long');
			$Months = $this->Month->find('list',$conditions);
		
			$start_year = 1950;
			$current_year = date("Y");
			for($year = $start_year;$year<=$current_year;$year++){
				$Years[$year] = $year + 543;		
			}




			$breadcrumb = array (   'controller' => array(   
									'name' => 'Action Log' ,
									'url' => ''
									)
			);
			$this->set('breadcrumb',$breadcrumb);  
			$this->set('log',$log);  
			$this->set('Months',$Months);
			$this->set('Years',$Years);
			$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Log','pages' => 5);
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