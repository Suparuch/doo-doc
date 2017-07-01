<?php
App::uses('AppController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

class InterfaceController extends AppController {

	public $name = 'Interface';
	//public $uses = array('AuthBase','AuditToken');
	public $bError = false;

	public function index() {
		$this->layout = 'blank';
		$this->autoRender = false;
		echo 'HI!!';
	}

	function interfaceData(){

		$this->layout = 'blank';
		$this->autoRender = false;
		

		$datas = array();
		$datas['models'] = array('ok1');
		$datas['organizations'] = array('ok2');

		$dataInterface["interface_code"] = Configure::read('Config.InterfaceCode');
		$dataInterface["interface_data"] = $datas;
		//pr($dataInterface);

		$socket = new HttpSocket();
		//pr(Configure::read('Config.InterfaceAPI.EndPoint') . 'interfaceData/.json');
		$InterfaceResult = $socket->post(Configure::read('Config.InterfaceAPI.EndPoint') . 'interfaceData/.json', $dataInterface);
		//pr($InterfaceResult);
		$interfaceData = json_decode($InterfaceResult, true);
		
		//pr($interfaceData);

	}

}
