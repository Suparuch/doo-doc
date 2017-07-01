<?php
App::uses('AppController', 'Controller');

class DocumentController extends AppController {

	public $name = 'Document';
	public $uses = array('Document','DocumentGroup','PdxReport','DocumentFlow','DocumentFile','User','Unit');
	public $components = array("FileStorageComponent","Generator");
	public $file_path = "../webroot/files/documentflow";
	public $secrete =  array(9=>'-',1=>'ลับ',2=>'ลับมาก',3=>'ลับที่สุด');
	public $fast =  array(9=>'-',1=>'ด่วน',2=>'ด่วนมาก',3=>'ด่วนที่สุด',4=>'ด่วนภายใน');
	public $position = array(1=>'เจ้ากรม',2=>'ผอ.สำนัก');
	public $th_short_month = array('1'=>'ม.ค.','2'=>'ก.พ.','3'=>'มี.ค.','4'=>'เม.ย.','5'=>'พ.ค.','6'=>'มิ.ย.','7'=>'ก.ค.','8'=>'ส.ค.','9'=>'ก.ย.','10'=>'ต.ค.','11'=>'พ.ย.','12'=>'ธ.ค.');
	function beforeFilter(){
		$currentUser = $this->Session->check('AuthUser');
		if(empty($currentUser)){
			$this->Session->delete('AuthUser');
			$this->Session->destroy();

			$url = Configure::read('Application.Domain').'Logins';
			$this->redirect($url);
		}
	}

function getCurrentUser() {

	  // for CakePHP 2.x:
	  App::uses('CakeSession', 'Model/Datasource');
	  $session = new CakeSession();

	  $user = $session->read('AuthUser');

	  return $user;
	}
	
	public function showmenu($type=null)
	{
		$breadcrumb = array (   'controller' => array(   
								'name' => '<a href="/Document/mainmenu"> ขั้นตอนหนังสือ ออก</a>' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);   
	}
	
	public function mainmenu($type=null)
	{
		
	}
	
	public function index($corp_id=null) {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$users = $this->getCurrentUser();
		
		$offset =0;
		
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							//'order' =>  array('order_sort' => 'asc'),
							'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ขั้นตอนการรับหนังสือเข้า' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);    
		
		
		$whereConditions = array();
		
		$whereConditions['status'] = 9;
		$conditions = array('limit' => 5,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document_return = $this->DocumentFlow->find('all',$conditions);       

		$whereConditions = array();
		$unit_level = $users['Unit']['level'];
		if($unit_level==3){
				$whereConditions['to_unit'] = $user['User']['unit_id'];
		}
		
		//$whereConditions['corp_id'] = $corp_id;
		$whereConditions[] = 'status < 100';
		$conditions = array('limit' => 5,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document = $this->DocumentFlow->find('all',$conditions);  
			$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions )); 
		$pagination = array('offset' => 0 , 'total' => $total , 'limit' => 5, 'model' => 'DocumentFlow','pages' => 5);
		$this->set('pagination',$pagination);  
		$this->set('secrete',$this->secrete);
		   $this->set('fast',$this->fast);    
		   $this->set('document',$document);   
		    $this->set('document_return',$document_return);    
		   $this->set('units',$Units);   
		   $this->set('month',$this->th_short_month);   
		   $this->set('users',$users);
	}
	
