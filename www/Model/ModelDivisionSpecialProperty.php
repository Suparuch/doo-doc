<?php
App::uses('AppModel', 'Model');

class ModelDivisionSpecialProperty extends AppModel {

	public $useTable = "model_divisions";

    public $hasMany =array(
            "ModelSubDivision"=>array(
                "className"=>"ModelSubDivision",
                "foreignKey"=>"model_division_id",
				"order" => "ModelSubDivision.order_sort ASC",
				'conditions' => array('deleted'=>'N')
            ),
	);
}
?>