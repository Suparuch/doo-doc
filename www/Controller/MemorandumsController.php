<?php

App::uses('AppController', 'Controller');

class MemorandumsController extends AppController {

    public $name = 'Memorandums';
    public $uses = array('Memorandum');
    public $components = array("FileStorageComponent", "Generator", "TextUtil");

    function beforeFilter() {
        $currentUser = $this->Session->check('AuthUser');
        if (empty($currentUser)) {
            $this->Session->delete('AuthUser');
            $this->Session->destroy();

            $url = Configure::read('Application.Domain') . 'Logins';
            $this->redirect($url);
        }
    }

    public function index() {
        Configure::write('debug', 2);
        //$this->layout = 'blank';
        //$this->autoRender = false;

        $dataRequest = $this->request->data;
        if (empty($dataRequest)) {
            $offset = 0;
            $whereConditions = array();
            $whereConditions['deleted'] = 'N';   
            $whereConditions[] = "secret = '0'";
            $conditions = array('limit' => $this->Generator->setLimit(),
                'order' => array('memo_date_start' => 'asc'),
                'conditions' => $whereConditions
            );
            $total = $this->Memorandum->find('count', $conditions);
            $Memorandums = $this->Memorandum->find('all', $conditions);
           
        } else {

            $default = array();
            $default = $dataRequest;
            //$this->set('default', $default);

            // intitial
            $whereConditions = array();
            $whereConditions['deleted'] = 'N';

            
            $offset = $dataRequest['offset'];
            
            // Search condition
            // 
            // - secret code
            $secret = $dataRequest['rdbSecret'];           
            if ($secret != '9'){
                $whereConditions[] = "secret = '" . $secret . "'";
            }
            // - period
            if (!empty($dataRequest['dpkStartDate'])) {
                $dStart = $this->TextUtil->formatDateForWhereCond($dataRequest['dpkStartDate']);
                if(!empty($dStart)){
                    $whereConditions[] = '(Memorandum.memo_date_start >=\'' . $dStart . '\' )';
                }else{
                    $default['dpkStartDate']['day'] = '';
                    $default['dpkStartDate']['month'] = '';
                    $default['dpkStartDate']['year'] = '';
                }
            }
            if (!empty($dataRequest['dpkEndDate'])) {
                $dEnd = $this->TextUtil->formatDateForWhereCond($dataRequest['dpkEndDate']);
                if(!empty($dEnd)){
                    $whereConditions[] = '(Memorandum.memo_date_end <=\'' . $dEnd . '\' )';
                }else{
                    $default['dpkEndDate']['day'] = '';
                    $default['dpkEndDate']['month'] = '';
                    $default['dpkEndDate']['year'] = '';
                }
            }
            if (!empty($dataRequest['txtEvent'])) {
                $whereConditions[] = '(Memorandum.event like \'%' . trim($dataRequest['txtEvent']) . '%\' )';
            }

            $conditions = array('limit' => $this->Generator->setLimit(), 'offset' => $offset,
                'order' => array('memo_date_start' => 'asc'),
                'conditions' => $whereConditions
            );

            $this->set('default', $default);
            
            // Query
            $total = $this->Memorandum->find('count', array('conditions' => $whereConditions));
            $Memorandums = $this->Memorandum->find('all', $conditions);
        }

        // Set breadcrumb
        $breadcrumb = array(
            'controller' => array(
                'name' => 'ระบบงานประวัติศาสตร์และพิพิธภัณฑ์ทหาร',
                'url' => '',
                'subtitle' => 'จดหมายเหตุ'
            ),
        );
        $this->set('breadcrumb', $breadcrumb);

        // Set model to view
        $this->set('Memorandums', $Memorandums);
        
        $pagination = array('offset' => $offset, 'total' => $total, 'limit' => $this->Generator->setLimit(), 'model' => 'Memorandum', 'pages' => 5);
        $this->set('pagination', $pagination);
    }

