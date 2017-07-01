<?php
App::uses('AppController', 'Controller');

class PdxHistoryController extends AppController {

	public $name = 'PdxHistory';
	public $uses = array('Document','DocumentGroup');
	public $components = array("FileStorageComponent","Generator");
	public $file_path = "../webroot/files/edocument";
	public $secrete =  array(9=>'ไม่ระบุ',1=>'ลับ',2=>'ลับมาก',3=>'ลับที่สุด');
	public $fast =  array(9=>'ไม่ระบุ',1=>'ด่วน',2=>'ด่วนมาก',3=>'ด่วนที่สุด',4=>'ด่วนภายใน');
	function beforeFilter(){
		$currentUser = $this->Session->check('AuthUser');
		if(empty($currentUser)){
			$this->Session->delete('AuthUser');
			$this->Session->destroy();

			$url = Configure::read('Application.Domain').'Logins';
			$this->redirect($url);
		}
	}

	public function index($corp_id=null) {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$dataRequest = $this->request->data;
		if(empty($dataRequest) && isset($_POST) && count($_POST)>0){
			$dataRequest = $_POST;
		}
		if(empty($dataRequest)){
			$offset = 0;
			$whereConditions = array();
			$whereConditions['deleted'] = 'N';
			$whereConditions['corp_id'] = $corp_id;
			$conditions = array('limit' =>  '20',
								'order' =>  array('id' => 'desc'),
								'conditions' => $whereConditions
							   );
			$documents = $this->Document->find('all',$conditions);
			$total = $this->Document->find('count',$conditions);
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);                      
			//intitia

			$whereConditions = array();
			$whereCOnditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$name = $dataRequest['name_th'];
			$code = $dataRequest['code'];
			$date = $dataRequest['date'];
			$status = $dataRequest['status'];
			$fast = $dataRequest['fast'];

			
			if(!empty($name))
				$whereConditions[] = ' (name_en ILIKE \'%'.$name.'%\' OR name_th ILIKE \'%'.$name.'%\' ) ';
			if(!empty($code))
				$whereConditions[] = 'code ILIKE \'%'.$code.'%\'  ';
			if(!empty($date))
				$whereConditions[] = 'book_date ILIKE \'%'.$date.'%\' ';
			if(!empty($status))
				$whereConditions[] = 'secrete = \''.$status.'\' ';
			if(!empty($fast))
				$whereConditions[] = 'fast = \''.$fast.'\' ';
		
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('id' => 'desc'),
								'conditions' => $whereConditions
							   );
			$documents = $this->Document->find('all',$conditions); 
			$total = $this->Document->find('count', array('conditions' => $whereConditions ));              
		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ประวัติกำลังพล' ,
								'url' => ''
								)
		);
