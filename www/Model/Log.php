<?php
App::uses('AppModel', 'Model');

class Log extends AppModel {

	public $useTable = "trackers";
	public $hasMany =array(
            "User"=>array(
                "className"=>"User",
                "foreignKey"=>"user_id"
            ),
	);
}
?>