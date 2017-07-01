<?php

App::uses('AppController', 'Controller');

class MuseumCollectionsController extends AppController {

    public $name = 'MuseumCollections';
    public $uses = array('MuseumCollection', 'Museum', 'TableAttachFile');
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
        //Configure::write('debug', 2);  //***ปิดไว้ เพราะมีปัญหาเรื่อง autocomplete
        //$this->layout = 'blank';
        //$this->autoRender = false;

        $dataRequest = $this->request->data;

        if (empty($dataRequest)) {
            $offset = 0;
            $whereConditions = array();
            $whereConditions['deleted'] = 'N';
            //$whereConditions[] = "secret = '0'";
            $conditions = array('limit' => $this->Generator->setLimit(),
                'order' => array('id' => 'desc'),
                'conditions' => $whereConditions
            );
            $total = $this->MuseumCollection->find('count', $conditions);
            $MuseumCollections = $this->MuseumCollection->find('all', $conditions);
        } else {

            $default = array();
            $default = $dataRequest;
            $this->set('default', $default);

            // intitial
            $whereConditions = array();
            $whereConditions['deleted'] = 'N';

            $offset = $dataRequest['offset'];

            // Search condition
            if (!empty($dataRequest['txtMcNo'])) {
                $whereConditions[] = '(MuseumCollection.mc_no like \'%' . trim($dataRequest['txtMcNo']) . '%\' )';
            }
            if (!empty($dataRequest['txtMcOldNo'])) {
                $whereConditions[] = '(MuseumCollection.mc_old_no like \'%' . trim($dataRequest['txtMcOldNo']) . '%\' )';
            }
            if (!empty($dataRequest['txtMcName'])) {
                $whereConditions[] = '(MuseumCollection.mc_name like \'%' . trim($dataRequest['txtMcName']) . '%\' )';
            }
            if (!empty($dataRequest['txtMuseum'])) {
                $whereConditions[] = '(MuseumCollection.mc_museum like \'%' . trim($dataRequest['txtMuseum']) . '%\' )';
            }
            /*if (!empty($dataRequest['ddlMuseum'])) {
              $whereConditions[] = '(MuseumCollection.mc_museum = \'' . trim($dataRequest['ddlMuseum']) . '\' )';
            }*/ 
            if ($dataRequest['ddlMcCondition'] != "") {
                $whereConditions[] = '(MuseumCollection.mc_condition = \'' . trim($dataRequest['ddlMcCondition']) . '\' )';
            }
            if (isset($dataRequest['chkMcCondition']) && $dataRequest['chkMcCondition'] == "1") {
                $whereConditions[] = '(MuseumCollection.mc_borrow_status = \'1\' )';
            }

            $conditions = array('limit' => $this->Generator->setLimit(), 'offset' => $offset,
                'order' => array('id' => 'desc'),
                'conditions' => $whereConditions
            );

            // Query
            $total = $this->MuseumCollection->find('count', array('conditions' => $whereConditions));
            $MuseumCollections = $this->MuseumCollection->find('all', $conditions);
        }

        // Set breadcrumb
        $breadcrumb = array(
            'controller' => array(
                'name' => 'ระบบงานประวัติศาสตร์และพิพิธภัณฑ์ทหาร',
                'url' => '',
                'subtitle' => 'วัตถุพิพิธภัณฑ์'
            ),
        );
        $this->set('breadcrumb', $breadcrumb);

        $conditions = array();
        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'm_name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
        $Museums = $this->Museum->find('list', $conditions);
        $this->set('Museums', $Museums);
        
        $MuseumNames = $this->MuseumCollection->find('all', array('fields' => array('DISTINCT mc_museum'),
            'order' => array('mc_museum' => 'asc'),
            'conditions' => array('deleted' => 'N')));
        $this->set('MuseumNames', $MuseumNames);
        