$conditions = array('conditions' => array('deleted' => 'N'), 'fields' => array('id', 'name_th'), 'cache' => 'longShortNameList', 'cacheConfig' => 'long');
$DocumentGroup = $this->DocumentGroup->find('list',$conditions); 
          $this->set('DocumentGroup',$DocumentGroup);  
		$this->set('breadcrumb',$breadcrumb);         
		$this->set('corp_id',$corp_id);
		$this->set('document',$documents);
		$this->set('secrete',$this->secrete);
		$this->set('fast',$this->fast);
		$this->set('dataRequest',$dataRequest);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'document','pages' => 5);
		$this->set('pagination',$pagination);                 
	}

	public function form($corp_id=null,$id = null) {
		$this->layout = 'blank';
		$default = array();
		if(!empty($id)){
			
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				$whereConditions['id'] = $id;
				$conditions = array('limit' =>  '1',
									'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   );
				$document = $this->Document->find('all',$conditions);  
				
				foreach($document[0]['Document'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}else{
			$default['code'] = '';
			$default['name_en'] = '';
			$default['name_th'] = '';
			$default['description'] = '';
			$default['corp_id'] = $corp_id;
			$default['book_date '] ='';
			$default['keyword '] = '';
			$default['fast'] = '';
			$this->set('default',$default);
		}
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$whereConditions['corp_id'] = $corp_id;
		$conditions = array(
							'fields' => array('id','code'),
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$DocumentGroup = $this->DocumentGroup->find('list',$conditions); 
		  $this->set('corp_id',$corp_id); 
		   $this->set('secrete',$this->secrete);
		   $this->set('fast',$this->fast);
          $this->set('DocumentGroup',$DocumentGroup);  
	}     
	
	public function formgroup($corp_id = null,$id=null) {
		$this->layout = 'blank';
		$default = array();
		
		if(!empty($id)){
			
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				$whereConditions['id'] = $id;
				$conditions = array('limit' =>  '1',
									'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   );
				$document_category = $this->DocumentGroup->find('all',$conditions);  
				if($document_category!=null){
				foreach($document_category[0]['DocumentGroup'] as $key => $value)
					$default[$key] = $value;
				}
				$this->set('default',$default);
				
			
		}else{
				
		  	$default['code'] = '';
			$default['name_en'] = '';
			$default['name_th'] = '';
			$default['description'] = '';
			$default['corp_id'] = $corp_id;
			$this->set("default",$default);
		}
	
		$this->set("corp_id",$corp_id);
	}  
        
	public function savegroup($corp_id = null,$id=null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		
		if(!empty($data)){    
		
			if(!empty($id)){
				
				$this->DocumentGroup->id = $id;
				if($this->DocumentGroup->exists())
				$status = $this->DocumentGroup->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    
				
			}else{
					$sql = "SELECT order_sort + 1 as new_order_sort  FROM document_groups WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
					$results = $this->DocumentGroup->query($sql);   
					if(!$results)
						$data['order_sort'] =0;                     
					else
						 $data['order_sort'] = $results[0][0]['new_order_sort']; 
					$data['id'] = $this->Generator->getID(); 
					
					$this->DocumentGroup->create();
					$status = $this->DocumentGroup->save($data) ? 'SUCCESS' : 'FAILED';                                      
			}
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));
	}	
		
	public function save($corp_id = null,$id = null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		if(isset($_POST['data']))
			$data = $_POST['data'];
	//	print_r($_FILES);
		//print_r($data);
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->Document->id = $id;
				if($this->Document->exists()){
					
					if(isset($_FILES['data']) && $_FILES['data']['name']['file']!="")
					{
						$dir = $this->file_path . "/" . $data['corp_id'];
						//echo $dir;
						if (!file_exists($dir) && !is_dir($dir)) {
							mkdir($dir);         
						} 
						$dir2 = $dir . "/" . $data['document_group'];
						if (!file_exists($dir2) && !is_dir($dir2)) {
							mkdir($dir2);         
						}
						$tmp_name =  $_FILES['data']['tmp_name']['file'];
						$file_name = $_FILES['data']['name']['file'];
						$file_name = str_replace(" ","",$file_name);
						copy($tmp_name,$dir2 . "/" . $file_name ) ;
						$data['file_name'] =$file_name;
					}
					
					$status = $this->Document->save($data) ? 'SUCCESS' : 'FAILED'; 
				}
				else $status = 'FAILED';    
				
			}else{
					$sql = "SELECT order_sort + 1 as new_order_sort  FROM document WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
					$results = $this->Document->query($sql);   
					if(!$results)
						$data['order_sort'] =0;                     
					else
						 $data['order_sort'] = $results[0][0]['new_order_sort'];        
					$data['deleted']='N';
					$data['id'] = $this->Generator->getID(); 
					$this->Document->create();
					$file_name = "";
					if(isset($_FILES['data']) && $_FILES['data']['name']['file']!="")
					{
						$dir = $this->file_path . "/" . $data['corp_id'];
						//echo $dir;
						if (!file_exists($dir) && !is_dir($dir)) {
							mkdir($dir);         
						} 
						$dir2 = $dir . "/" . $data['document_group'];
						if (!file_exists($dir2) && !is_dir($dir2)) {
							mkdir($dir2);         
						}
						$tmp_name =  $_FILES['data']['tmp_name']['file'];
						copy($tmp_name,$dir2 . "/" . $_FILES['data']['name']['file']);
						$data['file_name'] =$_FILES['data']['name']['file'];
						
					}
					$status = $this->Document->save($data) ? 'SUCCESS' : 'FAILED';  
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
				$this->Document->id = $id;
				if($this->Document->exists())
				$status = $this->Document->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}
	public function delete_group($id=null) {
            
		$this->autoRender = false;  
		$status = '';		
			if(!empty($id)){

				$data = array();
				$data['deleted'] = "Y";
				$this->DocumentGroup->id = $id;
				if($this->DocumentGroup->exists())
					$status = $this->DocumentGroup->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		
					
		echo json_encode(array('status' => $status));
	}
}
?>