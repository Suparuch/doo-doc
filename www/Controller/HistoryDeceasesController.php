<?php

App::uses('AppController', 'Controller');

class HistoryDeceasesController extends AppController {

    public $name = 'HistoryDeceases';
    public $uses = array('HistoryDecease', 'Rank', 'TableAttachFile');
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
                'order' => array('id' => 'desc'),
                'conditions' => $whereConditions
            );
            $total = $this->HistoryDecease->find('count', $conditions);
            $HistoryDeceases = $this->HistoryDecease->find('all', $conditions);
        } else {

            $default = array();
            $default = $dataRequest;
            $this->set('default', $default);

            // intitial
            $whereConditions = array();
            $whereConditions['deleted'] = 'N';

            $offset = $dataRequest['offset'];

            // Search condition
            // 
            if (!empty($dataRequest['txtHdFirstname'])) {
                $whereConditions[] = '(HistoryDecease.hd_firstname like \'%' . trim($dataRequest['txtHdFirstname']) . '%\' )';
            }
            if (!empty($dataRequest['txtHdLastname'])) {
                $whereConditions[] = '(HistoryDecease.hd_lastname like \'%' . trim($dataRequest['txtHdLastname']) . '%\' )';
            }
            if (!empty($dataRequest['txtHdClosetNo'])) {
                $whereConditions[] = '(HistoryDecease.hd_closet_no like \'%' . trim($dataRequest['txtHdClosetNo']) . '%\' )';
            }
            if (!empty($dataRequest['txtHdBookNo'])) {
                $whereConditions[] = '(HistoryDecease.hd_book_no like \'%' . trim($dataRequest['txtHdBookNo']) . '%\' )';
            }
            if (!empty($dataRequest['ddlRank'])) {
                $whereConditions[] = '(HistoryDecease.hd_rank_id = \'' . trim($dataRequest['ddlRank']) . '\' )';
            }

            $conditions = array('limit' => $this->Generator->setLimit(), 'offset' => $offset,
                'order' => array('id' => 'desc'),
                'conditions' => $whereConditions
            );

            // Query
            $total = $this->HistoryDecease->find('count', array('conditions' => $whereConditions));
            $HistoryDeceases = $this->HistoryDecease->find('all', $conditions);
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
        $Ranks = $this->Rank->find('list', $conditions);

        // Set model to view
        $this->set('Ranks', $Ranks);
        $this->set('HistoryDeceases', $HistoryDeceases);
        $pagination = array('offset' => $offset, 'total' => $total, 'limit' => $this->Generator->setLimit(), 'model' => 'HistoryDecease', 'pages' => 5);
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
            $HistoryDeceases = $this->HistoryDecease->find('all', $conditions);

            foreach ($HistoryDeceases[0]['HistoryDecease'] as $key => $value)
                $default[$key] = $value;

            //$this->set('default', $default);
            $default['action'] = 'EDIT';
        } else {
            $default['action'] = 'ADD';
        }
        $this->set('default', $default);

        $conditions = array();
        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
        $Ranks = $this->Rank->find('list', $conditions);
        
        // Year born
        $years_born = Array();
        for ($i = 200; $i >= 0; $i--) {
            array_push($years_born, ((date('Y') + 543)-10) - $i);
        }
        arsort($years_born);
        $this->set('Years_Born',$years_born);
        
        // Year dead
        $years_dead = Array();
        for ($i = 200; $i >= 0; $i--) {
            array_push($years_dead, ((date('Y') + 543)) - $i);
        }
        arsort($years_dead);
        $this->set('Years_Dead',$years_dead);
        

        $whereConditions = array();
        $whereConditions['deleted'] = 'N';
        $whereConditions['file_table_name'] = 'HistoryDeceases';
        $whereConditions['file_table_key'] = $default['id'];
        $conditions = array('limit' => $this->Generator->setLimit(),
            'order' => array('id' => 'asc'),
            'conditions' => $whereConditions
        );
        $TableAttachFiles = $this->TableAttachFile->find('all', $conditions);

        // Set model to view
        $this->set('Ranks', $Ranks);
        $this->set('TableAttachFiles', $TableAttachFiles);
    }

    public function save($id = null, $formAction = "EDIT") {
        Configure::write('debug', 2);
        $this->autoRender = false;
        $data = $this->request->data;

        if (!empty($data)) {
            if (!empty($id)) {
                $this->HistoryDecease->id = $id;
                if ($formAction == "ADD") {
                    $data['id'] = $id;
                    $this->HistoryDecease->create();
                }
                $status = $this->HistoryDecease->save($data) ? 'SUCCESS' : 'FAILED';
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
                $this->HistoryDecease->id = $id;
                if ($this->HistoryDecease->exists())
                    $status = $this->HistoryDecease->save($data) ? 'SUCCESS' : 'FAILED';
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
                        $path = 'files/history_deceases/';
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

                            $document['file_table_name'] = 'HistoryDeceases';
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
                    $response[] = array('result' => 'error', 'detail' => 'ไม่รองรับไฟล์นามสกุล .'.$extension);                    
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