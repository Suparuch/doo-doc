<?php
App::uses('AppController', 'Controller');

class WebServiceController extends AppController {

	public $name = 'WebService';
	public $uses = array('Document','DocumentGroup','ModelRates','ModelRate','ModelCategory','ModelType','ModelStatus','ModelDocument','ModelProperty','ModelEquipment','ModelDivision','ModelDivisionEquipment','ModelDivisionSpecial','ModelDivisionSpecialProperty','ModelDivisionSpecialEquipment','ModelSubDivision','ModelPosition','ModelGroup','Organization','OrganizationModel','Equipment','Corp','Rank','Weapon','Division','SubDivision','Position','Weapon','ModelRateProperty','Tech','Month');
	public $components = array("FileStorageComponent","Generator");
	//,"SFTP"

	function beforeFilter(){
		/*
		$currentUser = $this->Session->check('AuthUser');
		if(empty($currentUser)){
			$this->Session->delete('AuthUser');
			$this->Session->destroy();

			$url = Configure::read('Application.Domain').'Logins';
			$this->redirect($url);
		}
		*/
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
		set_time_limit(5000);
		$this->layout = 'blank';
		$filename = date("YmdHis") . 'dopns_transfer.csv';
		$whereConditions = array();
			$whereConditions['deleted'] = 'N';      			
			$conditions = array('limit' =>   $this->Generator->setLimit(),
								'order' =>  array('order_sort' => 'asc'),
								'conditions' => $whereConditions
							   );
			$total = $this->Organization->find('count',$conditions);
			$Organizations = $this->Organization->find('all',$conditions); 
			
			foreach($Organizations as $organize)
			{
				if($organize['Organization']['model_id']!=""){
					$contents = '';
					$handle = fopen("http://" . $_SERVER["SERVER_NAME"] . "/WebService/Export/" . $organize['Organization']['model_id'] , "r");
					if (FALSE === $handle) {
						exit("Failed to open stream to URL");
					}

					

					while (!feof($handle)) {
						$contents .= fread($handle, 8192);
					}
					$fp = fopen($_SERVER['DOCUMENT_ROOT']  . '/Upload/output/' . $filename, 'a');
					fwrite($fp, iconv("utf-8", "tis-620",$contents));
					fclose($fp);
					fclose($handle);
				}
			}
			
			
			
		
		
		//echo "http://" . $_SERVER["SERVER_NAME"] . "/WebService/Export/1200";
		
	}     
	