    public function form($id = null) {
        Configure::write('debug', 2);

        $this->layout = 'blank';
        $default = array();
        if (!empty($id)) {
            $whereConditions = array();
            $whereCOnditions['deleted'] = 'N';
            $whereConditions['id'] = $id;
            $conditions = array('limit' => '1',
                'order' => array('event' => 'asc'),
                'conditions' => $whereConditions
            );
            $Memorandums = $this->Memorandum->find('all', $conditions);

            foreach ($Memorandums[0]['Memorandum'] as $key => $value)
                $default[$key] = $value;

            $this->set('default', $default);
        }
    }

    public function save($id = null) {
        Configure::write('debug', 2);

        $this->autoRender = false;

        $data = $this->request->data;

        if (!empty($data)) {
            if (!empty($id)) {
                $this->Memorandum->id = $id;
                if ($this->Memorandum->exists())
                    $status = $this->Memorandum->save($data) ? 'SUCCESS' : 'FAILED';
                else
                    $status = 'FAILED';
            }else {
                $data['id'] = $this->Generator->getID();
                $this->Memorandum->create();
                $status = $this->Memorandum->save($data) ? 'SUCCESS' : 'FAILED';
            }
        } else
            $status = 'FAILED';

        echo json_encode(array('status' => $status));
    }

    public function delete() {
        $this->autoRender = false;
        $status = '';

        $ids = array();
        $ids = $this->request->data['ids'];

        foreach ($ids as $id) {
            if (!empty($id)) {
                $data = array();
                $data['deleted'] = "Y";
                $this->Memorandum->id = $id;
                if ($this->Memorandum->exists())
                    $status = $this->Memorandum->save($data) ? 'SUCCESS' : 'FAILED';
                else
                    $status = 'FAILED';
            } else
                $status = 'FAILED';
        }

        echo json_encode(array('status' => $status));
    }

    public function formConRptMonthly() {
        Configure::write('debug', 2);

        $this->layout = 'blank';

        // Month
        $thai_month_arr = array(
            "1" => "มกราคม",
            "2" => "กุมภาพันธ์",
            "3" => "มีนาคม",
            "4" => "เมษายน",
            "5" => "พฤษภาคม",
            "6" => "มิถุนายน",
            "7" => "กรกฎาคม",
            "8" => "สิงหาคม",
            "9" => "กันยายน",
            "10" => "ตุลาคม",
            "11" => "พฤศจิกายน",
            "12" => "ธันวาคม"
        );
        $this->set('thai_month_arr', $thai_month_arr);

        // Year
        $years = Array();
        for ($i = 200; $i >= 0; $i--) {
            array_push($years, ((date('Y') + 543)) - $i);
        }
        arsort($years);
        $this->set('years', $years);
    }

    public function printMonthlyReport($secret = null, $month = null, $year = null) {
        Configure::write('debug', 2);

        $this->layout = 'blank';

        $this->set('con_secret', $secret);
        $this->set('con_month', $month);
        $this->set('con_month_name', $this->TextUtil->GetMonthNameThByNum($month));
        $this->set('con_year', $year);
        $this->set('con_year_th', $this->TextUtil->thainumDigit($year));

        // Condition
        //
        $whereConditions = array();
        $whereConditions['deleted'] = 'N';
        $whereConditions[] = "secret = '" . $secret . "'";

        $dateRptStart = '01/'.$month.'/'.(intval($year)-543);
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, intval($month), (intval($year)-543));
        $dateRptEnd = $daysInMonth.'/'.$month.'/'.(intval($year)-543);
        
        $dStart = $this->TextUtil->formatPckDateForWhereCond($dateRptStart); 
        $whereConditions[] = '(Memorandum.memo_date_start >=\'' . $dStart . '\' )';
        
        $dEnd = $this->TextUtil->formatPckDateForWhereCond($dateRptEnd); 
        $whereConditions[] = '(Memorandum.memo_date_end <=\'' . $dEnd . '\' )';        

        $conditions = array('limit' => '999999',
            'order' => array('memo_date_start' => 'asc'),
            'conditions' => $whereConditions
        );

        $Memorandums = $this->Memorandum->find('all', $conditions);
        $this->set('Memorandums', $Memorandums);
    }

    public function printPdf() {

        $this->layout = 'blank';
    }

}

?>