	public function index3($corp_id=null) {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$AuthUser = $this->Session->Read('AuthUser');
		$users = $this->getCurrentUser();
		
		$offset =0;
		
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							//'order' =>  array('order_sort' => 'asc'),
							'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ขั้นตอนการรับหนังสือเข้า' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);    
		
		
		$whereConditions = array();
		$whereConditions['created_unit'] = $AuthUser['User']['unit_id'];
		$whereConditions['status'] = 9;
		$conditions = array('limit' => 5,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document_return = $this->DocumentFlow->find('all',$conditions);       

		$whereConditions = array();
		$unit_level = $users['Unit']['level'];
		if($unit_level==3){
				$whereConditions['to_unit'] = $user['User']['unit_id'];
		}
		
		//$whereConditions['corp_id'] = $corp_id;
		$whereConditions['created_unit'] = $AuthUser['User']['unit_id'];
		$whereConditions[] = 'status < 100';
		$conditions = array('limit' => 5,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document = $this->DocumentFlow->find('all',$conditions);  
			$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions )); 
		$pagination = array('offset' => 0 , 'total' => $total , 'limit' => 5, 'model' => 'DocumentFlow','pages' => 5);
		$this->set('pagination',$pagination);  
		$this->set('secrete',$this->secrete);
		   $this->set('fast',$this->fast);    
		   $this->set('document',$document);   
		    $this->set('document_return',$document_return);    
		   $this->set('units',$Units);   
		   $this->set('month',$this->th_short_month);   
		   $this->set('users',$users);
	}
	
	public function index2($corp_id=null) {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$AuthUser = $this->Session->Read('AuthUser');
		$user_id = $AuthUser['User']['id'];
		$unit_id = $AuthUser['User']['unit_id'];
		$users = $this->getCurrentUser();
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
		$act = "staff";

		$type = "P";
		$follow = "";
		if(isset($_REQUEST['follow']))
			$follow= $_REQUEST['follow'];
		if(isset($_REQUEST['type']))
			$type= $_REQUEST['type'];
		
		if(isset($_REQUEST['act']))
			$act = $_REQUEST['act'];
		$user = $this->getCurrentUser();
		$user_id = $user["User"]["id"];
		$dataRequest = $this->request->data;
		if(empty($dataRequest) && isset($_POST) && count($_POST)>0){
			$dataRequest = $_POST;
		}
		if(empty($dataRequest)){
			$offset = 0;
		}else{
			$offset = $dataRequest['offset'];
		}
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ระบบงานสารบรรณ' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);         

		$whereConditions = array();
		$order  = array('status'=>'asc','id' => 'desc');
		$unit_level = $users['Unit']['level'];
	//	if($unit_level==3){
	//			$whereConditions['to_unit'] = $user['User']['unit_id'];
	//	}
	$whereConditions[] = " (to_unit='" . $user['User']['unit_id'] . "' or created_unit='" . $user['User']['unit_id'] . "' or worker='" . $user['Unit']['short_name'] . "' )";
			
		$whereConditions['deleted'] = 'N';
		if(isset($_REQUEST['act']) && $_REQUEST['act']=="staff")
		{
			if($type=="P")
				$whereConditions[] = " (status=0) ";
			if($type=="R")
				$whereConditions[] = " (status =1) ";
			if($type=="A")
				$whereConditions[] = " (status =1 or status=0  or status=9) ";
			if($type=="C")
				$whereConditions[] = " (status =9) ";
			if($type=="D")
				$whereConditions[] = " (status =9999) ";	

			$view = "../Elements/Component/document/indexviewstaff";
		}
		
		if(isset($_REQUEST['act']) && $_REQUEST['act']=="staffdoc")
		{
			if(isset($_GET['secrete']) && $_GET['secrete']=="N")
				$whereConditions[] = " (secrete= 9 or secrete=1) ";	
			else
				$whereConditions[] = " (secrete<> 9 and secrete<>1) ";	
			$whereConditions[] = " (created_unit ='$unit_id') ";	
			$order = array('id' => 'desc');
			$view = "../Elements/Component/document/indexviewstaffdoc";
		}
		
		if(isset($_REQUEST['act']) && $_REQUEST['act']=="director")
		{
			if($type=="P")
				$whereConditions[] = " (status=1) ";
			if($type=="R")
				$whereConditions[] = " (status =2) ";
			if($type=="A")
				$whereConditions[] = " (status =1 or status=2 or status=4 ) ";
			if($type=="S")
				$whereConditions[] = " (status =4) ";
			$view = "../Elements/Component/document/indexviewstaff";
		}
		if(isset($_REQUEST['act']) && $_REQUEST['act']=="assist")
		{
			$whereConditions[] = " (assign_to='$user_id') ";
			if($type=="P")
				$whereConditions[] = " (status=4) ";
			if($type=="R")
				$whereConditions[] = " (status =5) ";
			if($type=="A")
				$whereConditions[] = " (status =4 or status=5) ";
			
			
		}
		
		if(isset($_REQUEST['act']) && $_REQUEST['act']=="codirector")
		{
			/*
			if($type=="P")
				$whereConditions[] = " (status=100) ";
			if($type=="R")
				$whereConditions[] = " (status =101) ";
			if($type=="A")
				$whereConditions[] = " (status =102 or status=101 or status=100 ) ";
			if($type=="S")
				$whereConditions[] = " (status =103) ";
			if(isset($_REQUEST['follow'])){
				$whereConditions[] = " concat(year,'/',order_sort) like '%" . $_REQUEST['follow'] . "%'";
			}
			 * */
			 $whereConditions[] = " (status=99) ";
		}
		
		if(isset($_REQUEST['act']) && $_REQUEST['act']=="viewer")
		{
			if($type=="P")
				$whereConditions[] = " (status=100) ";
			if($type=="R")
				$whereConditions[] = " (status =101) ";
			if($type=="A")
				$whereConditions[] = " (status =102 or status=101 or status=100 ) ";
			if($type=="S")
				$whereConditions[] = " (status =103) ";
			if(isset($_REQUEST['follow'])){
				$whereConditions[] = " concat(year,'/',order_sort) like '%" . $_REQUEST['follow'] . "%'";
			}
		}
		//print_r($whereConditions);
		
		$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
							'order' =>  $order,
							'conditions' => $whereConditions
						   ); 
		$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions ));  			
		$document = $this->DocumentFlow->find('all',$conditions);  
		
	
		
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' =>  $this->Generator->setLimit(), 'model' => 'PdxReport','pages' => 5);
		$this->set('pagination',$pagination);  
		$this->set('secrete',$this->secrete);
	   $this->set('fast',$this->fast);    
	   $this->set('document',$document);  
	   
	   $this->set('type',$type); 
	   $this->set('follow',$follow); 
	   
	   $whereConditions = array();
	   $whereConditions['"User"."unit_id"'] = $corp_id;
	   
		$whereConditions['"User"."deleted"'] = 'N';
		$conditions = array(//'limit' =>  '20',
							'order' =>  array('"Rank"."order_sort"' => 'asc','"User"."id"' => 'asc'),
							'conditions' => $whereConditions,
							'recursive' => 1,
						
						   );
		$users = $this->User->find('all',$conditions);
		
		
		
		$this->set('users',$users);


		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							'order' =>  array('id' => 'desc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		$this->set("units",$Units);

	   if($act=="staff")
	   		$this->render("../Elements/Component/document/indexviewstaff");   
	   	if($act=="staffdoc")
	   		$this->render("../Elements/Component/document/indexviewstaffdoc");   
	   if($act=="director")
	   		$this->render("../Elements/Component/document/indexviewdirector");
		 if($act=="codirector")
	   		$this->render("../Elements/Component/document/indexviewcodirector");
	   if($act=="assist")   
	   		$this->render("../Elements/Component/document/indexviewassist");  
		if($act=="viewer")
	   		$this->render("../Elements/Component/document/indexviewviewer");
          
	}
	
