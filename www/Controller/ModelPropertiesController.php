<?php
App::uses('AppController', 'Controller');

class ModelPropertiesController extends AppController {

	public $name = 'ModelProperties';
	public $uses = array('ModelDivision','ModelSubDivision','ModelPosition','ModelProperty','Division','SubDivision','Position','Weapon');
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

	public function saveModelProperty(){

		$this->layout = 'blank';
		$this->autoRender = false;
		$data = $this->request->data;

		$ModelDivisions = $data['ModelProperties'];
		$data = array();
		if(!empty($ModelDivisions)){

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Divisions = $this->Division->find('list',$conditions);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Positions = $this->Position->find('list',$conditions);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Weapons = $this->Weapon->find('list',$conditions);

			foreach($ModelDivisions as $key => $ModelDivision) {
				
				$data = $ModelDivision['ModelDivision'];
				if(!empty($data['name'])){
					if(!empty($Divisions[$data['name']])) $data['division_id'] = $Divisions[$data['name']];
					else $data['division_id'] = $this->DataMap->setData('Division',$data['name']);
				}
				$this->ModelDivision->save($data);

				if(!empty($ModelDivision['ModelPosition'])){
					$ModelPositions = $ModelDivision['ModelPosition'];
					foreach($ModelPositions as $key => $ModelPosition) {

						$data = $ModelPosition;
						if(!empty($data['name'])){
							if(!empty($Positions[$data['name']])) $data['position_id'] = $Positions[$data['name']];
							else $data['position_id'] = $this->DataMap->setData('Position',$data['name']);
						}
						unset($data['ModelProperty']);
						$this->ModelPosition->save($data);
						
						if(!empty($ModelPosition['ModelProperty'])){
							$ModelProperties = $ModelPosition['ModelProperty'];
							foreach($ModelProperties as $key => $ModelProperty) {

								$data = $ModelProperty;
								if(!empty($data['weapon_name'])){
									if(!empty($Weapons[$data['weapon_name']])) $data['weapon_id'] = $Weapons[$data['weapon_name']];
									else $data['weapon_id'] = $this->DataMap->setData('Weapon',$data['weapon_name']);
								}
								$this->ModelProperty->save($data);
							}
						}

					}
				}

			}

			$alert_message = 'บันทึกข้อมูลเรียบร้อย';
			echo $alert_message;

		}
		
		

	}

	public function saveModelSpecialProperty(){

		$this->layout = 'blank';
		$this->autoRender = false;
		$data = $this->request->data;


		$ModelDivisions = $data['ModelProperties'];
		$data = array();
		if(!empty($ModelDivisions)){

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Divisions = $this->Division->find('list',$conditions);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$SubDivisions = $this->SubDivision->find('list',$conditions);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Positions = $this->Position->find('list',$conditions);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('name','id'),'cache' => 'longNameList', 'cacheConfig' => 'long');
			$Weapons = $this->Weapon->find('list',$conditions);
		//	print_r($ModelDivisions);
			foreach($ModelDivisions as $key => $ModelDivision) {
				
				$data = $ModelDivision['ModelDivision'];
				if(!empty($data['name'])){
					if(!empty($Divisions[$data['name']])) $data['division_id'] = $Divisions[$data['name']];
					else $data['division_id'] = $this->DataMap->setData('Division',$data['name']);
				}
				$this->ModelDivision->save($data);

				if(!empty($ModelDivision['ModelSubDivision'])){
					$ModelSubDivisions = $ModelDivision['ModelSubDivision'];

					foreach($ModelSubDivisions as $key => $ModelSubDivision) {

						$data = $ModelSubDivision;
						
						if(!empty($data['name'])){
							if(!empty($SubDivisions[$data['name']])) $data['subdivision_id'] = $SubDivisions[$data['name']];
							else $data['subdivision_id'] = $this->DataMap->setData('SubDivision',$data['name']);
						}
						unset($data['ModelPosition']);
						
						$this->ModelSubDivision->save($data);

						if(!empty($ModelSubDivision['ModelPosition'])){
							$ModelPositions = $ModelSubDivision['ModelPosition'];

							foreach($ModelPositions as $key => $ModelPosition) {

								$data = $ModelPosition;
								if(!empty($data['name'])){
									if(!empty($Positions[$data['name']])) $data['position_id'] = $Positions[$data['name']];
									else $data['position_id'] = $this->DataMap->setData('Position',$data['name']);
								}
								unset($data['ModelProperty']);
								$this->ModelPosition->save($data);
								
								if(!empty($ModelPosition['ModelProperty'])){
									$ModelProperties = $ModelPosition['ModelProperty'];
									foreach($ModelProperties as $key => $ModelProperty) {
										$data = $ModelProperty;
										$this->ModelProperty->save($data);
									}
								}

							}
						}

					}
				}

			}

			$alert_message = 'บันทึกข้อมูลเรียบร้อย';
			echo $alert_message;

		}

	}

}
?>