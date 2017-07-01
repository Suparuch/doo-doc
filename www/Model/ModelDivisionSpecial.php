<?php
App::uses('AppModel', 'Model');

class ModelDivisionSpecial extends AppModel {

	public $useTable = "model_divisions";

    public $hasMany =array(
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