<?php
App::uses('AppController', 'Controller');

class ModelDocumentsController extends AppController {

	public $name = 'ModelDocuments';
	public $uses = array('ModelDocument','ModelCategory');
	//public $uses = array('ModelRate','ModelType','ModelStatus','ModelCommand','ModelProperty','ModelEquipment','ModelDivision','ModelPosition','Organization','OrganizationModel','Equipment','Corp','Rank');
	public $components = array("FileStorageComponent","Generator");

	function beforeFilter(){
		$currentUser = $this->Session->check('AuthUser');
		if(empty($currentUser)){
			$this->Session->delete('AuthUser');
			$this->Session->destroy();

			$url = Configure::read('Application.Domain').'Logins';
			$this->redirect($url);
		}
	}

	public function index() {
           
	}

	public function detailModelDocument($id = null) {

		$whereConditions = array();
		$whereConditions[] = "model_id = '".$id."'";
		$whereConditions['deleted'] = 'N';
		$conditions = array(
							'order' =>  array('model_category_id' => 'asc','id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelDocuments = $this->ModelDocument->find('all',$conditions);

		$this->set('ModelDocuments',$ModelDocuments);

	}

	public function upload($model_id=null,$model_category_id=null){

		$this->layout = 'blank';
		$this->autoRender = false;

		//$posts = $this->request->data;
		//pr($this->request->data);
		//pr($model_id);
		//pr($model_category_id);
		//pr($_FILES);
		
		//echo 'Upload OK';
		//array[Filedata] = array(
		//	[name] => 'xxx.jpg',
		//	[type] => 'image/jpeg',
		//	[tmp_name] => 'D:\cc\tmp\phpxxxx.tmp',
		//	[error] => 0,
		//	[size]=> xxxxx
		//)
		
		$response = array();
		 
		if(!empty($_FILES)){
			$original_name = $_FILES['Filedata']['name'];
			$file_type = $_FILES['Filedata']['type'];
			$original_size = $_FILES['Filedata']['size'];
			$code = String::uuid();
			$allowedExts = array('doc', 'docx', 'txt', 'pdf', 'jpg', 'jpeg', 'png', 'gif', 'xls', 'xlsx', 'ppt', 'pptx', 'bmp', 'zip', 'swf');
			$receieve_error = explode(".", $original_name);
			$extension = strtolower(end($receieve_error));
			if(is_uploaded_file($_FILES['Filedata']['tmp_name']) && in_array($extension, $allowedExts)) { 
				if ($_FILES['Filedata']['error'] > 0) {
					echo __("Return Error Code: ") . $_FILES['Filedata']['error'] . "<br>";
				}else { 
					$path = 'files/';
					if(!file_exists($path)) {
							mkdir($path, 0777, true);
					}
					$uploadSuccess = move_uploaded_file($_FILES['Filedata']['tmp_name'], $path . $code . '.' . $extension);
					$filename = $code . '.' . $extension;
					if ($uploadSuccess) {
						 $key = $this->FileStorageComponent->save($path, $code . '.' . $extension, $file_type);
						 //pr($key);

						 $result = true;
						 if ($result) {

								$currentUser = $this->Session->read('AuthUser');
								$user_id = $currentUser['User']['id'];

								$document = array();
								//$created = date('Y-m-d H:i:s');
								//$updated = date('Y-m-d H:i:s');
								$created_by = $user_id;
								$updated_by = $user_id;
									
								$document_id = $this->Generator->getID();
								$document['id'] = $document_id;
								$document['model_category_id'] = $model_category_id;
								$document['model_id'] = $model_id;
								$document['path'] = $path;
								$document['content_type'] = $file_type;
								$document['file_size'] = $original_size;
								$document['original_name'] = $original_name;
								$document['key'] = $key;
								//$document['created'] = $created;
								//$document['updated'] = $updated;
								$document['created_by'] = $created_by;
								$document['updated_by'] = $updated_by;
								$document['name'] = $original_name;

								$this->ModelDocument->create();
								$this->ModelDocument->save($document);
								
								$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
								$ModelCategorys = $this->ModelCategory->find('list',$conditions);
							 
								$response[] = array( 'id' => $document['id'],'model_category_id' => $model_category_id ,'model_category_name' => $ModelCategorys[$model_category_id],'document_id' => $document_id, 'name' => $document['name'] ,'document_key' => $key);
						 }
					}else{
						echo '-1';
						$result = false;
					}
				}                         
			} 
		}// end if

		/*
		if($result) $this->redirect('../Accounts/detail/'.$account_id);
		else { echo "<script>alert(\"Upload Failed. Please try again.\");</script>"; $this->redirect('../Accounts/detail/'.$account_id);}
		*/
		echo json_encode($response);

	}

	public function removeDocument() {

		$this->layout = 'blank';
		$this->autoRender = false;
		$this->disableCache();
		$data = $this->request->data;

		if(!empty($data)){

			$document_id = $data['document_id'];

			$data = array();
			$data['ModelDocument']['id'] = $document_id;
			$data['ModelDocument']['deleted'] = 'Y';

			$status = $this->ModelDocument->save($data) ? 'SUCCESS' : 'FAILED'; 

			echo json_encode(array('status' => $status,'id' => $document_id,'message' => 'ลบเอกสารเรียบร้อย'));

		}
         
	}

}
?>