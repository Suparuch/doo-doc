<?php
App::uses('AppController', 'Controller');

class ModelEquipmentsController extends AppController {

	public $name = 'ModelEquipments';
	public $uses = array('ModelEquipment','Equipment','ModelDivision','Division');
	public $components = array("DataMap");

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

	public function saveModelEquipment(){

		$this->layout = 'blank';
		$this->autoRender = false;
		$data = $this->request->data;
		//pr($data);
		//die;

		$ModelDivisions = $data['ModelEquipments'];

		$data = array();
		if(!empty($ModelDivisions)){

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','code','name','tech_id'),'cache' => 'longNameAll', 'cacheConfig' => 'long');
			$Equipments = $this->Equipment->find('all',$conditions);
			$Equipments = $this->DataMap->convertArray('Equipment','name',$Equipments);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Divisions = $this->Division->find('list',$conditions);

			foreach($ModelDivisions as $key => $ModelDivision) {

				if(!empty($ModelDivision['ModelEquipment'])){

					$data = $ModelDivision['ModelDivision'];
					if(!empty($data['name'])){
						if(!empty($Divisions[$data['name']])) $data['division_id'] = $Divisions[$data['name']];
						else $data['division_id'] = $this->DataMap->setData('Division',$data['name']);

						$this->ModelDivision->save($data);
					}
					$ModelEquipments = $ModelDivision['ModelEquipment'];
					foreach($ModelEquipments as $key => $ModelEquipment) {

						$data = $ModelEquipment;
						if(!empty($data['equipment_name'])){
							if(!empty($Equipments[$data['equipment_name']])) {
								$data['equipment_id'] = $Equipments[$data['equipment_name']]['id'];
								$data['equipment_code'] = $Equipments[$data['equipment_name']]['code'];
								$data['tech_id'] = $Equipments[$data['equipment_name']]['tech_id'];
							}
							else $data['equipment_id'] = $this->DataMap->setData('Equipment',$data['equipment_name']);
						}
						$this->ModelEquipment->save($data);
					
					}
				}

			}
			$alert_message = 'บันทึกข้อมูลเรียบร้อย';
			echo $alert_message;
		}

	}


}
?>