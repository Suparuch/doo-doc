<?php
App::uses('AppModel', 'Model');

class ModelSubDivision extends AppModel {

    public $useTable = "model_subdivisions";

    public $hasMany =array(
            "ModelPosition"=>array(
                "className"=>"ModelPosition",
                "foreignKey"=>"model_subdivision_id",
                "order" => "ModelPosition.order_sort ASC",
                'conditions' => array('deleted'=>'N')
            ),
	);
}
?>