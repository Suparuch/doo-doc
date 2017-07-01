<?php
Configure::write('debug', 2) ;
App::uses('AppController', 'Controller');

class ModelGroupsController extends AppController {

	public $name = 'ModelGroups';
	public $uses = array('ModelGroup','ModelRate');
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
           
	}

	public function saveModelGroup(){

		$this->layout = 'blank';
		$this->autoRender = false;
		$data = $this->request->data;

		$ModelGroups = $data['ModelGroup'];
		
		$data = array();
		if(!empty($ModelGroups)){

			foreach($ModelGroups as $key => $ModelGroup) {

				$data = $ModelGroup;
				
				$model_id = $data['model_id'];
				//$model_id = 1005;
				
				$whereConditions = array();
				$whereConditions['id'] =  $model_id;
				$whereConditions['deleted'] = 'N';
		
				$conditions = array(
					'conditions' => $whereConditions,
					'fields' => array('code','name')
				);
				$ModelRates = $this->ModelRate->find('first', $conditions);
				if($ModelRates!=null){
			
					$data['code'] = $ModelRates['ModelRate']['code'];
					$data['name'] = $ModelRates['ModelRate']['name'];
				}
				print_r($data);
				echo "<hr />";
				
				$dbo = $this->ModelGroup->getDatasource();
			$oldStateFullDebug = $dbo->fullDebug;
			$dbo->fullDebug = true;
			$data['quantity_decrease1'] = 1;
            $this->ModelGroup->save($data);
			$logs = $dbo->getLog();
			$lastLog = end($logs['log']);
			CakeLog::write("DBLog", $lastLog['query']);
			$dbo->fullDebug = $oldStateFullDebug;
			print_r($lastLog);
			}
			$alert_message = 'บันทึกข้อมูลเรียบร้อย';
			echo $alert_message;
		}


	}


}
?>