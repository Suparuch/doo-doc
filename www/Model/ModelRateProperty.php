<?php
App::uses('AppModel', 'Model');

class ModelRateProperty extends AppModel {

	public $useTable = "models";

    public $hasMany =array(
            "ModelDivision"=>array(
                "className"=>"ModelDivision",
                "foreignKey"=>"model_id",
                "order" => "ModelDivision.order_sort ASC",
				'conditions' => array('deleted'=>'N'),
            )
	);
	

}
?>