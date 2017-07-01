<?php

App::uses('AppController', 'Controller');

class PastEventsController extends AppController {

    public $name = 'PastEvents';
    public $uses = array('PastEvent');
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
            //$whereConditions[] = "secret = '0'";
            $conditions = array('limit' => $this->Generator->setLimit(),
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions
            );
            $total = $this->PastEvent->find('count', $conditions);
            $PastEvents = $this->PastEvent->find('all', $conditions);
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
            // - period
            if (!empty($dataRequest['dpkStartDate'])) {
//                $dStart = $this->TextUtil->formatPckDateForWhereCond($dataRequest['dpkStartDate']); //sprintf("%1$04d-%2$02d-%3$02d", $start_date['year'], $start_date['month'], $start_date['day']);
//                $whereConditions[] = '(PastEvent.event_date >=\'' . $dStart . '\' )';
                $dStart = $this->TextUtil->formatDateForWhereCond($dataRequest['dpkStartDate']);
                if(!empty($dStart)){
                    $whereConditions[] = '(PastEvent.event_date >=\'' . $dStart . '\' )';
                }else{
                    $default['dpkStartDate']['day'] = '';
                    $default['dpkStartDate']['month'] = '';
                    $default['dpkStartDate']['year'] = '';
                }
            }
            if (!empty($dataRequest['dpkEndDate'])) {
//                $dEnd = $this->TextUtil->formatPckDateForWhereCond($dataRequest['dpkEndDate']); //sprintf("%1$04d-%2$02d-%3$02d", $end_date['year'], $end_date['month'], $end_date['day']);
//                $whereConditions[] = '(PastEvent.event_date <=\'' . $dEnd . '\' )';
                $dEnd = $this->TextUtil->formatDateForWhereCond($dataRequest['dpkEndDate']);
                if(!empty($dEnd)){
                    $whereConditions[] = '(PastEvent.event_date <=\'' . $dEnd . '\' )';
                }else{
                    $default['dpkEndDate']['day'] = '';
                    $default['dpkEndDate']['month'] = '';
                    $default['dpkEndDate']['year'] = '';
                }
            }
            
            $conditions = array('limit' => $this->Generator->setLimit(), 'offset' => $offset,
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions
            );

            $this->set('default', $default);
            
            // Query
            $total = $this->PastEvent->find('count', array('conditions' => $whereConditions));
            $PastEvents = $this->PastEvent->find('all', $conditions);
        }

        // Set breadcrumb
        $breadcrumb = array(
            'controller' => array(
                'name' => 'ระบบงานประวัติศาสตร์และพิพิธภัณฑ์ทหาร',
                'url' => '',
                'subtitle' => 'เหตุการณ์วันนี้ในอดีต'
            ),
        );
        $this->set('breadcrumb', $breadcrumb);

        // Set model to view
        $this->set('PastEvents', $PastEvents);
        $pagination = array('offset' => $offset, 'total' => $total, 'limit' => $this->Generator->setLimit(), 'model' => 'PastEvent', 'pages' => 5);
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
                'order' => array('event_name' => 'asc'),
                'conditions' => $whereConditions
            );
            $PastEvents = $this->PastEvent->find('all', $conditions);

            foreach ($PastEvents[0]['PastEvent'] as $key => $value)
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
                $this->PastEvent->id = $id;
                if ($this->PastEvent->exists())
                    $status = $this->PastEvent->save($data) ? 'SUCCESS' : 'FAILED';
                else
                    $status = 'FAILED';
            }else {
                $data['id'] = $this->Generator->getID();
                $this->PastEvent->create();
                $status = $this->PastEvent->save($data) ? 'SUCCESS' : 'FAILED';
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
                $this->PastEvent->id = $id;
                if ($this->PastEvent->exists())
                    $status = $this->PastEvent->save($data) ? 'SUCCESS' : 'FAILED';
                else
                    $status = 'FAILED';
            } else
                $status = 'FAILED';
        }

        echo json_encode(array('status' => $status));
    }
    
    public function formConRptToday() {
        Configure::write('debug', 2);

        $this->layout = 'blank';
    }

    public function printTodayReport() {
        Configure::write('debug', 2);

        $this->layout = 'blank';
        
        // Condition
        //
        $whereConditions = array();
        $whereConditions['deleted'] = 'N';

        $conditions = array('limit' => '999999',
            'order' => array('event_date' => 'desc'),
            'conditions' => $whereConditions
        );

        $PastEvents = $this->PastEvent->find('all', $conditions);
        $this->set('PastEvents', $PastEvents);
    }

}

?>