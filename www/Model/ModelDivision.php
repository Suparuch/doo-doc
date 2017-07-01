<?php
App::uses('AppModel', 'Model');

class ModelDivision extends AppModel {

	public $useTable = "model_divisions";

    public $hasMany =array(
            "ModelPosition"=>array(
                "className"=>"ModelPosition",
                "foreignKey"=>"model_division_id",
                "order" => "ModelPosition.order_sort ASC",
				'conditions' => array('deleted'=>'N')
            ),
            "ModelSubDivision"=>array(
                "className"=>"ModelSubDivision",
                "foreignKey"=>"model_division_id",
                "order" => "ModelSubDivision.order_sort ASC",
				'conditions' => array('deleted'=>'N')
            ),
            "ModelEquipment"=>array(
                "className"=>"ModelEquipment",
                "foreignKey"=>"model_division_id",
                "order" => "ModelEquipment.order_sort ASC",
				'conditions' => array('deleted'=>'N')
            ),
	);
}
?>