	public function export($model_id) {
		$this->layout = 'blank';
		$this->layout = 'blank';
		$model_type_id = '';
		$page ='Property';
		$mode='';
		//$model_id=1011;
		if(!empty($model_id)){

			$whereConditions = array();
			$whereConditions['id'] = $model_id;
			$whereConditions['deleted'] = 'N';

			$conditions = array(
								'conditions' => $whereConditions,
								'order'=>array('order_sort' => 'asc')
							   );
			$ModelRates = $this->ModelRate->find('first',$conditions);
			$model_type_id = $ModelRates['ModelRate']['model_type_id'];

			//$model_type_id = 1;
			//$mode = 'Decrease3'; //Group , Decrease3;

			if($model_type_id == 1){
	
				if($mode=='Group'){

					$conditions = array('conditions' => array('model_parent_id'=>$model_id,'deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','model_id','quantity','code','name'));
					$ModelGroups = $this->ModelGroup->find('all',$conditions);

					if($page =='Property'){ /* อจย ตอน 3 รวม */
				
						$ModelDivisions = array();
						$Model = array();
						foreach($ModelGroups as $ModelGroup){

							$conditions = array('conditions' => array('model_id'=>$ModelGroup['ModelGroup']['model_id'],'deleted' => 'N'),'group'=>array('rank_id' ),'order'=>array('rank_id' => 'asc'),'fields' => array('rank_id','SUM(rate_full) as rate_full','SUM(rate_decrease_1) as rate_decrease_1','SUM(rate_decrease_2) as rate_decrease_2','SUM(rate_decrease_3) as rate_decrease_3','SUM(rate_structure) as rate_structure'));
							$ModelProperty = $this->ModelProperty->find('all',$conditions);
							array_push($ModelDivisions,$ModelProperty);
							$Model[] = $ModelGroup['ModelGroup']['model_id'];

						}
//pr($ModelDivisions);die;


						//$conditions = array('conditions' => array('id'=>$Model,'deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'));
						//$ModelRates = $this->ModelRate->find('list',$conditions);
						//pr($ModelRates);
						//die;

					}else if($page =='Equipment'){ /* อจย ตอน 4 รวม*/

						$conditions = array('conditions' => array('model_parent_id'=>$model_id,'deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('model_id','quantity'));
						$ModelGroups = $this->ModelGroup->find('all',$conditions);

						$ModelGroup =array();
						foreach($ModelGroups as $a){
							$ModelGroup[] = $a['ModelGroup']['model_id'];
						}

						$ModelDivisions = array();

						$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'));
						$Techs = $this->Tech->find('all',$conditions);						
						foreach($Techs as $Tech){

								$ModelEquipments = array();
								//foreach($ModelGroups as $ModelGroup){
								$conditions = array('conditions' => array('ModelEquipment.model_id'=>$ModelGroup,'ModelGroup.model_parent_id' => $model_id,
									'ModelEquipment.tech_id' =>$Tech['Tech']['id'],'ModelEquipment.deleted' => 'N','ModelGroup.deleted' => 'N'),
									'group'=>array('ModelEquipment.equipment_code','ModelEquipment.equipment_name'),
									'order'=>array('ModelEquipment.equipment_code' => 'asc'),
									'fields' => array('ModelEquipment.equipment_code','ModelEquipment.equipment_name','SUM(rate_full * CAST("ModelGroup"."quantity" AS integer)) as rate_full','SUM(rate_decrease_1 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_1','SUM(rate_decrease_2 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_2','SUM(rate_decrease_3 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_3','SUM(rate_structure * CAST("ModelGroup"."quantity" AS integer)) as rate_structure'),
									'joins' =>array(array('table' => 'model_equipments', 'alias' => 'ModelEquipment','type' => 'INNER','conditions' => array('ModelEquipment.model_id = ModelGroup.model_id'))));

								$ModelEquipments=$this->ModelGroup->find('all',$conditions);

								array_push($ModelDivisions,$ModelEquipments);
					
						}
						$this->set('Techs',$Techs);

					}

					if(!empty($subMode)){
						$mode = $mode.$subMode;
					}
					$this->set('ModelGroups',$ModelGroups);

					
				}else{

					$ModelDivisions = array();
					$conditions = array(
										'order' =>  array('order_sort' => 'asc'),
										'conditions' => $whereConditions,
										'recursive' => 3
									   );

					$ModelDivisions = $this->ModelRateProperty->find('all',$conditions);

				}


			}else if($model_type_id == 2){

					/*
					$conditions = array(
										'order' =>  array('order_sort' => 'asc'),
										'conditions' => $whereConditions,
										'recursive' => 4
									   );
					$ModelDivisions = $this->ModelRateProperty->find('all',$conditions);
					*/

					$whereConditions = array();
					$whereConditions[] = "model_id = '".$model_id."'";
					$whereConditions['deleted'] = 'N';

					if($page =='Property'){ // อฉก ตอน 3

						$whereConditions['model_division_type'] = 'property';
						$conditions = array(
											'order' =>  array('order_sort' => 'asc'),
											'conditions' => $whereConditions,
											'recursive' => 4
										   );				
						$ModelDivisions = $this->ModelDivisionSpecialProperty->find('all',$conditions);
					
					}else if($page =='Equipment'){ // อฉก ตอน 5

						$whereConditions['model_division_type'] = 'equipment';
						$conditions = array(
											'order' =>  array('order_sort' => 'asc'),
											'conditions' => $whereConditions,
											'recursive' => 4
										   );
						$ModelDivisions = $this->ModelDivisionSpecialEquipment->find('all',$conditions);

					}

			}

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','short_name'),'cache' => 'longIdShortNameList', 'cacheConfig' => 'long');
			$ModelTypeShorts = $this->ModelType->find('list',$conditions);
			$Corps = $this->Corp->find('list',$conditions);
			$Ranks = $this->Rank->find('list',$conditions);

			$conditions = array('conditions' => array('deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'),'cache' => 'longIdNameList', 'cacheConfig' => 'long');
			$Techs = $this->Tech->find('list',$conditions);
			
		}
				
		$this->set('page',$page);
		$this->set('model_type_id',$model_type_id);
		$this->set('mode',$mode);

		$this->set('ModelRates',$ModelRates);
		$this->set('ModelDivisions',$ModelDivisions);

		$this->set('ModelTypeShorts',$ModelTypeShorts);
		$this->set('Corps',$Corps);
		$this->set('Ranks',$Ranks);

		$this->set('Techs',$Techs);
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
		$fp = fopen($_SERVER['DOCUMENT_ROOT']  . 'Upload/output/' . $file_name, 'w');
		fwrite($fp, iconv("utf-8", "tis-620",$head. $str));
		fclose($fp);
		
		/*
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
			 
			 
			 
			 
			/* We save all the filenames in the following array * /
			$files_to_upload = array();
			 
			/* Open the local directory form where you want to upload the files * /
	
					  $success = $sftp->put(WWW_ROOT . "tmp/" . $file_name, 
											"/home/exchange-data/exchg/dopns/inputpath/" . $file_name, 
											 NET_SFTP_LOCAL_FILE);

		}
		catch (Exception $e) {
			echo "Error";
			echo $e->getMessage() . "\n";
		}
		*/
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