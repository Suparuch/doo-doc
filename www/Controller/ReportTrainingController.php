<?php
App::uses('AppController', 'Controller');
App::uses('DateLib', 'Lib/Utility');

class ReportTrainingController extends AppController {
	public $name = "ReportTraining";
	public $uses = array("ReportTrain");

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
         $data = $this->request->data;
         $require = array("course","unit","locationunit", "fromdatetrain", "todatetrain", "basetrain", "fromdatebase", "todatebase",
         "outbaselocation", "fromdateoutbase", "todateoutbase", "resultlocation", "fromdateresult", "todateresult", "onlypersonlist",
         "onlyunitlist", "location");
         if($data){
            $empty = true;
            foreach ($require as $field){
                if(!empty($data[$field])){
                    $empty = false;
                    break;
                }
            }
            if($empty){
                $data = $this->ReportTrain->query("SELECT * FROM report_training");
            }
            else{
                $course = $data['course'];
                $unit = $data['unit'];
                $locationunit = $data['locationunit'];
                $fromdatetrain = $data['fromdatetrain'];
                if(empty($fromdatetrain)){
                    $fromdatetrain = "NULL";
                }
                else{
                    $fromdatetrain = "'$fromdatetrain'";
                }
                $todatetrain = $data['todatetrain'];
                if(empty($todatetrain)){
                    $todatetrain = "NULL";
                }
                else{
                    $todatetrain = "'$todatetrain'";
                }
                $basetrain = $data['basetrain'];
                $fromdatebase = $data['fromdatebase'];
                if(empty($fromdatebase)){
                    $fromdatebase = "NULL";
                }
                else{
                    $fromdatebase = "'$fromdatebase'";
                }
                $todatebase = $data['todatebase'];
                if(empty($todatebase)){
                    $todatebase = "NULL";
                }
                else{
                    $todatebase = "'$todatebase'";
                }
                $outbaselocation = $data['outbaselocation'];
                $fromdateoutbase = $data['fromdateoutbase'];
                if(empty($fromdateoutbase)){
                    $fromdateoutbase = "NULL";
                }
                else{
                    $fromdateoutbase = "'$fromdateoutbase'";
                }
                $todateoutbase = $data['todateoutbase'];
                if(empty($todateoutbase)){
                    $todateoutbase = "NULL";
                }
                else{
                    $todateoutbase = "'$todateoutbase'";
                }
                $resultlocation = $data['resultlocation'];
                $fromdateresult = $data['fromdateresult'];
                if(empty($fromdateresult)){
                    $fromdateresult = "NULL";
                }
                else{
                    $fromdateresult = "'$fromdateresult'";
                }
                $todateresult = $data['todateresult'];
                if(empty($todateresult)){
                    $todateresult = "NULL";
                }
                else{
                    $todateresult = "'$todateresult'";
                }
                $onlypersonlist = $data['onlypersonlist'];
                $onlyunitlist = $data['onlyunitlist'];
                $location = $data['location'];
                $data = $this->ReportTrain->query("SELECT * FROM report_training WHERE
                course like '$course' OR unit like '$unit' OR locationunit like '$locationunit' OR fromdatetrain = $fromdatetrain OR
                todatetrain = $todatetrain OR basetrain like '$basetrain' OR fromdatebase = $fromdatebase OR todatebase = $todatebase OR
                outbaselocation like '$outbaselocation' OR fromdateoutbase = $fromdateoutbase OR todateoutbase = $todateoutbase OR
                resultlocation like '$resultlocation' OR fromdateresult = $fromdateresult OR todateresult = $todateresult OR
                onlypersonlist like '$onlypersonlist' OR onlyunitlist like '$onlyunitlist' OR location like '$location'
                ");
            }
         }
         else{
            $data = $this->ReportTrain->query("SELECT * FROM report_training");
         }
         $this->set('data',$data);

    }
    public function add(){
        $dateLib = new DateLib();
        $data = $this->request->data;
        if($data){
            $this->ReportTrain->create();
            $data['fromdatetrain'] = $dateLib->convertBEToAD($data['fromdatetrain']);
            $data['todatetrain'] = $dateLib->convertBEToAD($data['todatetrain']);
            $data['fromdatebase'] = $dateLib->convertBEToAD($data['fromdatebase']);
            $data['todatebase'] = $dateLib->convertBEToAD($data['todatebase']);
            $data['fromdateoutbase'] = $dateLib->convertBEToAD($data['fromdateoutbase']);
            $data['todateoutbase'] = $dateLib->convertBEToAD($data['todateoutbase']);
            $data['fromdateresult'] = $dateLib->convertBEToAD($data['fromdateresult']);
            $data['todateresult'] = $dateLib->convertBEToAD($data['todateresult']);
            if($this->ReportTrain->save($data)){
                $this->redirect('index');
            }
        }
    }
    public function edit_data(){
        $this->autoRender = false;
        $data = $this->request->data['id'];
        if($data){
            $row = $this->ReportTrain->query("SELECT * FROM report_training WHERE id = '$data'");
            echo json_encode($row);
        }

    }
    public function ajaxEdit_report(){
        $this->autoRender = false;
        $data = $this->request->data;
        if($data){
            if($this->ReportTrain->save($data)){
                $this->redirect('index');
            }
        }
    }
    public function delete_report(){
        $this->autoRender = false;
        $data = $this->request->data;
        foreach($data as $value){
            $this->ReportTrain->delete($value);
        }
    }

}

?>