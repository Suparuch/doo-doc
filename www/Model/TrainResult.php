<?php
App::uses('AppModel', 'Model');
class TrainResult extends AppModel {
    public $name = 'TrainResult';
    public $useTable = "train_result";
    public $primaryKey = 'result_id';
}

?>