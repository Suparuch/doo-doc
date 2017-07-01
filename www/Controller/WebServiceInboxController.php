<?php
App::uses('AppController', 'Controller');

class WebServiceInboxController extends AppController {

	public $name = 'WebServiceInbox';
	public $uses = array('Document','DocumentGroup','ModelRates','ModelRate','ModelCategory','ModelType','ModelStatus','ModelDocument','ModelProperty','ModelEquipment','ModelDivision','ModelDivisionEquipment','ModelDivisionSpecial','ModelDivisionSpecialProperty','ModelDivisionSpecialEquipment','ModelSubDivision','ModelPosition','ModelGroup','Organization','OrganizationModel','Equipment','Corp','Rank','Weapon','Division','SubDivision','Position','Weapon','ModelRateProperty','Tech','Month');
	public $components = array("FileStorageComponent","Generator");
	//,"SFTP"

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
			$conditions = array('limit' =>  '20',
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$documents = $this->Document->find('all',$conditions);
			$total = $this->Document->find('count',$conditions);
		}else{
			
			$default = array();
			$default = $dataRequest;
			$this->set('default',$default);                      
			//intitial
			$whereConditions = array();
			$whereCOnditions['deleted'] = 'N';
			
			$offset = $dataRequest['offset'];
			
			$name = $dataRequest['name'];

			if(!empty($name))
			$whereConditions[] = 'name ILIKE \'%'.$name.'%\' OR short_name ILIKE \'%'.$name.'%\'';
			
			$conditions = array('limit' => $this->Generator->setLimit(),'offset' => $offset,
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$documents = $this->Document->find('all',$conditions); 
			$total = $this->Document->find('count', array('conditions' => $whereConditions ));              
		}            
	 
		$breadcrumb = array (   'controller' => array(   
								'name' => 'ระบบเชื่อมต่อข้อมูลระหว่างสายงาน' ,
								'url' => ''
								)
		);
		$this->set('breadcrumb',$breadcrumb);         
		
		$this->set('document',$documents);
		$pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'document','pages' => 5);
		$this->set('pagination',$pagination);                 
	}

	public function form($id = null) {
		$this->layout = 'blank';
		$default = array();
		echo WWW_ROOT . "test.zip";
		if(!empty($id)){
			
				$whereConditions = array();
				$whereConditions['deleted'] = 'N';
				$whereConditions['id'] = $id;
				$conditions = array('limit' =>  '1',
									'order' =>  array('order_sort' => 'asc'),
									'conditions' => $whereConditions
								   );
				$ranks = $this->Rank->find('all',$conditions);  
				
				foreach($ranks[0]['Rank'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}
		$whereConditions = array();
		$whereConditions['deleted'] = 'N';
		$conditions = array('limit' =>  '1',
							'order' =>  array('order_sort' => 'asc'),
							'conditions' => $whereConditions
						   );
		$document_group = $this->DocumentGroup->find('all',$conditions); 
          $this->set('DocumentGroup',$document_group);  
	}     
        
        public function Detail($filename = "")
        {
           // echo "File $filename";
            $breadcrumb = array (   'controller' => array(   
								'name' => 'ระบบเชื่อมต่อข้อมูลระหว่างสายงาน' ,
								'url' => ''
								)
		);
            $this->set('breadcrumb',$breadcrumb);
        }
	
	public function formgroup($id = null) {
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
				foreach($document_category[0]['Rank'] as $key => $value)
					$default[$key] = $value;
				
				$this->set('default',$default);
			
		}
	}  
        
	public function save($id = null)
	{
		
		$offset = 0;
			$file_name = date("YmdHis") . 'dopns_transfer.csv';
		if(!empty($model_type_id))
		$whereConditions[] = "model_type_id = '".$model_type_id."'";
		$whereConditions['deleted'] = 'N'; 
		$whereConditions['is_group'] = 'N'; 
		$conditions = array('order' =>  array('code' => 'asc'),
							'conditions' => $whereConditions
						   );
		$ModelRates = $this->ModelRate->find('all',$conditions);
		$total = $this->ModelRate->find('count',$conditions);
		$no = 0;
		$head = "ลำดับ,id,หน่วยงาน,หมายเลข อจย.,อัตราเต็ม(รวม),อัตราเต็ม(น.),อัตราเต็ม(ส.),อัตราเต็ม(อื่นๆ),อัตราบรรจุ(รวม),อัตราบรรจุ(น.),อัตราบรรจุ(ส.),อัตราบรรจุ(ประจำ),อัตราบรรจุ(อื่นๆ),ต่ำกว่า 21 ปี	,21-30,	31-40,	41-50,	51-60,	60 ปีขึ้นไป,เหล่า ร.,เหล่า ม.,เหล่า ป.,เหล่า ป., เหล่า ช. ,เหล่า ส., เหล่า ขส., แก้ไข \n";
		foreach($ModelRates as $Model)
		{
			$corp = "";
			$corp = "ท.บ.";
			$item['no'] = ++$no;
			$item['id'] = $Model['ModelRate']['id'] ;
			$item['corp'] = $corp;
			$item['code'] = $Model['ModelRate']['code'];
			
			$item['full_total'] = 0;
			$item['full_1'] = 0;
			$item['full_2'] = 0;
			$item['full_3'] = 0;
			
			$item['real_total'] = 0;
			$item['real_1'] = 0;
			$item['real_2'] = 0;
			$item['real_3'] = 0;
			$item['real_4'] = 0;
			
			$item['age_1'] = 0;
			$item['age_2'] = 0;
			$item['age_3'] = 0;
			$item['age_4'] = 0;
			$item['age_5'] = 0;
			$item['age_6'] = 0;
			
			$item['unit_1'] = 0;
			$item['unit_2'] = 0;
			$item['unit_3'] = 0;
			$item['unit_4'] = 0;
			$item['unit_5'] = 0;
			$item['unit_6'] = 0;
			$item['unit_7'] = 0;
			
			$item['edit'] = "Edit";
			
			$str_item = implode('","',$item);
			$data[] = '"' . $str_item . '"' . "\n" ;
			
		}
		$str = implode("",$data);
		$fp = fopen(WWW_ROOT . 'tmp/' . $file_name, 'w');
		fwrite($fp, iconv("utf-8", "tis-620",$head. $str));
		fclose($fp);
		
		
		$ftp_server = "110.170.149.35";
		$ftp_port = "2222";
		$ftp_user_name = "exchange-data";
		$ftp_user_pass = "exchange-data#password";
		$csv_filename = "dopns_hr.sql";
		require_once(WWW_ROOT . 'libs/phpseclib0.3.0/Math/BigInteger.php');
		require_once(WWW_ROOT . 'libs/phpseclib0.3.0/Crypt/Random.php');
		require_once(WWW_ROOT . 'libs/phpseclib0.3.0/Crypt/Hash.php');
		require_once(WWW_ROOT . 'libs/phpseclib0.3.0/Crypt/TripleDES.php');
		require_once(WWW_ROOT . 'libs/phpseclib0.3.0/Crypt/RC4.php');
		require_once(WWW_ROOT . 'libs/phpseclib0.3.0/Crypt/AES.php');
		require_once(WWW_ROOT . 'libs/phpseclib0.3.0/Net/SSH2.php');
		 
		include( WWW_ROOT . 'libs/phpseclib0.3.0/Net/SFTP.php');
		
		
		 
		try {
			$sftp = new Net_SFTP($ftp_server,$ftp_port);
			if (!$sftp->login($ftp_user_name, $ftp_user_pass)) 
			{
				exit('Login Failed');
			} 
			 
			 
			 
			 
			/* We save all the filenames in the following array */
			$files_to_upload = array();
			 
			/* Open the local directory form where you want to upload the files */
	
					  $success = $sftp->put(WWW_ROOT . "tmp/" . $file_name, 
											"/home/exchange-data/exchg/dopns/inputpath/" . $file_name, 
											 NET_SFTP_LOCAL_FILE);

		}
		catch (Exception $e) {
			echo "Error";
			echo $e->getMessage() . "\n";
		}
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
				$this->Rank->id = $id;
				if($this->Rank->exists())
				$status = $this->Rank->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		}
					
		echo json_encode(array('status' => $status));
	}
}
?>