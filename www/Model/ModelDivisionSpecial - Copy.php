<?php
App::uses('AppModel', 'Model');

class ModelDivisionSpecial extends AppModel {

	public $useTable = "model_divisions";

    public $hasMany =array(
            "ModelSubDivision"=>array(
                "className"=>"ModelSubDivision",
                "foreignKey"=>"model_division_id"
            ),
            "ModelEquipment"=>array(
                "className"=>"ModelEquipment",
                "foreignKey"=>"model_division_id"
            ),
	);
}
?>