<?php
App::uses('AppModel', 'Model');

class RoleAction extends AppModel {

	public $useTable = "acl_roles_actions";

    public $hasOne =array(
            "Action"=>array(
                "className"=>"Action",
                "foreignKey"=>"id"
            ),
	);

}
?>