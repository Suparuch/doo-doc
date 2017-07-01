<?php

App::uses('AppController', 'Controller');

class HistoryBarracksController extends AppController {

    public $name = 'HistoryBarracks';
    public $uses = array('HistoryBarrack', 'Area', 'Unit', 'TableAttachFile');
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
            $conditions = array('limit' => $this->Generator->setLimit(),
                'order' => array('hb_establish_date' => 'asc'),
                'conditions' => $whereConditions
            );
            $total = $this->HistoryBarrack->find('count', $conditions);
            $HistoryBarracks = $this->HistoryBarrack->find('all', $conditions);
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
            if (!empty($dataRequest['txtHbName'])) {
                $whereConditions[] = '(HistoryBarrack.hb_name like \'%' . trim($dataRequest['txtHbName']) . '%\' )';
            }
            if (!empty($dataRequest['txtHbArea'])) {
                $whereConditions[] = '(HistoryBarrack.hb_area like \'%' . trim($dataRequest['txtHbArea']) . '%\' )';
            }
            if (!empty($dataRequest['dpkEstablishDate'])) {
//                $dStart = $this->TextUtil->formatPckDateForWhereCond($dataRequest['dpkEstablishDate']); //sprintf("%1$04d-%2$02d-%3$02d", $start_date['year'], $start_date['month'], $start_date['day']);
//                $whereConditions[] = '(HistoryBarrack.hb_establish_date =\'' . $dStart . '\' )';
                $dStart = $this->TextUtil->formatDateForWhereCond($dataRequest['dpkEstablishDate']);
                if (!empty($dStart)) {
                    $whereConditions[] = '(HistoryBarrack.hb_establish_date =\'' . $dStart . '\' )';
                } else {
                    $default['dpkEstablishDate']['day'] = '';
                    $default['dpkEstablishDate']['month'] = '';
                    $default['dpkEstablishDate']['year'] = '';
                }
            }
            if (!empty($dataRequest['ddlUnit'])) {
                $whereConditions[] = '(HistoryBarrack.hb_unit_id = \'' . trim($dataRequest['ddlUnit']) . '\' )';
            }

            $conditions = array('limit' => $this->Generator->setLimit(), 'offset' => $offset,
                'order' => array('hb_establish_date' => 'asc'),
                'conditions' => $whereConditions
            );

            $this->set('default', $default);

