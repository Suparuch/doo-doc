<?php

App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class InterfaceAPIController extends AppController {

	public $name = 'Interface';
	public $uses = array('Model','ModelDivision','ModelDivisionSpecial');

	public function index() {
		$this->layout = 'blank';
		$this->autoRender = false;
		echo 'HI!!';
	}

	function interfaceData() {
		
		$this->layout = 'blank';
		//$this->autoRender = false;

		$result = array();
		$user = array();
		$bError = false;
		$sErrorCode = '';
		$sErrorMessage = '';
		
		$datas = array();
		$data['models'] = array(
								'models'=>array('model'),
								'users'=>array('user 1','user 2'),
								'equipments'=>array('equipment 1','equipment 2')
		);
		$data['organizations'] = array(
								'organizations'=>array('organization 1','organization 2'),
		);

		$datas['dlogs'] = array($data);
		$datas['dop'] = array($data);
		pr($datas);
		die;

		if (!$this->request->isPost()) {
			$bError = true;
			$sErrorCode = 'AUTHBASE0001';
			$sErrorMessage = 'POST only API';
		}

		if (!$bError) {
						
			if (empty($this->request->data['interface_code'])) {				
					$bError = true;
					$sErrorCode = 'AUTHBASE0002';
					$sErrorMessage = 'Invalid input parameter';
			}else{
				if(Configure::read('Config.InterfaceCode') != $this->request->data['interface_code']){
					$bError = true;
					$sErrorCode = 'AUTHBASE0002';
					$sErrorMessage = 'Invalid input parameter';
				}				
			}
		}

		if (!$bError) {
			//pr($this->request->data);
			//$interface_code = $this->request->data["interface_code"];
			$interface_data = $this->request->data["interface_data"];
			
			if (count($interface_data)>0) {

				foreach($interface_data as $key => $data){
					
					//pr($key);
					//pr($data);
					//die;
					$current_date = date('Y-m-d');
					$file_handle = fopen('files/json/'.$key.'-'.$current_date.'.json', "w");
					$file_contents =  json_encode($data,JSON_NUMERIC_CHECK);

					fwrite($file_handle, $file_contents);
					fclose($file_handle);
					//print "file created and written to";
				
				}


			} else {
				$bError = true;
				$sErrorCode = 'AUTHBASE0003';
				$sErrorMessage = 'No Data';
			}
		}
		
		$Interface = array('ok');
		$result = array();
		if ($bError) {
			$result['Result']['Error']['ErrorCode'] = $sErrorCode;
			$result['Result']['Error']['ErrorMessage'] = $sErrorMessage;
		} else {
			$result['Result']['Interface'] = $Interface;
		}

		$this->set('result', $result);
		$this->render('/jsons/get_result');
		
	}


	function interfaceModel($model_code = null,$model_date = null) {
		$this->layout = 'blank';
		//$this->autoRender = false;
		
		//pr($model_code);
		//pr($model_date);

		$conditions = array('conditions' => array('code' => $model_code,'model_date' => $model_date));
		$Models = $this->Model->find('first',$conditions);
		if(empty($Models)) die;
		$model_id = $Models['Model']['id'];
		$model_type_id = $Models['Model']['model_type_id'];

		$result = array();
		$conditions = array();
		$conditions = array('conditions' => array('model_id' => $model_id),'recursive'=>4);
		$ModelName = '';
		if($model_type_id == 1){
			$ModelName = 'ModelDivision';
		}else if($model_type_id == 2){
			$ModelName = 'ModelDivisionSpecial';
		}

		$result = $this->$ModelName->find('all',$conditions);
		//pr($result);
		//die;

		$this->set('result', $result);
		$this->render('/Jsons/get_result');
		
	}

}
