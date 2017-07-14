<?php
App::uses('AppController', 'Controller');
App::uses('DateLib', 'Lib/Utility');

class TrainController extends AppController
{

    public $name = "Train";
    public $uses = array("TrainPerson","TrainUnit", "TrainResult","TrainSchedule","Rank","Position","Unit");
    function beforeFilter(){
        $currentUser = $this->Session->check('AuthUser');
        if(empty($currentUser)){
            $this->Session->delete('AuthUser');
            $this->Session->destroy();

            $url = Configure::read('Application.Domain').'Logins';
            $this->redirect($url);
        }
    }
    public function index(){
        $dateLib = new DateLib();

        //Dropdown Rank
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('name','short_name'));
        $Ranks = $this->Rank->find('list', $conditions2);
        $this->set('Ranks', $Ranks);

        $data = $this->request->data;
        $require = array("rank","last_name","first_name", "position", "expert", "belongto", "course", "train_time", "train_date", "subject");
        if($data){
            $empty = true;
            if($data['course'] == " ") {
                $data['course']=NULL;
            }
            foreach($require as $field ){
                if(!empty($data[$field])){
                    $empty = false;
                    break;
                }
            }
            if($empty){
                $data = $this->TrainPerson->query("SELECT * FROM train_persons ORDER BY id DESC");
            } else {
                $rank = $data['TrainPerson']['rank'];
                if($rank == "ไม่จำกัดชั้นยศ"){
                    $rank = "%";
                }
                // if()
                $firstname = $data['first_name'];
                $lastname = $data['last_name'];
                $position = $data['position'];
                $expert = $data['expert'];
                $belongto = $data['belongto'];
                $course = $data['course'];
                $time = $data['train_time'];
                if (empty($data['train_date'])) {
                    $date = '1970-01-01';
                } else {
                    $date = $dateLib->convertBEToAD($data['train_date']);
                }
                $subject = $data['subject'];
                $data = $this->TrainPerson->query("SELECT * FROM train_persons 
                WHERE first_name like '$firstname' OR last_name like '$lastname' OR position like '$position' OR expert like '$expert'
                OR belongto like '$belongto' OR course like '$course'  OR train_time like '$time' OR train_date = '$date' OR 
                subject like '$subject' OR rank = '$rank' ORDER BY id DESC" );
            }
        } else {
            $data = $this->TrainPerson->query("SELECT * FROM train_persons ORDER BY id DESC");
        }
        $this->set('data', $data);
    }

