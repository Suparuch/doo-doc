<?php
App::uses('AppController', 'Controller');

class SynchronizeBaseAPIController extends AppController {
	
	public $uses = array();

	function index($category='') {
		
		$this->layout = 'blank';
		$this->autoRender = false;
	
	}

}
?>
