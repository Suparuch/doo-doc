<?php

App::uses('Component', 'Controller');

class DataMapComponent extends Component {

	public $uses = array('Division','SubDivision','Position','Weapon','Equipment');

	public function __construct() {
		foreach($this->uses as $model) {
			$this->$model = ClassRegistry::init($model);
		}
	}

    public function setData($model=null,$value=null){

		  $data = array();
		  
		  $id = $this->getID();
		  $data['id'] = $id;
		  $data['name'] = trim($value);			
		  $this->$model->save($data);

		  return $id;

    }

	public function getID(){
        $parts = explode(' ',microtime());
        $micro = $parts[0] * 1000000;
        
        return(substr(date('YmdHis'),2).sprintf("%06d",$micro));
    }
	
	Public function convertArray($model=null,$field=null,$datas=null){
	
		$return_data = array();
		foreach($datas as $data){
			$return_data[$data[$model][$field]] = $data[$model];
		}

		return $return_data;


	}
}
?>