    public function getPosition(){
        $this->autoRender = false;
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('name'));
        $position = $this->Position->find('list', $conditions2);
        echo json_encode($position);
    }

    public function addPersonTrain(){
        $dateLib = new DateLib();
        //Dropdown Rank
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('name','short_name'));
        $Ranks = $this->Rank->find('list', $conditions2);
        $this->set('Ranks', $Ranks);


        //Dropdown POsition
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array(''));
        $Positions = $this->Position->find('count', $conditions2);
        $this->set('Positions', $Positions);


        $data = $this->request->data;
        $table = array();
        if($data){
            for($i=1; $i<=5; $i++){
                if(empty($data['specific'.$i])){
                    break;
                } 
                $table['first_name'] = $data['first_name'];
                $table['last_name'] = $data['last_name'];
                $table['rank'] = $data['TrainPerson']['rank'];
                $table['position'] = $data['position'];
                $table['expert'] = $data['expert'];
                $table['belongto'] = $data['belongto'];
                $table['course'] = $data['course'];
                $table['subject'] = $data['subject'];
                $table['specific'] = $data['specific'.$i];
                $table['train_time'] = $data['time'.$i];
                $table['train_date'] = $dateLib->convertBEToAD($data['date'.$i]);
                $table['result'] = $data['result'.$i];
                $table['teacher'] = $data['teacher'.$i];
                $table['head'] = $data['head'.$i];
                $table['problem'] = $data['problem'.$i];
                $table['note'] = $data['note'.$i];
                $table['name2'] = $data['checkName'];
                $table['position2'] = $data['checkPosition'];
                $this->TrainPerson->create();
                $this->TrainPerson->save($table);
            }
            $this->redirect('index');
        }
    }
    public function edit_person(){
        $dateLib = new DateLib();
        $this->autoRender = false;
        if($this->request->is('post')){
            $data = $this->request->data['id'];
            if($data){
                $row = $this->TrainPerson->query("SELECT * FROM train_persons WHERE id = $data ");
                $row[0][0]['train_date'] = $dateLib->convertADToBE($row[0][0]['train_date']);
                echo json_encode($row);
            }
        }
    }
    public function ajaxEdit_person(){
        $dateLib = new DateLib();
        $this->autoRender = false;

        if($data = $this->request->data){
            $data['rank'] = $data['TrainPerson']['rank'];
            $data['TrainPerson']['train_date'] =  $dateLib->convertBEToAD($data['TrainPerson']['train_date']);
            if($this->TrainPerson->save($data)){
                $this->redirect('index');
            }

        }
    }
    public function delete_person(){
        $this->autoRender = false;
        $data = $this->request->data;
        foreach($data as $value){
            $this->TrainPerson->delete($value);
        }
        $this->redirect('index');
    }


    public function groupTrain(){
        $dateLib = new DateLib();

        //Dropdown Unit
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('name','short_name'));
        $Units = $this->Unit->find('list', $conditions2);
        $this->set('Units', $Units);

        //Dropdown Rank
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('name','short_name'));
        $Ranks = $this->Rank->find('list', $conditions2);
        $this->set('Ranks', $Ranks);

        $data = $this->request->data;
        $require = array('unit','headUnit','rank','name', 'belongto', 'course', 'subject', 'specific', 'time', 'date');
        if($data){
            if($data['course'] == " ") $data['course'] = NULL;
            if($data['subject'] == " ")$data['subject'] = NULL;
            $error = true;
            foreach($require as $field ){
                if(!empty($data[$field])){
                    $error = false;
                    break;
                }
            }
            if($error){

                $data = $this->TrainUnit->query("SELECT * FROM train_units ORDER BY id DESC");  

            }
            else{
                // $unit =  $data['TrainPerson']['unit'];
                // $headUnit = $data['headUnit'];
                // $rank =  $data['TrainPerson']['rank'];
                // $name = $data['name'];
                // $belongto =  $data['TrainPerson']['belongTo'];
                $course = $data['course'];
                $subject = $data['subject'];
                $specific = $data['specific'];
                $time = $data['time'];
                $date = $data['date'];
                if (empty($data['date'])) {
                    $date = '1970-01-01';
                } else {
                    $date = $dateLib->convertBEToAD($data['date']);
                }

                // $data = $this->TrainUnit->query("SELECT * FROM train_units
                // WHERE unit like '$unit' OR headUnit like '$headUnit' OR rank like '$rank' OR name like '$name'
                // OR belongto like '$belongto' OR course like '$course' OR subject like '$subject' OR specific like '$specific'
                // OR train_time like '$time' OR train_date = '$date' ORDER BY id DESC
                // ");
                $data = $this->TrainUnit->query("SELECT * FROM train_units
                WHERE course like '$course' OR subject like '$subject' OR specific like '$specific'
                OR train_time like '$time' OR train_date = '$date' ORDER BY id DESC
                ");
            }
        }
        else{
            $data = $this->TrainUnit->query("SELECT * FROM train_units ORDER BY id DESC");
        }
        $this->set('data', $data);
    }
    public function addGroupTrain(){
        $dateLib = new DateLib();

        //Dropdown Unit
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('name','short_name'));
        $Units = $this->Unit->find('list', $conditions2);
        $this->set('Units', $Units);

        //Dropdown Rank
        $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('name','short_name'));
        $Ranks = $this->Rank->find('list', $conditions2);
        $this->set('Ranks', $Ranks);

        $data = $this->request->data;
        $table = array();
        if($data){
            for($i=1; $i<=5; $i++){
                if(empty($data['specific'.$i])){
                    break;
                } 
                $table['unit'] = $data['TrainPerson']['unit'];
                $table['rank'] = $data['TrainPerson']['rank'];
                $table['headUnit'] = $data['headUnit'.$i];
                $table['belongto'] = $data['TrainPerson']['belongTo'];
                $table['course'] = $data['course'.$i];
                $table['subject'] = $data['subject'.$i];
                $table['specific'] = $data['specific'.$i];
                $table['train_time'] = $data['time'.$i];
                $table['train_date'] = $dateLib->convertBEToAD($data['date'.$i]);
                $table['result'] = $data['result'.$i];
                $table['teacher'] = $data['teacher'.$i];
                $table['head'] = $data['head'.$i];
                $table['problem'] = $data['problem'.$i];
                $table['note'] = $data['note'.$i];
                $table['name2'] = $data['checkName'];
                $table['position2'] = $data['checkPosition'];
                $this->TrainUnit->create();
                $this->TrainUnit->save($table);
            }
        }
    }
    public function edit_group(){
        $dateLib = new DateLib();
        $this->autoRender = false;
        if($this->request->is('post')){
            $data = $this->request->data['id'];
            if($data){
                $row = $this->TrainUnit->query("SELECT * FROM train_units WHERE id = $data ");
                $row[0][0]['train_date'] = $dateLib->convertADToBE($row[0][0]['train_date']);
                echo json_encode($row);
            }
        }
    }
    public function ajaxEdit_group(){
        $dateLib = new DateLib();
        $this->autoRender = false;

        if($data = $this->request->data){
            $data['train_date'] =  $dateLib->convertBEToAD($data['date']);
            if($this->TrainUnit->save($data)){
                $this->redirect('groupTrain');
            }
        }
    }

    public function delete_group(){
        $this->autoRender = false;
        $data = $this->request->data;
        foreach($data as $value){
            $this->TrainUnit->delete($value);
        }
        $this->redirect('groupTrain');
    }



    public function scheduleTraining(){
        $search = $this->request->data;
        $require = array("unit", "proof");
        if($search){
            $empty = true;
            foreach ($require as $field){
                if(!empty($search[$field])){
                    $empty = false;
                    break;
                }
            }
            if($empty){
                $query = $this->TrainSchedule->query("SELECT * FROM train_schedule");
            }
            else{
                $unit = $search['unit'];
                $proof = $search['proof'];
                $query = $this->TrainSchedule->query("SELECT * FROM train_schedule WHERE unit like '$unit' OR proof like '$proof'");
            }
            
        }
        else{
            $query = $this->TrainSchedule->query("SELECT * FROM train_schedule");
        }
         
         $this->set('data',$query);
    }
    public function addScheduleTraining(){
        $data = $this->request->data;
        $table = array();
        if($data){
            for($i=1; $i<=5; $i++){
                if(empty($data['task'.$i])){
                    break;
                } 
                $table['unit'] = $data['unit'];
                $table['proof'] = $data['proof'];
                $table['task'] = $data['task'.$i];
                $table['unittrained'] = $data['unittrained'.$i];
                $table['base'] = $data['base'.$i];
                $table['fromdatebase'] = $data['fromdatebase'.$i];
                $table['todatebase'] = $data['todatebase'.$i];
                $table['location'] = $data['location'.$i];
                $table['fromdateoutbase'] = $data['fromdateoutbase'.$i];
                $table['todateoutbase'] = $data['fromdateoutbase'.$i];
                $table['note'] = $data['note'.$i];
                $table['name'] = $data['checkName'];
                $table['position'] = $data['checkPosition'];
                $this->TrainSchedule->create();
                $this->TrainSchedule->save($table);
            }
            $this->redirect('scheduleTraining');
        }
    }
    public function edit_schedule(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $data = $this->request->data['id'];
            if($data){
                $row = $this->TrainSchedule->query("SELECT * FROM train_schedule WHERE id = $data ");
                echo json_encode($row);
            }
        }
    }

    public function ajaxEdit_schedule(){
         $this->autoRender = false;
         if($data = $this->request->data){
            if($this->TrainSchedule->save($data)){
                $this->redirect('scheduleTraining');
            }
        }
    }
    public function delete_schedule(){
        $this->autoRender = false;
        if($data = $this->request->data){
            foreach ($data as $id){
                $this->TrainSchedule->delete($id);
            }
        }
        $this->redirect('scheduleTraining');
    }
    public function countTraining(){

    }

    public function reportCountTraing(){

    }




    public function reportResult() {
        $search = $this->request->data;
        if($search){
            $title = $search['title'];
            if(empty($title)){
                $data = $this->TrainResult->query("SELECT * FROM train_result");
            }
            else{
                $data = $this->TrainResult->query("SELECT * FROM train_result WHERE title = '$title'");
            }
        }
        else{
            $data = $this->TrainResult->query("SELECT * FROM train_result");
        }
        
        $this->set('data', $data);

	}

    public function add_report_result() {
        $data = $this->request->data;
        $table = array();
        if($data){
            for($i=1; $i<=5; $i++){
                if(empty($data['title'.$i])){
                    break;
                }
                $table['title'] = $data['title'.$i];
                $table['unit'] = $data['unit'.$i];
                $table['suggestion'] = $data['suggestion'.$i];
                $table['note'] = $data['note'.$i];

                $this->TrainResult->create();
                $this->TrainResult->save($table);
            }
            $this->redirect('reportResult');
        }
	}
    public function edit_report(){
        $this->autoRender = false;
        if($this->request->is('post')){
            $data = $this->request->data['result_id'];
            if($data){
                $row = $this->TrainResult->query("SELECT * FROM train_result WHERE result_id = $data ");
                echo json_encode($row);
            }
        }
    }
    public function ajaxEdit_result(){
        $this->autoRender = false;
        $data = $this->request->data;
        if($data){
            if($this->TrainResult->save($data)){
                $this->redirect('reportResult');
            }
        }
    }
    public function delete_result(){
        $this->autoRender = false;
        if($this->request->is('post')){
            if($data = $this->request->data){
                if(count($data['result_id'])==1){
                    $id = $data['result_id'];
                    $this->TrainResult->query("DELETE FROM train_result WHERE result_id = $id");
                }
                else{
                    foreach($data['result_id'] as $id){
                    $this->TrainResult->query("DELETE FROM train_result WHERE result_id = $id");
                    }
                }       
        }
        }
        $this->redirect('reportResult');
    }

}