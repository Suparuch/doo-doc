<?php

App::uses('Component', 'Controller');

class TrackerComponent extends Component {

	public $uses = array('Tracker');

	public function __construct() {
		foreach($this->uses as $model) {
			$this->$model = ClassRegistry::init($model);
		}
	}

    public function setTracker($user_id=null,$module_name=null,$action=null,$request_pass=null,$request_data=null,$ip=null){

		  $tracker = array();

		  $tracker['id'] = $this->getID();
		  $tracker['user_id'] = $user_id;
		  $tracker['module_name'] = strtolower($module_name);
		  $tracker['action'] = strtolower($action);
		  $tracker['request_pass'] = $request_pass;
		  $tracker['request_data'] = $request_data;
		  $tracker['ip'] = $ip;
			
		  $this->Tracker->save($tracker);

    }

	public function getID(){
        $parts = explode(' ',microtime());
        $micro = $parts[0] * 1000000;
        
        return(substr(date('YmdHis'),2).sprintf("%06d",$micro));
    }
	
}
?>