public function indexwaiting($type_id=null) {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		
		$offset = 0;
		$AuthUser = $this->Session->Read('AuthUser');
		$user_id = $AuthUser['User']['id'];
		$users = $this->getCurrentUser();
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
		$act = "staff";

		$type = "P";
		$follow = "";
		if(isset($_REQUEST['follow']))
			$follow= $_REQUEST['follow'];
		if(isset($_REQUEST['type']))
			$type= $_REQUEST['type'];
		
		if(isset($_REQUEST['act']))
			$act = $_REQUEST['act'];
		$user = $this->getCurrentUser();
		$user_id = $user["User"]["id"];
		$dataRequest = $this->request->data;
		if(empty($dataRequest) && isset($_POST) && count($_POST)>0){
			$offset = $dataRequest['offset'];
			$dataRequest = $_POST;
		}
		
		if(empty($dataRequest)){
			$offset = 0;
		}else{
			$offset = $dataRequest['offset'];
		}
		$breadcrumb = array (   'controller' => array(   
								'name' => '<a href="/Document/mainmenu"> ขั้นตอนหนังสือ ออก</a>' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);         

		$whereConditions = array();
		
		$unit_level = $users['Unit']['level'];
		if($unit_level==3){
				$whereConditions[] = "(to_unit='"  . $user['User']['unit_id'] . "' or created_unit='" .$user['User']['unit_id']. "' or corp_id='" .$user['User']['unit_id']. "')"  ;
		}
		
		$whereConditions['deleted'] = 'N';
		
		
		if($type_id!="0" && $type_id!='')
		{
			$whereConditions[] = " (outtype = $type_id) ";
			if($type=="P")
				$whereConditions[] = " (status = $type_id" . "001) ";
			if($type=="R")
				$whereConditions[] = " (status =$type_id" . "002) ";
			if($type=="A")
				$whereConditions[] = " (status =$type_id" . "003 or status=$type_id" . "002 or status=$type_id" . "001 ) ";
			if($type=="S")
				$whereConditions[] = " (status =$type_id" . "004) ";
			if(isset($_REQUEST['follow'])){
				$whereConditions[] = " concat(year,'/',order_sort) like '%" . $_REQUEST['follow'] . "%'";
			}
		}else{
			$whereConditions[] = " (outtype >0) ";
		}
		
		
		
		$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
							'order' =>  array('id'=>'desc','status'=>'asc'),
							'conditions' => $whereConditions
						   ); 
		$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions ));  			
		$document = $this->DocumentFlow->find('all',$conditions);  
		
	
		
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' =>  $this->Generator->setLimit(), 'model' => 'DocumentFlow','pages' => 5);
		$this->set('pagination',$pagination);  
		$this->set('secrete',$this->secrete);
	   $this->set('fast',$this->fast);    
	   $this->set('document',$document);  
	   
	   $this->set('type',$type); 
	   $this->set('type_id',$type_id); 
	   $this->set('follow',$follow); 
	
	   $whereConditions = array();
	   $whereConditions['"User"."unit_id"'] = $corp_id;
		$whereConditions['"User"."deleted"'] = 'N';
		$conditions = array(//'limit' =>  '20',
							'order' =>  array('"Rank"."order_sort"' => 'asc','"User"."id"' => 'asc'),
							'conditions' => $whereConditions,
							'recursive' => 1,
						
						   );
		$users = $this->User->find('all',$conditions);
		
		
		
		$this->set('users',$users);


		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		$this->set("units",$Units);

	   	//	$this->render("../Elements/Component/document/indexviewwaiting");   
}
          
