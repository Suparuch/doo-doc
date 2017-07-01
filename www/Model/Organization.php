<?php
App::uses('AppModel', 'Model');

class Organization extends AppModel {

	//public $useTable = "organizations";
	public $useTable = "organizations_all";
	//public $useTable = "organizations_org";

    public $hasOne =array(
            "OrganizationType"=>array(
                "className"=>"OrganizationType",
                "foreignKey"=>"organization_type_id"
            ),
	);

    public $hasMany =array(
            "OrganizationModel"=>array(
                "className"=>"OrganizationModel",
                "foreignKey"=>"organization_id"
            ),
            "OrganizationLocation"=>array(
                "className"=>"OrganizationLocation",
                "foreignKey"=>"organization_id"
            ),
	);

}
?>