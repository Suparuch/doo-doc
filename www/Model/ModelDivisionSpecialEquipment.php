<?php
App::uses('AppModel', 'Model');

class ModelDivisionSpecialEquipment extends AppModel {

	public $useTable = "model_divisions";

    public $hasMany =array(
            "ModelEquipment"=>array(
                "className"=>"ModelEquipment",
                "foreignKey"=>"model_division_id",
                "order" => "ModelEquipment.order_sort ASC",
                'conditions' => array('deleted'=>'N')
            ),
	);
}
?>