public function indexsearch($type_id=null) {
		//$this->layout = 'blank';
		//$this->autoRender = false;
		$AuthUser = $this->Session->Read('AuthUser');
		$user_id = $AuthUser['User']['id'];
		$users = $this->getCurrentUser();
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
		$act = "staff";

		$type = "P";
		$follow = "";
		if(isset($_REQUEST['follow']))
			$follow= $_REQUEST['follow'];
		if(isset($_REQUEST['type']))
			$type= $_REQUEST['type'];
		
		if(isset($_REQUEST['act']))
			$act = $_REQUEST['act'];
		$user = $this->getCurrentUser();
		$user_id = $user["User"]["id"];
		$dataRequest = $this->request->data;
		if(empty($dataRequest) && isset($_POST) && count($_POST)>0){
			$dataRequest = $_POST;
		}
		
		if(empty($dataRequest)){
			$offset = 0;
		}else{
			$offset = $dataRequest['offset'];
		}
		$breadcrumb = array (   'controller' => array(   
								'name' => '<a href="/Document/mainmenu"> ขั้นตอนการรับหนังสือ ออก</a>' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);         

		$whereConditions = array();
		
		
		
		
		
		/*
		if($type_id!="0")
		{
			
			if($type=="P")
				$whereConditions[] = " (status = $type_id" . "001) ";
			if($type=="R")
				$whereConditions[] = " (status =$type_id" . "002) ";
			if($type=="A")
				$whereConditions[] = " (status =$type_id" . "003 or status=$type_id" . "002 or status=$type_id" . "001 ) ";
			if($type=="S")
				$whereConditions[] = " (status =$type_id" . "004) ";
			if(isset($_REQUEST['follow'])){
				$whereConditions[] = " concat(year,'/',order_sort) like '%" . $_REQUEST['follow'] . "%'";
			}
		}
		*/
		
		$whereConditions = array();
		$unit_level = $users['Unit']['level'];
		/*
		if($unit_level==3){
				$whereConditions['to_unit'] = $user['User']['unit_id'];
		}
		*/
		$whereConditions[] = " (to_unit='" . $user['User']['unit_id'] . "' or created_unit='" . $user['User']['unit_id'] . "' or worker='" . $user['Unit']['short_name'] . "' )";
		
		 if(isset($_POST['follow'])&&$_POST['follow']!="")
		 	$whereConditions[] = " concat(year,'/',order_sort) like '%" . $_REQUEST['follow'] . "%'";
		if(isset($_POST['code'])&&$_POST['code']!="")
		 	$whereConditions[] = " code like '%" . $_REQUEST['code'] . "%'";
		 if(isset($_POST['name'])&&$_POST['name']!="")
		 	$whereConditions[] = " name_th like '%" . $_REQUEST['name'] . "%'";
		 if(isset($_POST['unit'])&&$_POST['unit']!=""){
		 	$un = $_POST['unit'];
			$xwhereConditions = array();
			$xwhereConditions[] = " short_name='$un'";
			$xwhereConditions[] = " deleted='N'";
			$conditions = array(//'limit' =>  '20',
						'order' =>  array('"order_sort"' => 'asc'),
						'conditions' => $xwhereConditions,
						'recursive' => 1,
							
							   );
			$unit = $this->Unit->find('all',$conditions);
			$org_code = $unit[0]['Unit']['org_code'];
		 	$whereConditions[] = " code like '%" . $org_code . "%'";
		 }
		  if(isset($_POST['sd']))
		  {
		  	$sd = $_POST['sd'];
		  	$sdate = sprintf('%04d-%02d-%02d', $sd['year'], $sd['month'], $sd['day']);
		  	$whereConditions[] = " to_date(book_date, 'DD/MM/YYYY') >= '" . $sdate . "'";
		  }
		  if(isset($_POST['ed']))
		  {
		  	$ed = $_POST['ed'];
		  	$edate = sprintf('%04d-%02d-%02d', $ed['year'], $ed['month'], $ed['day']);
		  	$whereConditions[] = " to_date(book_date, 'DD/MM/YYYY') <= '" . $edate . "'";
		  }
		
		$whereConditions['deleted'] = 'N';
		/*if($type=="P")
			$whereConditions[] = " (status=0) ";
		if($type=="R")
			$whereConditions[] = " (status =1) ";
		if($type=="A")
			$whereConditions[] = " (status =1 or status=0  or status=9) ";
		if($type=="C")
			$whereConditions[] = " (status =9) ";
		if($type=="D")
			$whereConditions[] = " (status =9999) ";	
		 * */
		$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
							'order' =>  array('status'=>'asc','created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
		$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions ));  			
		$document = $this->DocumentFlow->find('all',$conditions);  
		
		
		
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' =>  $this->Generator->setLimit(), 'model' => 'PdxReport','pages' => 5);
		$this->set('pagination',$pagination);  
		$this->set('secrete',$this->secrete);
	   $this->set('fast',$this->fast);    
	   $this->set('document',$document);  
	   
	   $this->set('type',$type); 
	   $this->set('type_id',$type_id); 
	   $this->set('follow',$follow); 
	$this->set('month',$this->th_short_month);    
	   $whereConditions = array();
	   $whereConditions['"User"."unit_id"'] = $corp_id;
		$whereConditions['"User"."deleted"'] = 'N';
		$conditions = array(//'limit' =>  '20',
							'order' =>  array('"Rank"."order_sort"' => 'asc','"User"."id"' => 'asc'),
							'conditions' => $whereConditions,
							'recursive' => 1,
						
						   );
		$users = $this->User->find('all',$conditions);
		
		
		
		$this->set('users',$users);


		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		$this->set("units",$Units);

	   		$this->render("../Elements/Component/document/indexviewsearch");   
}

	public function getChildData($id,$c_no=0){
			$whereConditions = array();
	
			$whereConditions['parent_id'] = $id;
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('id' => 'desc'),
								'conditions' => $whereConditions
							   ); 
							
	 		$pdxreportx = $this->PdxReport->find('all', array('conditions' => $whereConditions ));     
			foreach($pdxreportx as $row){
				$pdxreport[] = $row;
				$whereConditions['parent_id'] = $id;
				$total = $this->PdxReport->find('count', array('conditions' => $whereConditions )); 
				if($total>0){
					$c_no++;
					$child = $this->getChildData($row['PdxReport']['id'],$c_no);
					if(count($child)>0){
						foreach($child as $r){
							$rr = $r;
							$rr['PdxReport']['unit'] = " - " . $rr['PdxReport']['unit'];
							$pdxreport[] = $rr;
						}
					}
				}else{
					$c_no = 0;
				}
				
			}
			
			/*
			$child = $this->getChildData($row['PdxReport']['id']);
			if(count($child)>0)
			{
				foreach($child as $row2){
					$r = $row2;
					$r['PdxReport']['unit'] = " |_ 1 -" .$row['PdxReport']['id'] . $r['PdxReport']['unit'];
					$pdxreport[] = $r;
				}
			}
			*/
			return $pdxreport;
	}
	public function outbox($type=null,$corp_id = null)
	{
		
		
		$offset =0;
		
		
		$sql = "SELECT running + 1 as new_order_sort  FROM document_dept where running is not null and year='" . (date("Y")+543) . "' and status>=100 order by order_sort desc LIMIT 1;";
		$results = $this->DocumentFlow->query($sql);   
		 
		$running = 0;
		if(!$results)
			$running =1;                     
		else
			$running = $results[0][0]['new_order_sort'];   
		
		$default['code'] =  $_SESSION['AuthUser']['Unit']['org_code'] . '.' . $running;
		
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		
		$breadcrumb = array (   'controller' => array(   
								'name' => '<a href="/Document/mainmenu"> ขั้นตอนการรับหนังสือ ออก</a>' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);         

		$whereConditions = array();
		
		$whereConditions['outtype'] = $type;
		$conditions = array('limit' => 5,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document = $this->DocumentFlow->find('all',$conditions);  
			$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions )); 
		$pagination = array('offset' => 0 , 'total' => $total , 'limit' => 5, 'model' => 'DocumentFlow','pages' => 5);
		$this->set('pagination',$pagination);  
		$this->set('secrete',$this->secrete);
		$this->set('default',$default);
		   $this->set('fast',$this->fast);    
		   $this->set('document',$document);     
		   $this->set('units',$Units);   
		   $this->set('month',$this->th_short_month);    
		   $this->set('position',$this->position);
		   $this->set('type',$type);
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
	
	public function assignform($corp_id=null){
		
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
			
		$whereConditions['"User"."unit_id"'] = $corp_id;
		$whereConditions['"User"."deleted"'] = 'N';
		$conditions = array(//'limit' =>  '20',
							'order' =>  array('"Rank"."order_sort"' => 'asc','"User"."id"' => 'asc'),
							'conditions' => $whereConditions,
							'recursive' => 1,
						
						   );
		$users = $this->User->find('all',$conditions);
		
		$this->layout = 'blank';
		$this->set('users',$users);
	}
	
	public function returnform($id=null,$corp_id=null){
		
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
			
		
		$this->set('corp_id',$corp_id);
		$this->set('id',$id);
		$this->layout = 'blank';
	
	}
	public function remarkform($id=null,$corp_id=null,$remark=null){
		
		$AuthUser = $this->Session->Read('AuthUser');
		$users = $this->getCurrentUser();
		
		$offset =0;
		
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							//'order' =>  array('order_sort' => 'asc'),
							'order' =>  array('id' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ขั้นตอนการรับหนังสือเข้า' ,
								'url' => ''
								));
	
		$this->set('breadcrumb',$breadcrumb);    
		
		
		$whereConditions = array();
		$whereConditions['created_unit'] = $AuthUser['User']['unit_id'];
		$whereConditions['status'] = 9;
		$conditions = array('limit' => 5,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document_return = $this->DocumentFlow->find('all',$conditions);       

		$whereConditions = array();
		$unit_level = $users['Unit']['level'];
		if($unit_level==3){
				$whereConditions['to_unit'] = $user['User']['unit_id'];
		}
		
		//$whereConditions['corp_id'] = $corp_id;
		$whereConditions['created_unit'] = $AuthUser['User']['unit_id'];
		$whereConditions[] = 'status < 100';
		$conditions = array('limit' => 5,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document = $this->DocumentFlow->find('all',$conditions);  
			$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions )); 
		$pagination = array('offset' => 0 , 'total' => $total , 'limit' => 5, 'model' => 'DocumentFlow','pages' => 5);
		
		if(!empty($id)){
			
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				$whereConditions['id'] = $id;
				$conditions = array('limit' =>  '1',
									'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   );
				$document = $this->DocumentFlow->find('all',$conditions);  
				
				foreach($document[0]['DocumentFlow'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}
		
		$this->set('pagination',$pagination);  
		$this->set('secrete',$this->secrete);
		   $this->set('fast',$this->fast);    
		   $this->set('document',$document);   
		    $this->set('document_return',$document_return);    
		   $this->set('units',$Units);   
		   $this->set('month',$this->th_short_month);   
		   $this->set('users',$users);
		$this->layout = 'blank';
	
	}
	
	public function returndocform($id=null,$type_id=null){
		
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
			
		
		$sql = "SELECT running + 1 as new_order_sort  FROM document_dept where running is not null and year='" . (date("Y")+543) . "' and status>=100 order by order_sort desc LIMIT 1;";
		$results = $this->DocumentFlow->query($sql);   
		 
		$running = 0;
		if(!$results)
			$running =1;                     
		else
			$running = $results[0][0]['new_order_sort'];   
		
		$default['code'] =  $_SESSION['AuthUser']['Unit']['org_code'] . '.' . $running;
		
		$this->set('corp_id',$corp_id);
		$this->set('id',$id);
		$this->set('type_id',$type_id);
		
		$this->layout = 'blank';
		$this->set('default',$default);
		 $this->set('month',$this->th_short_month);    
		$this->render("../Elements/Component/document/returndocform");   
	
	}
	
	public function broadcast($id=null){
		
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
			
			
		$sql = "SELECT * FROM units where  unit_type_id='1' order by order_sort desc";
		$unit1 = $this->Unit->query($sql);   	
	
			
		$sql = "SELECT * FROM units where unit_type_id='2' order by order_sort desc";
		$unit2 = $this->Unit->query($sql);   
		
		$sql = "SELECT * FROM units where  unit_type_id='3' order by order_sort desc";
		$unit3 = $this->Unit->query($sql);   	
			
		
		$sql = "SELECT running + 1 as new_order_sort  FROM document_dept where running is not null and year='" . (date("Y")+543) . "' and status>=100 order by order_sort desc LIMIT 1;";
		$results = $this->DocumentFlow->query($sql);   
		 
		$running = 0;
		if(!$results)
			$running =1;                     
		else
			$running = $results[0][0]['new_order_sort'];   
		
		$default['code'] =  $_SESSION['AuthUser']['Unit']['org_code'] . '.' . $running;
		
		$this->set('corp_id',$corp_id);
		$this->set('id',$id);
		$this->set('unit1',$unit1);
		$this->set('unit2',$unit2);
		$this->set('unit3',$unit3);
		//$this->set('type_id',$type_id);
		
		$this->layout = 'blank';
		$this->set('default',$default);
		 $this->set('month',$this->th_short_month);    
		$this->render("../Elements/Component/document/broadcast");   
	
	}
	
	public function showunit($id=null){
		
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
			
			
		$sql = "SELECT * FROM units where  unit_type_id='1' order by order_sort desc";
		$unit1 = $this->Unit->query($sql);   	
	
			
		$sql = "SELECT * FROM units where unit_type_id='2' order by order_sort desc";
		$unit2 = $this->Unit->query($sql);   
		
		$sql = "SELECT * FROM units where  unit_type_id='3' order by order_sort desc";
		$unit3 = $this->Unit->query($sql);   	
			
		
		$sql = "SELECT running + 1 as new_order_sort  FROM document_dept where running is not null and year='" . (date("Y")+543) . "' and status>=100 order by order_sort desc LIMIT 1;";
		$results = $this->DocumentFlow->query($sql);   
		 
		$running = 0;
		if(!$results)
			$running =1;                     
		else
			$running = $results[0][0]['new_order_sort'];   
		
		$default['code'] =  $_SESSION['AuthUser']['Unit']['org_code'] . '.' . $running;
		
		$this->set('corp_id',$corp_id);
		$this->set('id',$id);
		$this->set('unit1',$unit1);
		$this->set('unit2',$unit2);
		$this->set('unit3',$unit3);
		//$this->set('type_id',$type_id);
		
		$this->layout = 'blank';
		$this->set('default',$default);
		 $this->set('month',$this->th_short_month);    
		$this->render("../Elements/Component/document/showunit");   
	
	}
	
	public function changeUnits($id=null,$corp_id=null){
		
		if(!isset($corp_id) || $corp_id == null || $corp_id==0)
			$corp_id = '150120103629101691';
			
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		
		$conditions = array(//'limit' =>  '20',
							'fields' => array('id','short_name'),
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$Units = $this->Unit->find('list',$conditions);
		$this->set('units',$Units);
		$this->set('corp_id',$corp_id);
		$this->set('id',$id);
		$this->layout = 'blank';
	
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
	
	public function getdocref($corp_id = null,$id=null) {
		$this->layout = 'blank';
		$default = array();
		$AuthUser = $this->Session->Read('AuthUser');
		$unit_id = $AuthUser['User']['unit_id'];
		$whereConditions['to_unit'] = $unit_id;
		$offset = 0;
		$conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
							'order' =>  array('status'=>'asc','created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
		$total = $this->DocumentFlow->find('count', array('conditions' => $whereConditions ));  			
		$document = $this->DocumentFlow->find('all',$conditions);  
		
	//	echo $this->DocumentFlow->getLastQuery();
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' =>  $this->Generator->setLimit(), 'model' => 'PdxReport','pages' => 5);
		$this->set('pagination',$pagination);  
	
		$this->set("document",$document);
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
	
	public function assign($corp_id = null,$id=null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		if(empty($data))
			$data = $_REQUEST;

		if(!empty($data)){    
			$id = $data['doc_id'];
			if(!empty($id)){
				
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists()){
					$data['DocumentFlow']['status'] = 4;
					$data['DocumentFlow']['assign_to'] = $_REQUEST['assign_to'];
					$data['DocumentFlow']['assign_remark'] = $_REQUEST['assign_remark'];
					//print_r($data);
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED'; 
				}else $status = 'FAILED';    
				
			}else $status = 'FAILED'; 
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));
	}
	
	public function saveboardcast($corp_id = null,$id=null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		if(empty($data))
			$data = $_REQUEST;

		if(!empty($data)){    
		//	$id = $data['doc_id'];
			if(!empty($id)){
				
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists()){
					$data['DocumentFlow']['status'] = 0;
				/*	$data['DocumentFlow']['assign_to'] = $_REQUEST['assign_to'];
					$data['DocumentFlow']['assign_remark'] = $_REQUEST['assign_remark'];*/
					//print_r($data);
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED'; 
				}else $status = 'FAILED';    
				
			}else $status = 'FAILED'; 
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));
	}
	
	public function save_unit($id=null,$corp_id = null) {
		$this->autoRender = false;
		$data = $this->request->data;    
		if(empty($data))
			$data = $_REQUEST;
	
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists()){
					$data['DocumentFlow']['status'] = 0;
					$data['DocumentFlow']['to_unit'] = $data['to_unit'];
					//print_r($data);
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED'; 
				}else $status = 'FAILED';    
				
			}else $status = 'FAILED'; 
		
		}else $status = 'FAILED';

		echo json_encode(array('status' => $status));
	}
	
	public function savereturn($id=null,$corp_id = null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		
		$AuthUser = $this->Session->Read('AuthUser');
$user_id = $AuthUser['User']['id'];
		if(empty($data))
			$data = $_REQUEST;
		
		if(!empty($data)){    
			$id = $data['id'];
			if(!empty($id)){
				
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists()){
					$data['DocumentFlow']['id'] = $id;
					$data['DocumentFlow']['status'] = 9;
					$data['DocumentFlow']['return_date'] = date("Y-m-d H:i:s");
					$data['DocumentFlow']['return_by'] = $user_id;
					$data['DocumentFlow']['return_remark'] = $_REQUEST['remark'];
			
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED NOT SAVE'; 
				}else $status = 'FAILED NOT EXISTS';    
				
			}else $status = 'FAILED NOT ID'; 
		
		}else $status = 'FAILED NOT DATA';

		echo json_encode(array('status' => $status));
	}
	
	public function savereturndoc($id=null,$type_id = null){
            
		$this->autoRender = false;
		$data = $this->request->data;    
		
		$AuthUser = $this->Session->Read('AuthUser');
		$user_id = $AuthUser['User']['id'];
		if(empty($data))
			$data = $_REQUEST;
		
		if(!empty($data)){    
			$id = $data['id'];
			if(!empty($id)){
				
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists()){
					$data['DocumentFlow']['id'] = $id;
					if($type_id=="2" || $type_id=="3")
						$data['DocumentFlow']['status'] = 99;	
					else
						$data['DocumentFlow']['status'] = $type_id . "002";
			
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED NOT SAVE'; 
				}else $status = 'FAILED NOT EXISTS';    
				
			}else $status = 'FAILED NOT ID'; 
		
		}else $status = 'FAILED NOT DATA';

		echo json_encode(array('status' => $status));
	}
		
	public function save($corp_id = null,$id = null){
            
		$this->autoRender = false;
		$data = $this->request->data;   
		$bdate = $_REQUEST['bookdate'];
		$book_date= $bdate['day'] . '/' .  $bdate['month'] . '/' . $bdate['year']; 
		if(isset($_POST['data']))
			$data = $_POST['data'];
			
		$data['book_date'] = $book_date;
		
		if(isset($_REQUEST['book_type'])){
				$data['book_type'] = $_REQUEST['book_type'];
		}
		if(isset($_REQUEST['to'])){
				$data['to'] = $_REQUEST['to'];
		}
		if(isset($_REQUEST['book_type'])){
				$data['book_type'] = $_REQUEST['book_type'];
		}
		if(isset($_REQUEST['bt'])){
			if($_REQUEST['bt']=="n")
				$data['book_send_type'] = 1;
			else
				$data['book_send_type']=2;
		}
		
		if(isset($_REQUEST['from'])){
				$data['from'] = $_REQUEST['from'];
		}
		if(isset($_REQUEST['unit'])){
				$data['worker'] = $_REQUEST['unit'];
		}
				//die($book_date);
		$AuthUser = $this->Session->Read('AuthUser');
		$data['created_unit'] = $AuthUser['User']['unit_id'];
		
		$data['corp_id'] = 1;
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->DocumentFlow->id = $id;
				
				if($this->DocumentFlow->exists()){
					
					
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED'; 
					
					$this->saveDocument($_FILES['data'],$id,$data['corp_id']);
					
					//header("location:/Document/");
				}
				else $status = 'FAILED';    
				
			}else{
					$condi='';
					if($data['secrete']=="9" || $data['secrete'] == "1")
						$condi .= " and (secrete=9 or secrete=1)";
					else
						$condi .= " and (secrete<>9 and secrete<>1)";
					$sql = "SELECT running + 1 as new_running  FROM document_dept WHERE running <> 99 $condi order by running desc LIMIT 1;";
					$results = $this->DocumentFlow->query($sql);  
					 
					if(!$results)
						$data['running'] =0;                     
					else
						 $data['running'] = $results[0][0]['new_running'];  
					
					if(isset($data['book_type'])){
					
					$condi = "";
					$condi .= " and book_type='" . $data['book_type'] . "'";
					
					if($data['secrete']=="9" || $data['secrete'] == "1")
						$condi .= " and (secrete=9 or secrete=1)";
					else
						$condi .= " and (secrete<>9 and secrete<>1)";
						
					$sql = "SELECT sub_running + 1 as new_running  FROM document_dept WHERE sub_running <> 99 $condi order by sub_running desc LIMIT 1;";
					//die($sql);
					$results = $this->DocumentFlow->query($sql);   
					if(!$results)
						$data['sub_running'] =1;                     
					else
						 $data['sub_running'] = $results[0][0]['new_running'];  
					}
						       
					$data['deleted']='N';
					$data['id'] = $this->Generator->getID(); 
					$this->DocumentFlow->create();
					$file_name = "";
					
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED';  
					if(isset($_FILES['data']))
						$this->saveDocument($_FILES['data'],$data['id'],$data['corp_id']);
					//header("location:/Document/");
			}
		
		}else $status = 'FAILED';
		$doc_level = $AuthUser['User']['doc_level'];
			if($doc_level=="X")
			{
				header("location:/Document/index3");
				//$url = "../Document/index3";
			}else{
header("location:/Document/");
}
exit;

		echo json_encode(array('status' => $status));
	}
	
	public function saveoutbox($type_id){
            
		$AuthUser = $this->Session->Read('AuthUser');

		$this->autoRender = false;
		$data = $this->request->data;   
		if(count($data)<=0)
			$data = $_REQUEST['data'];
			
		
		$bdate = $_REQUEST['bookdate'];
		$book_date= $bdate['day'] . '/' .  $bdate['month'] . '/' . $bdate['year']; 
		if(isset($_POST['data']))
			$data['DocumentFlow']=$_REQUEST['data'];
			
		$data['DocumentFlow']['book_date'] = $book_date;

		
		$data['DocumentFlow']['corp_id'] = $AuthUser['User']['unit_id'];
		
		if(!empty($data)){    
			
			if(!empty($id)){
				
				$this->DocumentFlow->id = $id;
				
				if($this->DocumentFlow->exists()){
					
					//$data['DocumentFlow']=$_REQUEST['data'];
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED'; 
					
					$this->saveDocument($_FILES['data'],$id,$data['corp_id']);
					header("location:/Document/outbox/" . $type_id);
				}
				else $status = 'FAILED';    
				
			}else{
					$sql = "SELECT order_sort + 1 as new_order_sort  FROM document_dept where order_sort is not null and year='" . (date("Y")+543) . "' and status>=100 order by order_sort desc LIMIT 1;";
					$results = $this->DocumentFlow->query($sql);   
					 
					if(!$results)
						$data['DocumentFlow']['order_sort'] =1;                     
					else
						 $data['DocumentFlow']['order_sort'] = $results[0][0]['new_order_sort'];    
					$data['DocumentFlow']['deleted']='N';    
					$data['DocumentFlow']['name_th']=$_REQUEST['data']['name_th'];
					if($type_id==1){
						$data['DocumentFlow']['to_unit'] = $AuthUser['User']['unit_id'];
						$data['DocumentFlow']['status'] = "99";
					}else{
						$data['DocumentFlow']['status'] = $type_id . "001";
					}
					
					$data['DocumentFlow']['outtype'] = $type_id;
					$data['DocumentFlow']['doc_ref'] = isset($_REQUEST['data']['doc_ref'])?$_REQUEST['data']['doc_ref']:"";
					$data['DocumentFlow']['year'] = $bdate['year'];
					
					$data['DocumentFlow']['id'] = $this->Generator->getID(); 
					
					if(isset($_REQUEST['doc_level']) && $_REQUEST['doc_level']=="2" )
						$data['doc_level'] = "2";
					else{
						unset($data['code']);
						$data['doc_level'] = "1";
					}
						
					
					$this->DocumentFlow->create();
					$file_name = "";
					
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED';  
					if(isset($_FILES['data']))
						$this->saveDocument($_FILES['data'],$data['DocumentFlow']['id'],$data['DocumentFlow']['corp_id']);
					header("location:/Document/outbox/" . $type_id);
					
			}
		
		}else $status = 'FAILED';
header("location:/Document/outbox/" . $type_id);
exit;

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
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists())
				$status = $this->Document->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}
	
	public function changestatus() {
            
		$this->autoRender = false;  
		$status = '';
	   $AuthUser = $this->Session->Read('AuthUser');
$user_id = $AuthUser['User']['id'];
		$ids = array();
		$id = $_REQUEST['id'];             
		$status = $_REQUEST['status'];
			
			
			if(!empty($id)){

				$data = array();
				$data['status'] = $_REQUEST['status'];
				if($_REQUEST['status']=="1")
				{
					$data['DocumentFlow']['status'] = 1;
					$data['DocumentFlow']['recieve_date'] = date("Y-m-d H:i:s");
					$data['DocumentFlow']['recieve_by'] = $user_id;
				}
			
				//$data['DocumentFlow']['id'] = $id;
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists()){
					
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED'; 
				}
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		
					
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
	
	public function cancelDoc($id=null) {
            
		$this->autoRender = false;  
		$status = '';		
		if(isset($_POST['id']))
			$id = $_POST['id'];
			if(!empty($id)){

				$data = array();
				$data['deleted'] = "Y";
				$this->DocumentFlow->id = $id;
				if($this->DocumentFlow->exists())
					$status = $this->DocumentFlow->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		
					
		echo json_encode(array('status' => $status));
	}
	
	public function saveDocument($files,$doc_id,$corp_id)
	{
		
		if(isset($files))
		{
			$file_name = $files['name']['file'];
			$file_tmp = $files['tmp_name']['file'];
			$file_count = count($file_name);
			
			
			for($i=1;$i<=$file_count;$i++)
			{
				
				$file_name = $files['name']['file'][$i];
				
				$tmp_file = $files['tmp_name']['file'][$i];
				if($file_name!=""){
					$data=array();
					$data['id'] = $this->Generator->getID(); 
					$data['document_id'] = $doc_id;
					$data['file_name'] = $file_name;
					
					$this->DocumentFile->create();
					$this->DocumentFile->save($data); 
					$dir = $this->file_path . "/" . $corp_id;
							//echo $dir;
					if (!file_exists($dir) && !is_dir($dir)) {
						mkdir($dir);         
					} 
					$dir2 = $dir . "/" . $doc_id;
					if (!file_exists($dir2) && !is_dir($dir2)) {
						mkdir($dir2);         
					}
					$file_name = str_replace(" ","",$file_name);
					copy($tmp_file,$dir2 . "/" . $file_name ) ;
				}
				echo $file_name . "<br />";
			}
			
		}
	}
	public function showFile($document_id){
		$arr[1] = "Doc1";
		$arr[2] = "Doc2";
		$whereConditions = array();
		
		$whereConditions['document_id'] = $document_id;
		$conditions = array('limit' => 20,'offset' => 0,
							'order' =>  array('created' => 'desc'),
							'conditions' => $whereConditions
						   ); 
						
		$document = $this->DocumentFile->find('all',$conditions);  
		return $document;
	}
	public function download_file($id){
		$this->autoRender = false;  
		$default['corp_id']=1;
		if(!empty($id)){
		$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				$whereConditions['id'] = $id;
				$conditions = array('limit' =>  '1',
									'order' =>  array('created' => 'asc'),
									'conditions' => $whereConditions
								   );
				$document = $this->DocumentFile->find('all',$conditions);  
				//print_r($document);
				foreach($document[0]['DocumentFile'] as $key => $value)
					$default[$key] = $value;
				
				$file = $_SERVER['DOCUMENT_ROOT'] . '/files/documentflow';
				$files = "";
				if( $default['corp_id']!="")
					$files .= "/" . $default['corp_id'];
				if( $default['document_id']!="")
					$files .= "/" . $default['document_id'];	
				$files .= "/" . str_replace(" ","",$default['file_name']);
				
				$file = $file  . $files;
				
				if (file_exists($file)) {
					header("Location: /files/documentflow" . $files );
					exit;
					//header('Content-Description: File Transfer');
					header('Content-Type: application/octet-stream');
					//header('Content-Disposition: attachment; filename="'.basename($file).'"');
					header('Expires: 0');
					header('Cache-Control: must-revalidate');
					header('Pragma: public');
					header('Content-Length: ' . filesize($file));
					readfile($file);
					exit;
				}else{
					header("HTTP/1.0 404 Not Found");
					header('Content-Type: text/html; charset=utf-8');
					echo "ไม่พบไฟล์ที่ค้นหา.\n";
					echo "<br >";
					echo $file . "-" . $files . "<br />";
					echo "<br />" . $default['document_id']  . "/" . $default['file_name'];
					die();
				}
				
		}
		
	}

}
?>