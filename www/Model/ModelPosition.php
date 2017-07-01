<?php
App::uses('AppModel', 'Model');

class ModelPosition extends AppModel {

	public $useTable = "model_positions";

    public $hasMany =array(
            "ModelProperty"=>array(
                "className"=>"ModelProperty",
                "foreignKey"=>"model_position_id",
 "order" => "ModelProperty.order_sort ASC",
				'conditions' => array('deleted'=>'N'),
            )
	);
}
?>