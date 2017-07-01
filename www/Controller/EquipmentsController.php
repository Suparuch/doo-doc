<?php
App::uses('AppController', 'Controller');

class EquipmentsController extends AppController {

	public $name = 'Equipments';
	public $uses = array('Equipment','Tech','ExplanationDocument');
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
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$dataRequest = $this->request->data;
		if(empty($dataRequest)){
			$offset = 0;
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';            
			$conditions = array('limit' =>   $this->Generator->setLimit(),
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$total = $this->Equipment->find('count',$conditions);
			$Equipments = $this->Equipment->find('all',$conditions); 
  
							 
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);
			//intitial
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];

			$tech_id = $dataRequest['tech_id'];
			$code = $dataRequest['code'];
			$name = $dataRequest['name'];

			if(!empty($tech_id))
			$whereConditions[] = "tech_id = '".$tech_id."'";

			if(!empty($code))
			$whereConditions[] = 'code ILIKE \'%'.$code.'%\'';

			if(!empty($name))
			$whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
			
			$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   ); 
			$total = $this->Equipment->find('count', array('conditions' => $whereConditions ));
			$Equipments = $this->Equipment->find('all',$conditions); 

		}              

		$breadcrumb = array (   'controller' => array(   
								'name' => 'ข้อมูลยุทโธปกรณ์' ,
								'url' => ''
								)
		);

		$conditions = array();
		$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longNameList', 'cacheConfig' => 'long');
		$Techs = $this->Tech->find('list',$conditions);
				
		$conditions = array();
		$conditions = array('conditions' => array('deleted' => 'N','explanation_type' => 'equipment'));
		$ExplanationDocuments = $this->ExplanationDocument->find('first',$conditions);

		$this->set('breadcrumb',$breadcrumb);
		$this->set('Techs',$Techs);
		$this->set('ExplanationDocuments',$ExplanationDocuments);
		$this->set('Equipments',$Equipments);  
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'Equipment','pages' => 5);
		$this->set('pagination',$pagination);                    
	}

	public function form($id = null) {
		$this->layout = 'blank';
		$default = array();
		if(!empty($id)){
			
				$whereConditions = array();
				$whereCOnditions['deleted'] = 'N';
				$whereConditions['id'] = $id;
				$conditions = array('limit' =>  '1',
									'order' =>  array('name' => 'asc'),
									'conditions' => $whereConditions
								   );
				$Equipments = $this->Equipment->find('all',$conditions);  
				
				foreach($Equipments[0]['Equipment'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}	

	}       
        
	public function save($id=null) {
		$this->autoRender = false;
		 
		$data = $this->request->data;

		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->Equipment->id = $id;
				if($this->Equipment->exists())
				$status = $this->Equipment->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{

				$data['id'] = $this->Generator->getID(); 
				$this->Equipment->create();
				$status = $this->Equipment->save($data) ? 'SUCCESS' : 'FAILED';
			}
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));	
	}
        
        
	public function delete() {
            
		$this->autoRender = false;     
		$status = '';
		
		$ids = array();
		$ids = $this->request->data['ids']; 
	   
		foreach($ids as $id){

			if(!empty($id)){

				$data = array();
				$data['deleted'] = "Y";
				$this->Equipment->id = $id;
				if($this->Equipment->exists())
				$status = $this->Equipment->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
		   
		}                    
		
		echo json_encode(array('status' => $status));
	}

	public function upload($explanation_type=null){

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

								$document = array();
								//$created = date('Y-m-d H:i:s');
								//$updated = date('Y-m-d H:i:s');
								$created_by = 2; //$currentUser['AuthUser']['id'];
								$updated_by = 2; //$currentUser['AuthUser']['id'];	
									
								$document_id = $this->Generator->getID();
								$document['id'] = $document_id;
								$document['path'] = $path;
								$document['content_type'] = $file_type;
								$document['file_size'] = $original_size;
								$document['original_name'] = $original_name;
								$document['key'] = $key;
								//$document['created'] = $created;
								//$document['updated'] = $updated;
								$document['created_by'] = $created_by;
								$document['updated_by'] = $updated_by;
								$document['explanation_type'] = $explanation_type;
								$document['name'] = $original_name;

								$this->ExplanationDocument->create();
								$this->ExplanationDocument->save($document);
															 
								$response[] = array( 'document_id' => $document_id, 'document_name' => $document['name'] ,'document_key' => $key);
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
			$data['ExplanationDocument']['id'] = $document_id;
			$data['ExplanationDocument']['deleted'] = 'Y';

			$status = $this->ExplanationDocument->save($data) ? 'SUCCESS' : 'FAILED'; 

			echo json_encode(array('status' => $status,'id' => $document_id,'message' => 'ลบเอกสารเรียบร้อย'));

		}
         
	}

	public function uploadPhoto($equipment_id=null){

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

								$document = array();
								//$created = date('Y-m-d H:i:s');
								//$updated = date('Y-m-d H:i:s');
								$created_by = 2; //$currentUser['AuthUser']['id'];
								$updated_by = 2; //$currentUser['AuthUser']['id'];	
									
								//$document_id = $this->Generator->getID();
								$document['id'] = $equipment_id;
								$document['path'] = $path;
								$document['image_type'] = $file_type;
								$document['image_size'] = $original_size;
								$document['original_name'] = $original_name;
								$document['image_key'] = $key;
								//$document['created'] = $created;
								//$document['updated'] = $updated;
								$document['created_by'] = $created_by;
								$document['updated_by'] = $updated_by;
								$document['image_name'] = $original_name;

								//$this->Equipment->create();
								$this->Equipment->save($document);
															 
								$response[] = array( 'document_id' => $equipment_id, 'document_name' => $document['image_name'] ,'document_key' => $key);
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
        
}
?>