            // Query
            $total = $this->HistoryBarrack->find('count', array('conditions' => $whereConditions));
            $HistoryBarracks = $this->HistoryBarrack->find('all', $conditions);
        }

        // Set breadcrumb
        $breadcrumb = array(
            'controller' => array(
                'name' => 'ระบบงานประวัติศาสตร์และพิพิธภัณฑ์ทหาร',
                'url' => '',
                'subtitle' => 'ประวัติศาสตร์เฉพาะเรื่อง'
            ),
        );
        $this->set('breadcrumb', $breadcrumb);

        $conditions = array();
        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
        $Units = $this->Unit->find('list', $conditions);
        $this->set('Units', $Units);

        $conditions = array();
        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
        $Areas = $this->Area->find('list', $conditions);
        $this->set('Areas', $Areas);

        $this->set('HistoryBarracks', $HistoryBarracks);
        $pagination = array('offset' => $offset, 'total' => $total, 'limit' => $this->Generator->setLimit(), 'model' => 'HistoryBarrack', 'pages' => 5);
        $this->set('pagination', $pagination);
    }

    public function form($id = null) {
        Configure::write('debug', 2);

        $this->layout = 'blank';
        $default = array();
        $default['id'] = $this->Generator->getID();

        if (!empty($id)) {
            $whereConditions = array();
            $whereCOnditions['deleted'] = 'N';
            $whereConditions['id'] = $id;
            $conditions = array('limit' => '1',
                'order' => array('id' => 'asc'),
                'conditions' => $whereConditions
            );
            $HistoryBarracks = $this->HistoryBarrack->find('all', $conditions);

            foreach ($HistoryBarracks[0]['HistoryBarrack'] as $key => $value)
                $default[$key] = $value;

            //$this->set('default', $default);
            $default['action'] = 'EDIT';
        } else {
            $default['action'] = 'ADD';
        }
        $this->set('default', $default);

        $conditions = array();
        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
        $Units = $this->Unit->find('list', $conditions);
        $this->set('Units', $Units);

        $conditions = array();
        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
        $Areas = $this->Area->find('list', $conditions);
        $this->set('Areas', $Areas);

        $whereConditions = array();
        $whereConditions['deleted'] = 'N';
        $whereConditions['file_table_name'] = 'HistoryBarracks';
        $whereConditions['file_table_key'] = $default['id'];
        $conditions = array('limit' => $this->Generator->setLimit(),
            'order' => array('id' => 'asc'),
            'conditions' => $whereConditions
        );
        $TableAttachFiles = $this->TableAttachFile->find('all', $conditions);

        $this->set('TableAttachFiles', $TableAttachFiles);
    }

    public function save($id = null, $formAction = "EDIT") {
        Configure::write('debug', 2);
        $this->autoRender = false;
        $data = $this->request->data;

        if (!empty($data)) {
            if (!empty($id)) {
                $this->HistoryBarrack->id = $id;
                if ($formAction == "ADD") {
                    $data['id'] = $id;
                    $this->HistoryBarrack->create();
                }
                $status = $this->HistoryBarrack->save($data) ? 'SUCCESS' : 'FAILED';
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
                $this->HistoryBarrack->id = $id;
                if ($this->HistoryBarrack->exists())
                    $status = $this->HistoryBarrack->save($data) ? 'SUCCESS' : 'FAILED';
                else
                    $status = 'FAILED';
            } else
                $status = 'FAILED';
        }

        echo json_encode(array('status' => $status));
    }

    public function uploadDocument($pk_id = null) {
        $this->layout = 'blank';
        $this->autoRender = false;

        $response = array();
        if (!empty($_FILES)) {
            $original_name = $_FILES['Filedata']['name'];
            $file_type = $_FILES['Filedata']['type'];
            $original_size = $_FILES['Filedata']['size'];
            $code = String::uuid();
            $allowedExts = array('docx', 'txt', 'pdf', 'jpg', 'jpeg', 'png', 'gif', 'xlsx', 'pptx', 'bmp', 'zip', 'swf');
            $receieve_error = explode(".", $original_name);
            $extension = strtolower(end($receieve_error));

            // Check file size (not over 5MB)
            if ($original_size <= 1048576) {
                $extensionAllowUpload = in_array($extension, $allowedExts);
                if ($extensionAllowUpload) {
                    if (is_uploaded_file($_FILES['Filedata']['tmp_name'])) {
                        if ($_FILES['Filedata']['error'] > 0) {
                            echo __("Return Error Code: ") . $_FILES['Filedata']['error'] . "<br>";
                        } else {
                            $path = 'files/history_barracks/';
                            if (!file_exists($path)) {
                                mkdir($path, 0777, true);
                            }
                            $uploadSuccess = move_uploaded_file($_FILES['Filedata']['tmp_name'], $path . $code . '.' . $extension);
                            $filename = $code . '.' . $extension;
                            if ($uploadSuccess) {
                                $key = $code;

                                // Save file data to table
                                $document = array();

                                $created = date('Y-m-d H:i:s');
                                $updated = date('Y-m-d H:i:s');
                                $created_by = 2; //$currentUser['AuthUser']['id'];
                                $updated_by = 2; //$currentUser['AuthUser']['id'];

                                $document_id = $this->Generator->getID();
                                $document['id'] = $document_id;

                                $document['file_table_name'] = 'HistoryBarracks';
                                $document['file_table_key'] = $pk_id;

                                $document['file_name'] = $filename;
                                $document['file_type'] = $file_type;
                                $document['file_size'] = $original_size;
                                $document['file_key'] = $key;
                                $document['file_path'] = $path;
                                $document['file_original_name'] = $original_name;

                                $document['created'] = $created;
                                $document['updated'] = $updated;
                                $document['deleted'] = 'N';
                                $document['created_by'] = $created_by;
                                $document['updated_by'] = $updated_by;

                                $this->TableAttachFile->create();
                                $this->TableAttachFile->save($document);

                                $response[] = array('result' => 'success', 'document_id' => $document_id, 'document_original_name' => $document['file_original_name'], 'document_name' => $filename, 'key' => $key);
                            } else {
                                echo '-1';
                                $result = false;
                            }
                        }
                    }
                } else {
                    $result = false;
                    $response[] = array('result' => 'error', 'detail' => 'ไม่รองรับไฟล์นามสกุล .' . $extension);
                }
            } else {
                $result = false;
                $response[] = array('result' => 'error', 'detail' => 'ขนาดไฟล์ Upload เกิน 5 Mb');
            }
        }

        echo json_encode($response);
    }

    public function removeDocument($doc_id) {
        $this->layout = 'blank';
        $this->autoRender = false;
        $this->disableCache();
        $data = $this->request->data;

        if (!empty($data)) {

            $data = array();
            $data['TableAttachFile']['id'] = $doc_id;
            $data['TableAttachFile']['deleted'] = 'Y';

            $status = $this->TableAttachFile->save($data) ? 'SUCCESS' : 'FAILED';

            echo json_encode(array('status' => $status, 'id' => $doc_id, 'message' => 'ลบเอกสารเรียบร้อย'));
        }
    }

}

?>