        $this->set('MuseumCollections', $MuseumCollections);
        $pagination = array('offset' => $offset, 'total' => $total, 'limit' => $this->Generator->setLimit(), 'model' => 'MuseumCollection', 'pages' => 5);
        $this->set('pagination', $pagination);
    }

    public function form($id = null) {
        //Configure::write('debug', 2);  //***ปิดไว้ เพราะมีปัญหาเรื่อง autocomplete

        $this->layout = 'blank';
        $default = array();
        $default['id'] = $this->Generator->getID();

        /* $default = array();
          if (!empty($id)) {
          $whereConditions = array();
          $whereCOnditions['deleted'] = 'N';
          $whereConditions['id'] = $id;
          $conditions = array('limit' => '1',
          'order' => array('mc_no' => 'asc'),
          'conditions' => $whereConditions
          );
          $MuseumCollections = $this->MuseumCollection->find('all', $conditions);

          foreach ($MuseumCollections[0]['MuseumCollection'] as $key => $value)
          $default[$key] = $value;

          $this->set('default', $default);
          }

          $conditions = array();
          $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'm_name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
          $Museums = $this->Museum->find('list', $conditions);

          // Set model to view
          $this->set('Museums', $Museums); */

        if (!empty($id)) {
            $whereConditions = array();
            $whereConditions['deleted'] = 'N';
            $whereConditions['id'] = $id;
            $conditions = array('limit' => '1',
                'order' => array('id' => 'asc'),
                'conditions' => $whereConditions
            );
            $MuseumCollections = $this->MuseumCollection->find('all', $conditions);

            foreach ($MuseumCollections[0]['MuseumCollection'] as $key => $value)
                $default[$key] = $value;

            //$this->set('default', $default);
            $default['action'] = 'EDIT';
        } else {
            $default['action'] = 'ADD';
        }
        $this->set('default', $default);

        $conditions = array();
        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'm_name'), 'cache' => 'longNameList', 'cacheConfig' => 'long');
        $Museums = $this->Museum->find('list', $conditions);
        $this->set('Museums', $Museums);

        $whereConditions = array();
        $whereConditions['deleted'] = 'N';
        $whereConditions['file_table_name'] = 'MuseumCollections';
        $whereConditions['file_table_key'] = $default['id'];
        $conditions = array('limit' => $this->Generator->setLimit(),
            'order' => array('id' => 'asc'),
            'conditions' => $whereConditions
        );
        $TableAttachFiles = $this->TableAttachFile->find('all', $conditions);

        // Set model to view
        $this->set('TableAttachFiles', $TableAttachFiles);
    }

    public function save($id = null, $formAction = "EDIT") {
        Configure::write('debug', 2);
        $this->autoRender = false;
        $data = $this->request->data;

        if (!empty($data)) {
            if (!empty($id)) {
                $this->MuseumCollection->id = $id;
                if ($formAction == "ADD") {
                    $data['id'] = $id;
                    $this->MuseumCollection->create();
                }
                $status = $this->MuseumCollection->save($data) ? 'SUCCESS' : 'FAILED';
            }
        } else
            $status = 'FAILED';

        echo json_encode(array('status' => $status));

        /* if (!empty($data)) {
          if (!empty($id)) {
          $this->MuseumCollection->id = $id;
          if ($this->MuseumCollection->exists())
          $status = $this->MuseumCollection->save($data) ? 'SUCCESS' : 'FAILED';
          else
          $status = 'FAILED';
          }else {
          $data['id'] = $this->Generator->getID();
          $this->MuseumCollection->create();
          $status = $this->MuseumCollection->save($data) ? 'SUCCESS' : 'FAILED';
          }
          } else
          $status = 'FAILED';

          echo json_encode(array('status' => $status)); */
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
                $this->MuseumCollection->id = $id;
                if ($this->MuseumCollection->exists())
                    $status = $this->MuseumCollection->save($data) ? 'SUCCESS' : 'FAILED';
                else
                    $status = 'FAILED';
            } else
                $status = 'FAILED';
        }

        echo json_encode(array('status' => $status));
    }

    public function formConRptMuseumCollection() {
        //Configure::write('debug', 2); //***ปิดไว้ เพราะมีปัญหาเรื่อง autocomplete

        $conditions = array();

        $conditions = array('conditions' => array('deleted' => 'N'),
            'order' => array('order_sort' => 'asc'),
            'fields' => array('id', 'm_name'),
            'cache' => 'longNameList',
            'cacheConfig' => 'long');
        //$Museums = $this->Museum->find('list', $conditions);


        $Museums = $this->MuseumCollection->find('all', array('fields' => array('DISTINCT mc_museum'),
            'order' => array('mc_museum' => 'asc'),
            'conditions' => array('deleted' => 'N')));

        // Set model to view
        $this->set('Museums', $Museums);

        $this->layout = 'blank';
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
            $allowedExts = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
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
                            $path = 'files/museum_collections/';
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

                                $document['file_table_name'] = 'MuseumCollections';
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

    public function printMuseumCollectionReport($museum_name = null) {
        Configure::write('debug', 2);

        $this->layout = 'blank';

        // Museum
        $this->set('Museum', $museum_name);

        // Condition
        //
        $whereConditions = array();
        $whereConditions['deleted'] = 'N';
        //$whereConditions[] = "mc_m_id = '" . $museum_id . "'";
        $whereConditions[] = "mc_museum = '" . $museum_name . "'";

        $conditions = array('limit' => '999999',
            'order' => array('id' => 'asc'),
            'conditions' => $whereConditions
        );

        $MuseumCollections = $this->MuseumCollection->find('all', $conditions);
        $this->set('MuseumCollections', $MuseumCollections);
    }

    public function printItemCard($id = null) {
        Configure::write('debug', 2);

        $this->layout = 'blank';

        if (!empty($id)) {
            $whereConditions = array();
            $whereCOnditions['deleted'] = 'N';
            $whereConditions['id'] = $id;
            $conditions = array('limit' => '1',
                'order' => array('mc_no' => 'asc'),
                'conditions' => $whereConditions
            );
            $MuseumCollections = $this->MuseumCollection->find('all', $conditions);

            foreach ($MuseumCollections[0]['MuseumCollection'] as $key => $value)
                $default[$key] = $value;

            $this->set('default', $default);
        }

//        $Museum = $this->Museum->findById($default["mc_m_id"]);
//        $name = $Museum["Museum"]["m_name"];
//        $this->set('mc_museum_name', $name);

        $conditions = array();
        $whereConditions = array();
        $whereConditions['deleted'] = 'N';
        $whereConditions['file_table_name'] = 'MuseumCollections';
        $whereConditions['file_table_key'] = $default['id'];
        $conditions = array('limit' => $this->Generator->setLimit(),
            'order' => array('id' => 'asc'),
            'conditions' => $whereConditions
        );
        $TableAttachFiles = $this->TableAttachFile->find('all', $conditions);
        $this->set('TableAttachFiles', $TableAttachFiles);
    }

    // Save การตั้ง/ยกเลิก ภาพปก
    public function setCover($val, $fileID) {
        Configure::write('debug', 2);
        $this->autoRender = false;
        $data = $this->request->data;

        if (!empty($data)) {
            if (!empty($fileID)) {
                $this->MuseumCollection->id = $id;
                if ($formAction == "ADD") {
                    $data['id'] = $id;
                    $this->MuseumCollection->create();
                }
                $status = $this->MuseumCollection->save($data) ? 'SUCCESS' : 'FAILED';
            }
        } else
            $status = 'FAILED'; // SUCCESS

        echo json_encode(array('status' => $status));
    }
    
    // --- Auto Complete : Museum Name -----------------------------
    
    public function autoComplete() {
        Configure::write('debug', 2);
        $this->autoRender = false;

        $museums = $this->MuseumCollection->find('all', array('fields' => array('DISTINCT mc_museum'),
            'order' => array('mc_museum' => 'asc'),
            'conditions' => array('deleted' => 'N', 'MuseumCollection.mc_museum LIKE' => '%' . $_GET['term'] . '%')));
        
        echo json_encode($this->_encode($museums));
    }
    
    private function _encode($postData) {
        $temp = array();
        foreach ($postData as $post) {
            array_push($temp, array(
            'id' => $post['MuseumCollection']['mc_museum'],
            'label' => $post['MuseumCollection']['mc_museum'],
            'value' => $post['MuseumCollection']['mc_museum'],
            ));
        }
        return $temp;
    }
    
    public function typeahead_search() {
        $this->autoRender = false;
        $this->RequestHandler->respondAs('json');

        // get the search term from URL
        $term = $this->request->query['q'];

        $museums = $this->MuseumCollection->find('all', array('fields' => array('DISTINCT mc_museum'),
            'order' => array('mc_museum' => 'asc'),
            'conditions' => array('deleted' => 'N', 'MuseumCollection.mc_museum LIKE' => '%' . $term . '%')));
        

        // Format the result for select2
        $result = array();
        foreach($museums as $key => $museum) {
            array_push($result, $museum['MuseumCollection']['mc_museum']);
        }
        $museums = $result;
        
        echo json_encode($museums);
    }
    

}

?>