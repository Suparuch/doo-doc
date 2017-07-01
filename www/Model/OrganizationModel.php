<?php
App::uses('AppModel', 'Model');

class OrganizationModel extends AppModel {

	public $useTable = "organization_models";

    public $hasOne =array(
            "UserProfile"=>array(
                "className"=>"UserProfile",
                "foreignKey"=>"user_id"
            ),
            "UserFolder"=>array(
                "className"=>"UserFolder",
                "foreignKey"=>"user_id"
            ),
	);

    public $hasMany =array(
            "UserContent"=>array(
                "className"=>"UserContent",
                "foreignKey"=>"user_id"
            ),
	);

}
?>