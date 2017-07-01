<?php
App::uses('AppModel', 'Model');

class Role extends AppModel {

	public $useTable = "roles";

    public $hasOne =array(
            "RoleAction"=>array(
                "className"=>"RoleAction",
                "foreignKey"=>"role_id"
            ),
	);

}
?>