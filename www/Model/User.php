<?php
App::uses('AppModel', 'Model');

class User extends AppModel {

	public $useTable = "users";

    public $hasOne =array(
            "UserProfile"=>array(
                "className"=>"UserProfile",
                "foreignKey"=>"user_id"
            ),
            "RoleUser"=>array(
                "className"=>"RoleUser",
                "foreignKey"=>"user_id"
            )
				
            /*
            "UserFolder"=>array(
                "className"=>"UserFolder",
                "foreignKey"=>"user_id"
            ),
            */
	);
	public $belongsTo = array(
        "Rank"=>array(
                "className"=>"Rank",
               'foreignKey'    => "rank_id"
            ),
		"Unit"=>array(
				"className"=>"Unit",
				'foreignKey'    => "unit_id"
			)
    );
	/*
    public $hasMany =array(
            "UserContent"=>array(
                "className"=>"UserContent",
                "foreignKey"=>"user_id"
            ),
	);
	*/

}
?>