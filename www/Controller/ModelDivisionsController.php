<?php
App::uses('AppController', 'Controller');

class ModelDivisionsController extends AppController {

	public $name = 'ModelDivisions';
	public $uses = array('Rank','ModelStatus');
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
	
		//$total = $this->Rank->find('count',$conditions);
		//$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Rank','pages' => 5);
		//$this->set('pagination',$pagination);

		
		$breadcrumb = array (   'controller' => array(   
								'name' => 'อัตราการจัดและยุทโธปกรณ์' ,
								'url' => ''
								)
		);
		$this->set('breadcrumb',$breadcrumb);  
		
		$actions = array(   'is_used' => true,
							'action' => array(   'add' => true,
												'edit' => true,
												'delete' => true,
												'lock' => true,
												'copy' => true
							),
							'name_th' => 'อัตราการจัดและยุทโธปกรณ์'
		);
		$this->set('actions',$actions); 
	
	}
        
        
	public function form($id = null) {
		$this->layout = 'blank';
		$default = array();
		$model = 'Model';
		
		if(!empty($id)){
			
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				$whereConditions['id'] = $id;
				$conditions = array('limit' =>  '1',
									//'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   );
				$temps = $this->$model->find('all',$conditions);  
				
				foreach($temps[0][$model] as $key => $value)
					$default[$key] = empty($value) ? '' : $value;
				
				
			
		}
		$this->set('default',$default);
		
		//SET MASTER
		
		$masters = array(   
							array(  'model_name' => 'ModelStatus', 
									'first_option' => 'กรุณาเลือกสถานะ'
							)        
		);
		
		foreach($masters as $master){
			$model = $master['model_name'];
			$temps[''] = $master['first_option'];
			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name'),/*'cache' => 'NameList', 'cacheConfig' => 'short'*/); 
			$temps += $this->$model->find('list',$conditions);                
		
			$this->set($model,$temps);
		}
	}            

	public function create() {
	
	}

	public function create3() {
	
	}

	public function create4() {
	
	}

	public function editModel() {
	
	}

	public function detail() {
	
	}

	public function action() {
		$this->layout = 'blank';
	}

	public function detailInfo() {
		$this->layout = 'blank';
	}

	public function lockModel() {
	
	}

	public function copyModel() {
	
	}

	public function printModel() {

		$this->layout = 'blank';

	}

	public function printPdf() {

		$this->layout = 'blank';

	}
}
?>