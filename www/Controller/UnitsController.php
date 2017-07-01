<?php
App::uses('AppController', 'Controller');

class UnitsController extends AppController {

	public $name = 'Units';
	public $uses = array('Unit');
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
			$ranks = $this->Unit->find('all',$conditions);
			$total = $this->Unit->find('count',$conditions);
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
			$ranks = $this->Unit->find('all',$conditions); 
			$total = $this->Unit->find('count', array('conditions' => $whereConditions ));              
		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ข้อมูลหน่วยผู้ใช้' ,
								'url' => ''
								)
		);
		$this->set('breadcrumb',$breadcrumb);         
		
		$this->set('ranks',$ranks);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Unit','pages' => 5);
		$this->set('pagination',$pagination);                 
	}
	
	
	public function getData($parent_id = NULL,$organization_type = null) {

        $this->disableCache();
        $this->autoRender = false;

		$condition = array();
        //$condition['parent_id'] = $parent_id;
        $condition['deleted'] = 'N';

		
        $Units = $this->Unit->find('all', array('conditions' => $condition, 'order' => array('order_sort' => 'asc')));

        $i = 0;
		$data_array = array();
        if (!empty($Units)) {			
            foreach ($Units as $Unit) {

				$data_array[$i]['data']['title'] = $Unit['Unit']['short_name'];
				$data_array[$i]['data']['attr']['id'] = $Unit['Unit']['id'];
				//$data_array[$i]['data']['attr']['level'] = $Organization['Organization']['organization_level'];
				$data_array[$i]['data']['attr']['level'] = 1;
				$data_array[$i]['state'] = 'closed';
                $data_array[$i]['attr']['id'] = $Unit['Unit']['id'];
                $data_array[$i]['attr']['parent_id'] = 1;
                //$data_array[$i]['attr']['level'] = $Organization['Organization']['organization_level'];
				$data_array[$i]['attr']['level'] = 1;
				$i++;
            }
        }
        print_r(json_encode($data_array));

    }

public function getDataUnit($parent_id = NULL,$organization_type = null) {

        $this->disableCache();
        $this->autoRender = false;

		$condition = array();
        //$condition['parent_id'] = $parent_id;
        $condition['deleted'] = 'N';
		$condition[] = " short_name like '%" . $_REQUEST['value'] . "%'";
		
        $Units = $this->Unit->find('all', array('conditions' => $condition, 'order' => array('order_sort' => 'asc')));

        $i = 0;
		$data_array = array();
		//$data_array['request'] = $_REQUEST;
        if (!empty($Units)) {			
            foreach ($Units as $Unit) {

				$data_array[$i]['title'] = $Unit['Unit']['short_name'];
				$data_array[$i]['name'] = $Unit['Unit']['short_name'];
				$data_array[$i]['id'] = $Unit['Unit']['id'];
				$data_array[$i]['attr']['id'] = $Unit['Unit']['id'];
				//$data_array[$i]['data']['attr']['level'] = $Organization['Organization']['organization_level'];
				/*$data_array[$i]['data']['attr']['level'] = 1;
				$data_array[$i]['state'] = 'closed';
                $data_array[$i]['attr']['id'] = $Unit['Unit']['id'];
                $data_array[$i]['attr']['parent_id'] = 1;
                //$data_array[$i]['attr']['level'] = $Organization['Organization']['organization_level'];
				$data_array[$i]['attr']['level'] = 1;
				 * 
				 */
				$i++;
            }
        }
       // print_r(json_encode($data_array));
		$return = json_encode($data_array, true);
         echo $return;
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
				$ranks = $this->Unit->find('all',$conditions);  
				
				foreach($ranks[0]['Unit'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}
            
	}       
        
	public function save($id = null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->Unit->id = $id;
				if($this->Unit->exists()){
				
					$status = $this->Unit->save($data) ? 'SUCCESS' : 'FAILED'; 
				}
				else $status = 'FAILED';    
				
			}else{
					$sql = "SELECT order_sort + 1 as new_order_sort  FROM ranks WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
					$results = $this->Unit->query($sql);   
					$data['order_sort'] = $results[0][0]['new_order_sort'];                        
					$data['id'] = $this->Generator->getID(); 
					$this->Unit->create();
					$status = $this->Unit->save($data) ? 'SUCCESS' : 'FAILED';                                      
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
				$this->Unit->id = $id;
				if($this->Unit->exists())
				$status = $this->Unit->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}
}
?>