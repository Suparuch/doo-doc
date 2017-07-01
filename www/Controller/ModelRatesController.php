<?php
App::uses('AppController', 'Controller');

class ModelRatesController extends AppController {

    public $name = 'ModelRates';
    public $uses = array('ModelRate', 'ModelCategory', 'ModelType', 'ModelStatus', 'ModelDocument', 'ModelProperty', 'ModelEquipment', 'ModelDivision', 'ModelDivisionEquipment', 'ModelDivisionSpecial', 'ModelDivisionSpecialProperty', 'ModelDivisionSpecialEquipment', 'ModelSubDivision', 'ModelPosition', 'ModelGroup', 'Organization', 'OrganizationModel', 'Equipment', 'Corp', 'Rank', 'Weapon', 'Division', 'SubDivision', 'Position', 'Weapon', 'ModelRateProperty', 'Tech', 'Month','ModelFile');
    public $components = array("Generator", "DateFormat");

    //public $helpers = array('TinyMCE');
public $file_path = "../webroot/files/model";
    function beforeFilter() {
        $currentUser = $this->Session->check('AuthUser');
        if (empty($currentUser)) {
            $this->Session->delete('AuthUser');
            $this->Session->destroy();

            $url = Configure::read('Application.Domain') . 'Logins';
            $this->redirect($url);
        }
    }

    public function indextree() {
        $condition = array();
        $condition['deleted'] = 'N';
        $ModelRates = $this->ModelRate->find('list', array('fields' => array('id', 'name'), 'conditions' => $condition, 'order' => array('order_sort' => 'asc'), 'cache' => 'longNameList', 'cacheConfig' => 'long'));

        $breadcrumb = array('controller' => array(
                'name' => 'อัตราการจัดและยุทโธปกรณ์',
                'url' => ''
            )
        );

        $this->set('breadcrumb', $breadcrumb);

        $this->set('ModelRates', $ModelRates);
    }
	
	public function getEditModelRateDetail($model_type_id = 1){
	
		$this->layout = 'ajax';
		$model_division_id = $_REQUEST['model_division_id'];
		$whereConditions = array();
        $whereConditions['id'] = $model_division_id;
        $whereConditions['deleted'] = 'N';
        $whereConditions['model_division_type'] = 'property';
		if ($model_type_id == 1) {
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 3
            );
            $ModelDivisions = $this->ModelDivision->find('all', $conditions);
        } else if ($model_type_id == 2) {
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 4
            );
            $ModelDivisions = $this->ModelDivisionSpecial->find('all', $conditions);
			
        }
		
	//	$model_type_id=2;
        $this->set('model_type_id', $model_type_id);
   

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Corps = $this->Corp->find('list', $conditions);
$this->set('Corps', $Corps);

 $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Ranks = $this->Rank->find('list', $conditions2);
        
        $this->set('Ranks', $Ranks);

        $conditions = array('conditions' => array('deleted' => 'N'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Weapons = $this->Weapon->find('list', $conditions);
        $this->set('Weapons', $Weapons);
	
		$this->set("ModelDivisions",$ModelDivisions);
			
		$this->render("/ModelRates/EditModelRateDetail" . $model_type_id);
							//	$this->render(false);
								//<i class="icon-trash" onclick="deleteItem('property','2020610110012','20206101102');">
	}

    public function getTreeData($parent_id = NULL, $organization_type = null) {

        $this->disableCache();
        $this->autoRender = false;

        $condition = array();
        //$condition['parent_id'] = $parent_id;
      
        $condition['deleted'] = 'N';
$i = 0;
        if ($parent_id != 1) {
            $condition['model_parent_id'] = $parent_id;
            $ModelGroups = $this->ModelGroup->find('all', array('conditions' => $condition, 'order' => array('code' => 'asc')));

            
            $data_array = array();
            if (!empty($ModelGroups)) {
                foreach ($ModelGroups as $ModelGroup) {

                    $data_array[$i]['data']['title'] = $ModelGroup['ModelGroup']['code'];
                    $data_array[$i]['data']['attr']['id'] = $ModelGroup['ModelGroup']['model_id'];
                    //$data_array[$i]['data']['attr']['level'] = $Organization['Organization']['organization_level'];
                    $data_array[$i]['data']['attr']['level'] = 1;
                    $data_array[$i]['state'] = 'closed';
                    $data_array[$i]['attr']['id'] = $ModelGroup['ModelGroup']['model_id'];
                    $data_array[$i]['attr']['parent_id'] = $ModelGroup['ModelGroup']['model_parent_id'];
                    //$data_array[$i]['attr']['level'] = $Organization['Organization']['organization_level'];
                    $data_array[$i]['attr']['level'] = 1;
                    $i++;
                }
            }
        } else{
            $whereConditions = array();
            $whereConditions['deleted'] = 'N';
            $whereConditions['is_group'] = 'Y';
            //$whereConditions[] = $field .' ILIKE \'%'.$value.'%\'';

            
            //if(!empty($field)) $whereConditions[] = $field .' ILIKE \'%'.$value.'%\'';
            //else 
            //$whereConditions[] = 'name ILIKE \'%'.$value.'%\'';

            $conditions = array('conditions' => $whereConditions, 'order' => array('code' => 'asc'));
            //$conditions = array('conditions' => $whereConditions,'order'=>array('name' => 'asc'),'fields' => array('id',$field));
            $ModelRates = $this->ModelRate->find('all', $conditions);

            $data = array();
            foreach ($ModelRates as $ModelRate) {
                  $data_array[$i]['data']['title'] = $ModelRate['ModelRate']['code'];
                    $data_array[$i]['data']['attr']['id'] = $ModelRate['ModelRate']['id'];
                    //$data_array[$i]['data']['attr']['level'] = $Organization['Organization']['organization_level'];
                    $data_array[$i]['data']['attr']['level'] = 1;
                    $data_array[$i]['state'] = 'closed';
                    $data_array[$i]['attr']['id'] = $ModelRate['ModelRate']['id'];
                    $data_array[$i]['attr']['parent_id'] = $ModelRate['ModelRate']['parent_id'];
                    //$data_array[$i]['attr']['level'] = $Organization['Organization']['organization_level'];
                    $data_array[$i]['attr']['level'] = 1;
                     $i++;
            }
            //$data[]['table'] = $model;
            //$data[]['raw_data'] = $raw_data;
         //   $return = json_encode($data, true);
         //   echo $return;
        }
        
        print_r(json_encode($data_array));
    }

    public function index($model_type_id = null) {

        $data = $this->request->data;
 $AuthUser = $this->Session->Read('AuthUser');
$user_id = $AuthUser['User']['id'];
//print_r($AuthUser['ModelList']);
$model_item[] = 0;
foreach($AuthUser['ModelList'] as $model_list)
{
	$model_item[] = $model_list['ModelUserGroupList']['model_id'];
}
$model_in = implode(",",$model_item);

        if (empty($model_type_id))
            $model_type_id = empty($data['model_type_id']) ? null : $data['model_type_id'];

        $whereConditions = array();
        $whereConditions[] = " (created_by='$user_id' or created_by is null)";
		$StatusGroup = array();
        if (empty($data)) {
            $offset = 0;

            if (!empty($model_type_id))
                $whereConditions[] = "model_type_id = '" . $model_type_id . "'";
            $whereConditions['deleted'] = 'N';
            
            $whereConditions[] = " (id in ($model_in) ) ";
         
            $conditions = array('limit' => '20',
                'order' => array('code' => 'asc'),
                'conditions' => $whereConditions
            );
            $ModelRates = $this->ModelRate->find('all', $conditions);
            $total = $this->ModelRate->find('count', $conditions);
        }else {

            $default = array();
            $default = $data;
            $this->set('default', $default);
            //intitial
            $whereConditions['deleted'] = 'N';

            $offset = $data['offset'];

           
           
            $conditions = array('limit' => '20',
                'order' => array('code' => 'asc'),
                'conditions' => $whereConditions
            );

            $code = $data['code'];
            if (!empty($code))
                $whereConditions[] = '(code ILIKE \'%' . $code . '%\' or name ILIKE \'%' . $code . '%\')';
            //$whereConditions[] = 'code ILIKE \'%'.$code.'%\'';
 			$whereConditions[] = " (id in ($model_in) ) ";
            $conditions = array('limit' => $this->Generator->setLimit(), 'offset' => $offset,
                'order' => array('code' => 'asc'),
                'conditions' => $whereConditions,
            );
			
            $ModelRates = $this->ModelRate->find('all', $conditions);
            $total = $this->ModelRate->find('count', array('conditions' => $whereConditions));
        }

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $ModelTypes = $this->ModelType->find('list', $conditions);
        $ModelStatus = $this->ModelStatus->find('list', $conditions);

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);

        $breadcrumb = array('controller' => array(
                'name' => $ModelTypes[$model_type_id],
                'url' => ''
            )
        );

        $this->set('breadcrumb', $breadcrumb);

        $actions = array('is_used' => true,
            'action' => array('add' => true,
                'edit' => true,
                'delete' => true,
                'lock' => true,
                'copy' => true
            ),
            'name_th' => $ModelTypes[$model_type_id]
        );
        $this->set('actions', $actions);
$this->set('StatusGroup' , $StatusGroup);
        $this->set('model_type_id', $model_type_id);
        $this->set('ModelRates', $ModelRates);
        $this->set('ModelStatus', $ModelStatus);
        $this->set('ModelTypes', $ModelTypes);
        $this->set('ModelTypeShorts', $ModelTypeShorts);
        $pagination = array('offset' => $offset, 'total' => $total, 'limit' => $this->Generator->setLimit(), 'model' => 'ModelRate', 'pages' => 5);
        $this->set('pagination', $pagination);
    }

    public function addModelRate($model_type_id = null) {
        $this->layout = 'blank';

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Months = $this->Month->find('list', $conditions);

        $start_year = 1950;
        $current_year = date("Y");
        for ($year = $start_year; $year <= $current_year; $year++) {
            $Years[$year] = $year + 543;
        }

        $StatusLocks = array('N' => 'ให้แก้ไข', 'Y' => 'ไม่ให้แก้ไข');
$StatusGroup = array('N' => 'เป็น อจย. เดี่ยว', 'Y' => 'เป็น อจย. รวม');
        $this->set('model_type_id', $model_type_id);
        $this->set('model_id', '');
        $this->set('ModelTypeShorts', $ModelTypeShorts);

        $this->set('Months', $Months);
        $this->set('Years', $Years);

        $this->set('StatusLocks', $StatusLocks);
$this->set('StatusGroup', $StatusGroup);
    }

    public function editModelRate($model_id = null) {

        //set_time_limit(0);
        //ini_set('memory_limit','3000M');

        $this->layout = 'blank';

        $whereConditions = array();
        if (!empty($model_id))
            $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        $conditions = array('conditions' => $whereConditions);
        $ModelRates = $this->ModelRate->find('first', $conditions);
        //-----------------------------------------------------------------------------
		$ModelStatus = $this->ModelStatus->find('list');
        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
		
		$conditions = array(
            
            'conditions' => $whereConditions
        );
		
		$ModelFiles = $this->ModelFile->find('all',$conditions);
		$ModelFile1 = array();
		$ModelFile2 = array();
		foreach($ModelFiles as $files){
			$item = $files;
			if($files['ModelFile']['type']=="1")
			{
				$ModelFile1[]= $item;
			}else{
				$ModelFile2[]= $item;
			}
		}
		
        $conditions = array(
            'order' => array('model_category_id' => 'asc', 'id' => 'asc'),
            'conditions' => $whereConditions
        );
        $TempModelDocuments = $this->ModelDocument->find('all', $conditions);

        $ModelDocuments = array();
        foreach ($TempModelDocuments as $TempModelDocument) {
            $ModelDocuments[$TempModelDocument['ModelDocument']['model_category_id']][] = $TempModelDocument;
        }

        $conditions = array(
            'conditions' => $whereConditions
        );
        $OrganizationModels = $this->OrganizationModel->find('all', $conditions);

        //-----------------------------------------------------------------------------
        $is_group = $ModelRates['ModelRate']['is_group'];
        if ($is_group == 'Y') {
            $whereConditions = array();
            $whereConditions[] = "model_parent_id = '" . $model_id . "'";
            $whereConditions['deleted'] = 'N';
            $conditions = array(
                'conditions' => $whereConditions,
				
                'order' => array('order_sort','code' => 'asc')
            );
	
            $ModelGroups = $this->ModelGroup->find('all', $conditions);
	
            $this->set('ModelGroups', $ModelGroups);
        }
        //-----------------------------------------------------------------------------

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Organizations = $this->Organization->find('list', $conditions);
        $ModelCategorys = $this->ModelCategory->find('list', $conditions);
        $Months = $this->Month->find('list', $conditions);

        $start_year = 1950;
        $current_year = date("Y");
        for ($year = $start_year; $year <= $current_year; $year++) {
            $Years[$year] = $year + 543;
        }

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);
        //$Corps = $this->Corp->find('list',$conditions);
        //$Ranks = $this->Rank->find('list',$conditions);

        $StatusLocks = array('N' => 'ให้แก้ไข', 'Y' => 'ไม่ให้แก้ไข');
		$StatusDraft = array('N' => 'ใช้งาน', 'Y' => 'ร่าง');
	$StatusGroup = array('N' => 'เป็น อจย. เดี่ยว', 'Y' => 'เป็น อจย. รวม');
		
		
        //-----------------------------------------------------------------------------

        $this->set('model_id', $model_id);
        $this->set('ModelRates', $ModelRates);
        $this->set('ModelDocuments', $ModelDocuments);
        $this->set('OrganizationModels', $OrganizationModels);

        $this->set('Organizations', $Organizations);
        $this->set('ModelCategorys', $ModelCategorys);
        $this->set('ModelTypeShorts', $ModelTypeShorts);
        //$this->set('Corps',$Corps);
        //$this->set('Ranks',$Ranks);
        $this->set('Months', $Months);
        $this->set('Years', $Years);
        $this->set('StatusLocks', $StatusLocks);
 $this->set('StatusGroup' , $StatusGroup);
		$this->set('StatusDraft', $StatusDraft);
		$this->set('ModelStatus', $ModelStatus);
		$this->set('ModelFile1',$ModelFile1);
		$this->set('ModelFile2',$ModelFile2);
    }
    
    public function editModelRateTree($model_id = null) {

        //set_time_limit(0);
        //ini_set('memory_limit','3000M');

        $this->layout = 'blank';

        $whereConditions = array();
        if (!empty($model_id))
            $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        $conditions = array('conditions' => $whereConditions);
        $ModelRates = $this->ModelRate->find('first', $conditions);
        //-----------------------------------------------------------------------------

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        $conditions = array(
            'order' => array('model_category_id' => 'asc', 'id' => 'asc'),
            'conditions' => $whereConditions
        );
        $TempModelDocuments = $this->ModelDocument->find('all', $conditions);

        $ModelDocuments = array();
        foreach ($TempModelDocuments as $TempModelDocument) {
            $ModelDocuments[$TempModelDocument['ModelDocument']['model_category_id']][] = $TempModelDocument;
        }

        $conditions = array(
            'conditions' => $whereConditions
        );
        $OrganizationModels = $this->OrganizationModel->find('all', $conditions);

        //-----------------------------------------------------------------------------
        $is_group = $ModelRates['ModelRate']['is_group'];
        if ($is_group == 'Y') {
            $whereConditions = array();
            $whereConditions[] = "model_parent_id = '" . $model_id . "'";
            $whereConditions['deleted'] = 'N';
            $conditions = array(
                'conditions' => $whereConditions,
                'order' => array('code' => 'asc')
            );
            $ModelGroups = $this->ModelGroup->find('all', $conditions);
            $this->set('ModelGroups', $ModelGroups);
        }
        //-----------------------------------------------------------------------------

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Organizations = $this->Organization->find('list', $conditions);
        $ModelCategorys = $this->ModelCategory->find('list', $conditions);
        $Months = $this->Month->find('list', $conditions);

        $start_year = 1950;
        $current_year = date("Y");
        for ($year = $start_year; $year <= $current_year; $year++) {
            $Years[$year] = $year + 543;
        }

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);
        //$Corps = $this->Corp->find('list',$conditions);
        //$Ranks = $this->Rank->find('list',$conditions);

        $StatusLocks = array('N' => 'ให้แก้ไข', 'Y' => 'ไม่ให้แก้ไข');
        //-----------------------------------------------------------------------------

        $this->set('model_id', $model_id);
        $this->set('ModelRates', $ModelRates);
        $this->set('ModelDocuments', $ModelDocuments);
        $this->set('OrganizationModels', $OrganizationModels);

        $this->set('Organizations', $Organizations);
        $this->set('ModelCategorys', $ModelCategorys);
        $this->set('ModelTypeShorts', $ModelTypeShorts);
        //$this->set('Corps',$Corps);
        //$this->set('Ranks',$Ranks);
        $this->set('Months', $Months);
        $this->set('Years', $Years);
        $this->set('StatusLocks', $StatusLocks);
    }

    public function detailModelRate($model_id = null) {

        set_time_limit(0);
        ini_set('memory_limit', '3000M');

        $this->layout = 'blank';

        $whereConditions = array();
        if (!empty($model_id))
            $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        $conditions = array('conditions' => $whereConditions);
        $ModelRates = $this->ModelRate->find('first', $conditions);
        $model_type_id = $ModelRates['ModelRate']['model_type_id'];

        //-----------------------------------------------------------------------------

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

		$conditions = array(
            
            'conditions' => $whereConditions
        );
		
		$ModelFiles = $this->ModelFile->find('all',$conditions);
		$ModelFile1 = array();
		$ModelFile2 = array();
		foreach($ModelFiles as $files){
			$item = $files;
			if($files['ModelFile']['type']=="1")
			{
				$ModelFile1[]= $item;
			}else{
				$ModelFile2[]= $item;
			}
		}

        $conditions = array(
            'order' => array('model_category_id' => 'asc', 'id' => 'asc'),
            'conditions' => $whereConditions
        );
        $TempModelDocuments = $this->ModelDocument->find('all', $conditions);
        //pr($TempModelDocuments);

        $ModelDocuments = array();
        foreach ($TempModelDocuments as $TempModelDocument) {
            $ModelDocuments[$TempModelDocument['ModelDocument']['model_category_id']][] = $TempModelDocument;
        }
        //pr($ModelDocuments);
        //-----------------------------------------------------------------------------
        $ModelDivisions = array();
        if ($model_type_id == 1) {
            $whereConditions['model_division_type'] = 'property';
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 3
            );
            $ModelDivisions = $this->ModelDivision->find('all', $conditions);
        } else if ($model_type_id == 2) {

            //$ModelDivisions = $this->ModelDivisionSpecial->find('all',$conditions);

            $whereConditions['model_division_type'] = 'property';
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 4
            );
            $ModelDivisionSpecialProperties = $this->ModelDivisionSpecialProperty->find('all', $conditions);

            $whereConditions['model_division_type'] = 'equipment';
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 4
            );
            $ModelDivisionSpecialEquipments = $this->ModelDivisionSpecialEquipment->find('all', $conditions);

            $this->set('ModelDivisionSpecialProperties', $ModelDivisionSpecialProperties);
            $this->set('ModelDivisionSpecialEquipments', $ModelDivisionSpecialEquipments);
        }

        //-----------------------------------------------------------------------------
        $this->set('model_id', $model_id);
        $this->set('ModelDivisions', $ModelDivisions);

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'conditions' => $whereConditions
        );
        $OrganizationModels = $this->OrganizationModel->find('all', $conditions);

        //-----------------------------------------------------------------------------
        $is_group = $ModelRates['ModelRate']['is_group'];
        if ($is_group == 'Y') {
            $whereConditions = array();
            $whereConditions[] = "model_parent_id = '" . $model_id . "'";
            $whereConditions['deleted'] = 'N';
            $conditions = array(
                'conditions' => $whereConditions,
                'order' => array('code' => 'asc')
            );
            $ModelGroups = $this->ModelGroup->find('all', $conditions);
            $this->set('ModelGroups', $ModelGroups);
        }
        //-----------------------------------------------------------------------------

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Organizations = $this->Organization->find('list', $conditions);
        $ModelCategorys = $this->ModelCategory->find('list', $conditions);
        $Weapons = $this->Weapon->find('list', $conditions);

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);
        $Corps = $this->Corp->find('list', $conditions);
        $Ranks = $this->Rank->find('list', $conditions);

        $StatusLocks = array('N' => 'ให้แก้ไข', 'Y' => 'ไม่ให้แก้ไข');
        //-----------------------------------------------------------------------------		

        $this->set('model_id', $model_id);
        $this->set('ModelRates', $ModelRates);
        $this->set('ModelDocuments', $ModelDocuments);
        $this->set('OrganizationModels', $OrganizationModels);

        $this->set('Organizations', $Organizations);
        $this->set('ModelCategorys', $ModelCategorys);
        $this->set('ModelTypeShorts', $ModelTypeShorts);
        $this->set('Corps', $Corps);
        $this->set('Ranks', $Ranks);
        $this->set('Weapons', $Weapons);

        $this->set('StatusLocks', $StatusLocks);
		
		$this->set("ModelFile1",$ModelFile1);
		$this->set("ModelFile2",$ModelFile2);
    }

    public function append($model_id = null) {

        $this->layout = "blank";
        $data = $this->request->data;
        $model = empty($data['model']) ? '' : $data['model'];
        $model_id = empty($data['model_id']) ? '' : $data['model_id'];
        $model_type_id = empty($data['model_type_id']) ? '' : $data['model_type_id'];
        $model_division_id = empty($data['model_division_id']) ? '' : $data['model_division_id'];
        $model_subdivision_id = empty($data['model_subdivision_id']) ? '' : $data['model_subdivision_id'];
        $model_position_id = empty($data['model_position_id']) ? '' : $data['model_position_id'];

        $model_parent_id = empty($data['model_parent_id']) ? '' : $data['model_parent_id'];

        //pr($data);
        //die;
        //------------------------------------------------------------------------------------------------------
        //$whereConditions['deleted'] = 'N';            
        //$conditions = array('conditions' => $whereConditions);
        //$ModelDivisions = $this->ModelDivision->find('first',$conditions);
        //$ModelEquipments = $this->ModelEquipment->find('first',$conditions);
        //$ModelPositions = $this->ModelPosition->find('first',$conditions);
        //$model = 'equipment';
        $savedata = array();
        if ($model == 'model') {

            $whereConditions['id'] = $model_id;
            $whereConditions['deleted'] = 'N';
            $conditions = array('conditions' => $whereConditions);
            $ModelRate = $this->ModelRate->find('first', $conditions);

            $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
            $ModelStatus = $this->ModelStatus->find('list', $conditions);

            $this->set('ModelRate', $ModelRate);
            $this->set('ModelStatus', $ModelStatus);
        } else if ($model == 'division') {

            $model_division_type = 'property';
            $conditions = array('conditions' => array('model_id' => $model_id, 'deleted' => 'N', "model_division_type = '" . $model_division_type . "'"));
            $key_division = $this->ModelDivision->find('count', $conditions);
            $key_division++;

            $model_division_id = $this->Generator->getID();
            $savedata['ModelDivision']['id'] = $model_division_id;
            $savedata['ModelDivision']['model_id'] = $model_id;
            $savedata['ModelDivision']['order_sort'] = $key_division;
            $savedata['ModelDivision']['model_division_type'] = $model_division_type;
            $this->ModelDivision->save($savedata);

            $this->set('key_division', $key_division);
            $this->set('model_division_id', $model_division_id);

            $model .= '_modeltype_' . $model_type_id;
        } else if ($model == 'division_equipment') {

            $model_division_type = 'equipment';
            $conditions = array('conditions' => array('model_id' => $model_id, 'deleted' => 'N', "model_division_type = '" . $model_division_type . "'"));
            $key_division = $this->ModelDivision->find('count', $conditions);
            $key_division++;

            $model_division_id = $this->Generator->getID();
            $savedata['ModelDivision']['id'] = $model_division_id;
            $savedata['ModelDivision']['model_id'] = $model_id;
            $savedata['ModelDivision']['order_sort'] = $key_division;
            $savedata['ModelDivision']['model_division_type'] = $model_division_type;
            $this->ModelDivision->save($savedata);

            $this->set('key_division', $key_division);
            $this->set('model_division_id', $model_division_id);

            //$model .= 'division_equipment';
        } else if ($model == 'subdivision') {

            $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'deleted' => 'N'));
            $key_subdivision = $this->ModelSubDivision->find('count', $conditions);
            $key_subdivision++;

            $model_subdivision_id = $this->Generator->getID();
            $savedata['ModelSubDivision']['id'] = $model_subdivision_id;
            $savedata['ModelSubDivision']['model_id'] = $model_id;
            $savedata['ModelSubDivision']['model_division_id'] = $model_division_id;
            $savedata['ModelSubDivision']['order_sort'] = $key_subdivision;
            $this->ModelSubDivision->save($savedata);

            $this->set('model_division_id', $model_division_id);

            $this->set('key_subdivision', $key_subdivision);
            $this->set('model_subdivision_id', $model_subdivision_id);

            //$model .= '_modeltype_'.$model_type_id;
        } else if ($model == 'position') {

            if (empty($model_division_id)) {
                $conditions = array('conditions' => array('model_id' => $model_id, 'deleted' => 'N'), 'order' => array('id' => 'desc'));
                $ModelDivisions = $this->ModelDivision->find('first', $conditions);
                $model_division_id = $ModelDivisions['ModelDivisions']['id'];
            }

            if ($model_type_id == 1)
                $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'deleted' => 'N'));
            if ($model_type_id == 2)
                $conditions = array('conditions' => array('model_id' => $model_id, 'model_subdivision_id' => $model_division_id, 'deleted' => 'N'));
            $key_position = $this->ModelPosition->find('count', $conditions);
            $key_position++;

            $model_position_id = $this->Generator->getID();
            $savedata['ModelPosition']['id'] = $model_position_id;
            $savedata['ModelPosition']['model_id'] = $model_id;
            if ($model_type_id == 1)
                $savedata['ModelPosition']['model_division_id'] = $model_division_id;
            if ($model_type_id == 2) {

                $model_subdivision_id = $model_division_id;

                $conditions = array('conditions' => array('id' => $model_subdivision_id, 'deleted' => 'N'));
                $ModelSubDivisions = $this->ModelSubDivision->find('first', $conditions);
                $model_division_id = $ModelSubDivisions['ModelSubDivision']['model_division_id'];

                $savedata['ModelPosition']['model_division_id'] = $model_division_id;
                $savedata['ModelPosition']['model_subdivision_id'] = $model_subdivision_id;

                $this->set('model_subdivision_id', $model_subdivision_id);
            }
            $savedata['ModelPosition']['order_sort'] = $key_position;
            $this->ModelPosition->save($savedata);

            $this->set('model_division_id', $model_division_id);
            $this->set('key_position', $key_position);
            $this->set('model_position_id', $model_position_id);

            $model .= '_modeltype_' . $model_type_id;
        } else if ($model == 'property') {

            if (empty($model_division_id) && empty($model_position_id)) {

                $conditions = array('conditions' => array('model_id' => $model_id, 'deleted' => 'N'), 'order' => array('id' => 'desc'));
                $ModelDivisions = $this->ModelDivision->find('first', $conditions);
                $model_division_id = $ModelDivisions['ModelDivision']['id'];

                $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'deleted' => 'N'), 'order' => array('id' => 'desc'));
                $ModelPositions = $this->ModelPosition->find('first', $conditions);
                $model_position_id = $ModelPositions['ModelPosition']['id'];
            }

            $model_property_id = $this->Generator->getID();
            $savedata['ModelProperty']['id'] = $model_property_id;
            $savedata['ModelProperty']['model_id'] = $model_id;
            if ($model_type_id == 1)
                $savedata['ModelProperty']['model_division_id'] = $model_division_id;
            if ($model_type_id == 2)
                $savedata['ModelProperty']['model_division_id'] = $model_subdivision_id;
            $savedata['ModelProperty']['model_position_id'] = $model_position_id;
            $this->ModelProperty->save($savedata);

            $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'model_position_id' => $model_position_id, 'deleted' => 'N'));
            $key_property = $this->ModelProperty->find('count', $conditions);

            $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
            $Corps = $this->Corp->find('list', $conditions);
            $Ranks = $this->Rank->find('list', $conditions);
            $this->set('Corps', $Corps);
            $this->set('Ranks', $Ranks);

            $this->set('model_division_id', $model_division_id);
            $this->set('model_subdivision_id', $model_subdivision_id);
            $this->set('model_position_id', $model_position_id);
            $this->set('key_property', $key_property);
            $this->set('model_property_id', $model_property_id);

            $model .= '_modeltype_' . $model_type_id;
        }else if ($model == 'equipment') {

            $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'deleted' => 'N'));
            $key_equipment = $this->ModelEquipment->find('count', $conditions);
            $key_equipment++;

            $model_equipment_id = $this->Generator->getID();
            $savedata['ModelEquipment']['id'] = $model_equipment_id;
            $savedata['ModelEquipment']['model_id'] = $model_id;
            $savedata['ModelEquipment']['model_division_id'] = $model_division_id;
            $this->ModelEquipment->save($savedata);

            $this->set('model_division_id', $model_division_id);
            $this->set('model_equipment_id', $model_equipment_id);
            $this->set('key_equipment', $key_equipment);

            $model .= '_modeltype_' . $model_type_id;
        } else if ($model == 'modelgroup') {

            $model_group_id = $this->Generator->getID();
            $savedata['ModelGroup']['id'] = $model_group_id;
            //$savedata['ModelGroup']['model_id'] = $model_id;
            $savedata['ModelGroup']['model_parent_id'] = $model_parent_id;
            $this->ModelGroup->save($savedata);
			$this->set('model_id',$model_id);
            $this->set('model_group_id', $model_group_id);
        }
        //pr($savedata);
        $this->set('model_id', $model_id);
        $this->set('model', $model);
    }

    public function getData($model = null, $value = null) {

        $this->layout = 'blank';
        $this->autoRender = false;
        $data = $this->request->data;
        $raw_data = $data;
        if (!empty($data)) {

            $value = $data['value'];
            $field = !empty($data['field']) ? $data['field'] : 'name';

            if (!empty($value)) {

                $whereConditions = array();
                $whereConditions['deleted'] = 'N';
                //$whereConditions[] = $field .' ILIKE \'%'.$value.'%\'';

                if ($model == "Equipment")
                    $whereConditions[] = "(" . $field . " ILIKE '" . $value . "%' or code ILIKE '%" . $value . "%')";
                else
                    $whereConditions[] = $field . ' ILIKE \'' . $value . '%\'';
                //if(!empty($field)) $whereConditions[] = $field .' ILIKE \'%'.$value.'%\'';
                //else 
                //$whereConditions[] = 'name ILIKE \'%'.$value.'%\'';

                $conditions = array('conditions' => $whereConditions, 'limit' => '20', 'order' => array('name' => 'asc'), 'fields' => array('id','code', $field), 'cache' => 'longIdList_' . $value, 'cacheConfig' => 'long');
                //$conditions = array('conditions' => $whereConditions,'order'=>array('name' => 'asc'),'fields' => array('id',$field));
                $dataModels = $this->$model->find('all', $conditions);

                $dd = array();
                foreach ($dataModels as $dataModel) {
					$dataModel[$model]['tokens'] = array($dataModel[$model]['name'],$dataModel[$model]['code']);
					if ($model == "Equipment"){
						$dataModel[$model]['name'] =$dataModel[$model]['code'] . " - " . $dataModel[$model]['name'];
					}
                    $dd[] = $dataModel[$model];
                }
				//$data['item']=$dd;
				$data = $dd;
				
                //$data[]['table'] = $model;
              //  $data[]['raw_data'] = $raw_data;
                $return = json_encode($data, true);
                echo $return;

                /*
                  //pr(json_encode($data,true));
                  $data = array();
                  $data[] = array('id' => 1,'name' => 'John');
                  $data[] = array('id' => 2,'name' => 'Alex');
                  $data[] = array('id' => 3,'name' => 'RTA');
                  $data[] = array('id' => 4,'name' => 'ยก.ทบ.');
                  $data[] = array('id' => 5,'name' => 'ทดสอบ');

                  $return = json_encode($data,true);
                  //$return = str_replace('"id"','id',$return);
                  //$return = str_replace('"name"','name',$return);
                  //$return = str_replace('"',"'",$return);

                  //$return = '[{ "id": 1, "name": "John"}, { "id": 2, "name": "Alex"}, { "id": 3, "name": "Terry"}]';
                  //$return = '[{ "id": 1, "name": "John"}, { "id": 2, "name": "Alex"}, { "id": 3, "name": "Terry"}, { "id": 4, "name": "ทดสอบ"}]';
                  echo $return;
                  //echo json_encode($data,true);
                 */
            }
        }
    }

    public function getDataModelDetail() {

        $this->layout = 'blank';
        $this->autoRender = false;
        $data = $this->request->data;

        if (!empty($data)) {

            $code = $data['code'];
            $model_date = $data['model_date'];

            $model_date = $this->DateFormat->reConvertDateThai($model_date);

            if (!empty($code) && !empty($model_date)) {

                $whereConditions = array();
                $whereConditions['deleted'] = 'N';
                $whereConditions['model_type_id'] = 1;
				if(isset($data['model_id']) && $data['model_id']!="")
					$whereConditions['id'] = $data['model_id'];
                $whereConditions['code'] = $code;
                //$whereConditions['model_date'] = $model_date;

                $conditions = array('conditions' => $whereConditions, 'fields' => array('id', 'code', 'name', 'model_date','is_draft'));
                $dataModels = $this->ModelRate->find('first', $conditions);
				$id = $dataModels['ModelRate']['id'];
				$dataModels['ModelRate']['id'] = $id . " ";
				$model_date = $this->DateFormat->formatDateThai($dataModels['ModelRate']['model_date']);
				$draft = "";
					if($dataModel['ModelRate']['is_draft']=="Y")
						$draft = " (ร่าง) ";
                $dataModels['ModelRate']['name'] =  $dataModels['ModelRate']['name'] .  ' (' . $model_date . ') '  . $draft;
                $return = json_encode($dataModels['ModelRate'], true);
                echo $return;
            }
        }
    }

    public function getDataModel() {

        $this->layout = 'blank';
        $this->autoRender = false;
        $data = $this->request->data;
		$dd = array();
        if (!empty($data)) {

            $value = $data['value'];
			$dd['value'] = $value;
            $field = !empty($data['field']) ? $data['field'] : 'name';

            if (!empty($value)) {

                $whereConditions = array();
                $whereConditions['deleted'] = 'N';
                $whereConditions['model_type_id'] = 1;
                $whereConditions[] = $field . ' ILIKE \'' . $value . '%\'';

                $conditions = array('conditions' => $whereConditions, 'limit' => '20', 'order' => array($field => 'asc'), 'fields' => array('id', 'code', 'name', 'model_date','is_draft'), 'cache' => 'longIdList_' . $value, 'cacheConfig' => 'long');
                //$conditions = array('conditions' => $whereConditions,'limit' =>  '20','order'=>array($field => 'asc'),'fields' => array('id','name'),'cache' => 'longIdList_'.$value, 'cacheConfig' => 'long');
                $dataModels = $this->ModelRate->find('all', $conditions);
                //pr($dataModels);

                $data = array();
                foreach ($dataModels as $dataModel) {
                    //$dataModel['ModelRate']['name'] = $dataModel['ModelRate']['code'] . ' - ' . $dataModel['ModelRate']['name'] . ' ('.$dataModel['ModelRate']['model_date'] .')';
                    //$dataModel['ModelRate']['name'] = $dataModel['ModelRate']['code'] . ' ('.$dataModel['ModelRate']['model_date'] .')';

                    $model_date = $this->DateFormat->formatDateThai($dataModel['ModelRate']['model_date']);
                    //$dataModel['ModelRate']['name'] = $dataModel['ModelRate']['code'] . ' - ' . $dataModel['ModelRate']['name'] . ' ('.$model_date.')';
                    //$dataModel['ModelRate']['name'] = $dataModel['ModelRate']['code'];
					$id = $dataModel['ModelRate']['id'] ;
					$dataModel['ModelRate']['id'] = $id .= " ";
					$draft = "";
					if($dataModel['ModelRate']['is_draft']=="Y")
						$draft = " (ร่าง) ";
                    $dataModel['ModelRate']['name'] = $dataModel['ModelRate']['code'] . ' (' . $model_date . ') '  . ' - ' .  $dataModel['ModelRate']['name'] . $draft;
                    $data[] = $dataModel['ModelRate'];
                }
				$dd = $data;
                //pr($data);
                //die;
               
            }
        }
		 $return = json_encode($dd, true);
         echo $return;
    }

    public function lastModelDivision() {

        $this->layout = "blank";
        $this->autoRender = false;
        $data = $this->request->data;
        $model_id = empty($data['model_id']) ? '' : $data['model_id'];
        //$model_division_id = empty($data['model_division_id'])? '' : $data['model_division_id'];

        if (!empty($model_id)) {

            $conditions = array('conditions' => array('model_id' => $model_id, 'deleted' => 'N'), 'order' => array('id' => 'desc'));
            $ModelDivisions = $this->ModelDivision->find('first', $conditions);
            $model_division_id = empty($ModelDivisions['ModelDivision']['id']) ? '' : $ModelDivisions['ModelDivision']['id'];

            echo $model_division_id;
        }
    }

    public function lastModelSubDivision() {

        $this->layout = "blank";
        $this->autoRender = false;
        $data = $this->request->data;
        $model_id = empty($data['model_id']) ? '' : $data['model_id'];
        $model_division_id = empty($data['model_division_id']) ? '' : $data['model_division_id'];

        if (!empty($model_id) && !empty($model_division_id)) {

            //$conditions = array('conditions' => array('model_id'=>$model_id,'model_division_id'=>$model_division_id,'deleted'=>'N'),'order'=>array('id' => 'desc'));
            $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'deleted' => 'N'), 'order' => array('order_sort' => 'desc'));
            $ModelSubDivisions = $this->ModelSubDivision->find('first', $conditions);

            $model_subdivision_id = empty($ModelSubDivisions['ModelSubDivision']['id']) ? '' : $ModelSubDivisions['ModelSubDivision']['id'];

            echo $model_subdivision_id;
        }
    }

    public function lastModelPosition() {

        $this->layout = "blank";
        $this->autoRender = false;
        $data = $this->request->data;
        $model_id = empty($data['model_id']) ? '' : $data['model_id'];
        $model_type_id = empty($data['model_type_id']) ? '' : $data['model_type_id'];
        $model_division_id = empty($data['model_division_id']) ? '' : $data['model_division_id'];

        if (!empty($model_id) && !empty($model_division_id)) {

            //if($model_type_id==1) $conditions = array('conditions' => array('model_id'=>$model_id,'model_division_id'=>$model_division_id,'deleted'=>'N'),'order'=>array('id' => 'desc'));
            //if($model_type_id==2) $conditions = array('conditions' => array('model_id'=>$model_id,'model_subdivision_id'=>$model_division_id,'deleted'=>'N'),'order'=>array('id' => 'desc'));
            if ($model_type_id == 1)
                $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'deleted' => 'N'), 'order' => array('order_sort' => 'desc'));
            if ($model_type_id == 2)
                $conditions = array('conditions' => array('model_id' => $model_id, 'model_subdivision_id' => $model_division_id, 'deleted' => 'N'), 'order' => array('order_sort' => 'desc'));

            $ModelPositions = $this->ModelPosition->find('first', $conditions);
            $model_position_id = empty($ModelPositions['ModelPosition']['id']) ? '' : $ModelPositions['ModelPosition']['id'];

            echo $model_position_id;
        }
    }

    public function lastModelProperty() {

        $this->layout = "blank";
        $this->autoRender = false;
        $data = $this->request->data;
        //pr($data);
        $model_id = empty($data['model_id']) ? '' : $data['model_id'];
        //$model_type_id = empty($data['model_type_id'])? '' : $data['model_type_id'];
        $model_division_id = empty($data['model_division_id']) ? '' : $data['model_division_id'];
        $model_subdivision_id = empty($data['model_subdivision_id']) ? '' : $data['model_subdivision_id'];
        $model_position_id = empty($data['model_position_id']) ? '' : $data['model_position_id'];

        if (!empty($model_id) && !empty($model_division_id) && !empty($model_position_id)) {

            //if($model_type_id == 1) $conditions = array('conditions' => array('model_id'=>$model_id,'model_division_id'=>$model_division_id,'model_position_id'=>$model_position_id,'deleted'=>'N'),'order'=>array('id' => 'desc'));
            //if($model_type_id == 2) $conditions = array('conditions' => array('model_id'=>$model_id,'model_division_id'=>$model_subdivision_id,'model_position_id'=>$model_position_id,'deleted'=>'N'),'order'=>array('id' => 'desc'));

            if (empty($model_subdivision_id))
                $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'model_position_id' => $model_position_id, 'deleted' => 'N'), 'order' => array('id' => 'desc'));
            else
                $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_subdivision_id, 'model_position_id' => $model_position_id, 'deleted' => 'N'), 'order' => array('id' => 'desc'));

            $ModelProperties = $this->ModelProperty->find('first', $conditions);
            $model_property_id = empty($ModelProperties['ModelProperty']['id']) ? '' : $ModelProperties['ModelProperty']['id'];

            echo $model_property_id;
        }
    }

    public function lastModelEquipment() {

        $this->layout = "blank";
        $this->autoRender = false;
        $data = $this->request->data;
        $model_id = empty($data['model_id']) ? '' : $data['model_id'];
        $model_division_id = empty($data['model_division_id']) ? '' : $data['model_division_id'];

        if (!empty($model_id) && !empty($model_division_id)) {

            $conditions = array('conditions' => array('model_id' => $model_id, 'model_division_id' => $model_division_id, 'deleted' => 'N'), 'order' => array('id' => 'desc'));
            $ModelEquipments = $this->ModelEquipment->find('first', $conditions);
            $model_equipment_id = empty($ModelEquipments['ModelEquipment']['id']) ? '' : $ModelEquipments['ModelEquipment']['id'];

            echo $model_equipment_id;
        }
    }

    public function saveModelRate($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;
        $this->disableCache();
        $data = $this->request->data;
        $AuthUser = $this->Session->Read('AuthUser');
$user_id = $AuthUser['User']['id'];

$data['ModelRate']['updated_by'] = $user_id;
        if (!empty($data)) {

            $model_id = empty($data['ModelRate']['id']) ? $model_id : $data['ModelRate']['id'];
            if (!empty($model_id)) {

                $this->ModelRate->id = $model_id;
                if ($this->ModelRate->exists()) {
                    $data['ModelRate']['model_date'] = $this->DateFormat->convertDate($data['ModelRate']['model_date']);
                    $data['ModelRate']['command_user_date'] = $this->DateFormat->convertDate($data['ModelRate']['command_user_date']);
                    $data['ModelRate']['command_equipment_date'] = $this->DateFormat->convertDate($data['ModelRate']['command_equipment_date']);
                    $status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';
                } else
                    $status = 'FAILED';

                $alert_message = 'บันทึกข้อมูลเรียบร้อย';
                echo $alert_message;
            }else {

                $model_id = $this->Generator->getModelID();
                $data['ModelRate']['created_by'] = $user_id;
                $data['ModelRate']['id'] = $model_id;
                $data['ModelRate']['model_date'] = $this->DateFormat->convertDate($data['ModelRate']['model_date']);
                $data['ModelRate']['command_user_date'] = $this->DateFormat->convertDate($data['ModelRate']['command_user_date']);
                $data['ModelRate']['command_equipment_date'] = $this->DateFormat->convertDate($data['ModelRate']['command_equipment_date']);
                $data['ModelRate']['is_locked'] = 'N';
				$data['ModelRate']['is_draft'] = 'Y';
                $data['ModelRate']['model_status_id'] = 1;
                $data['ModelRate']['model_class_id'] = 1;

                $this->ModelRate->create();
                $status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';

                echo json_encode(array('status' => $status, 'id' => $model_id, 'message' => 'สร้างเรียบร้อย'));
            }
        }
    }

    /*
      public function save($model_id = null){

      $this->autoRender = false;
      $data = $this->request->data;
      pr($data);
      die();

      if(!empty($data)){

      if(!empty($model_id)){

      $this->ModelRate->id = $model_id;
      if($this->ModelRate->exists())
      $status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';
      else $status = 'FAILED';

      }else{
      $sql = "SELECT order_sort + 1 as new_order_sort  FROM ModelRates WHERE order_sort <> 99 order by order_sort desc LIMIT 1;";
      $results = $this->ModelRate->query($sql);
      $data['order_sort'] = $results[0][0]['new_order_sort'];
      $data['id'] = $this->Generator->getID();
      $this->ModelRate->create();
      $status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';
      }

      }else $status = 'FAILED';

      echo json_encode(array('status' => $status));
      }
     */

    public function delete() {

        $this->autoRender = false;
        $status = '';

        $ids = array();
        $ids = $this->request->data['ids'];

        foreach ($ids as $model_id) {

            if (!empty($model_id)) {

                $data = array();
                $data['deleted'] = "Y";
                $this->ModelRate->id = $model_id;

                if ($this->ModelRate->exists()) {
                    $status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';

                    $ModelRates = $this->getModelRate($model_id);
                    $ModelGroups = $this->getModelGroup($model_id);
                    $ModelDivisions = $this->getModelDivision($model_id);
                    $ModelSubDivisions = $this->getModelSubDivision($model_id);
                    $ModelPositions = $this->getModelPosition($model_id);
                    $ModelProperties = $this->getModelProperty($model_id);
                    $ModelEquipments = $this->getModelEquipment($model_id);

                    if (!empty($ModelRates))
                        $this->_deleteData('ModelRate', $ModelRates);
                    if (!empty($ModelGroups))
                        $this->_deleteData('ModelGroup', $ModelGroups);
                    if (!empty($ModelDivisions))
                        $this->_deleteData('ModelDivision', $ModelDivisions);
                    if (!empty($ModelSubDivisions))
                        $this->_deleteData('ModelSubDivision', $ModelSubDivisions);
                    if (!empty($ModelPositions))
                        $this->_deleteData('ModelPosition', $ModelPositions);
                    if (!empty($ModelProperties))
                        $this->_deleteData('ModelProperty', $ModelProperties);
                    if (!empty($ModelEquipments))
                        $this->_deleteData('ModelEquipment', $ModelEquipments);
                } else
                    $status = 'FAILED';
            } else
                $status = 'FAILED';
        }

        echo json_encode(array('status' => $status));
    }

    public function deleteItem() {

        $this->layout = 'blank';
        $this->autoRender = false;
        $data = $this->request->data;
        $id = empty($data['id']) ? '' : $data['id'];
        $model = empty($data['model']) ? '' : $data['model'];

        if (!empty($id) && !empty($model)) {

            $savedata = array();
            if ($model == 'division')
                $ModelName = 'ModelDivision';
            if ($model == 'subdivision')
                $ModelName = 'ModelSubDivision';
            if ($model == 'position')
                $ModelName = 'ModelPosition';
            if ($model == 'property')
                $ModelName = 'ModelProperty';
            if ($model == 'equipment')
                $ModelName = 'ModelEquipment';
            if ($model == 'modelgroup')
                $ModelName = 'ModelGroup';

            $savedata[$ModelName]['id'] = $id;
            $savedata[$ModelName]['deleted'] = 'Y';
            $this->$ModelName->save($savedata);
        }
    }

    //public function action() {
    //	$this->layout = 'blank';
    //}
    public function editRateProperty() {

        $this->layout = 'blank';
        $data = $this->request->data;
        $model_id = $data['model_id'];
        //$model_id = 1005;

        $whereConditions = array();
        $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'conditions' => $whereConditions,
            'fields' => array('model_type_id')
        );
        $ModelRates = $this->ModelRate->find('first', $conditions);
        $model_type_id = $ModelRates['ModelRate']['model_type_id'];

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        $whereConditions['model_division_type'] = 'property';

        //-----------------------------------------------------------------------------
        if ($model_type_id == 1) {
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 3
            );
            $ModelDivisions = $this->ModelDivision->find('all', $conditions);
        } else if ($model_type_id == 2) {
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 4
            );
            $ModelDivisions = $this->ModelDivisionSpecial->find('all', $conditions);
        }

        $this->set('model_id', $model_id);
        $this->set('model_type_id', $model_type_id);
        $this->set('ModelDivisions', $ModelDivisions);

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Corps = $this->Corp->find('list', $conditions);
$this->set('Corps', $Corps);

 $conditions2 = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Ranks = $this->Rank->find('list', $conditions2);
        
        $this->set('Ranks', $Ranks);

        $conditions = array('conditions' => array('deleted' => 'N'), 'fields' => array('id', 'name'), 'cache' => 'longIdList', 'cacheConfig' => 'long');
        $Weapons = $this->Weapon->find('list', $conditions);
        $this->set('Weapons', $Weapons);
    }

    public function editRateEquipment() {

        set_time_limit(0);
        ini_set('memory_limit', '3000M');

        $this->layout = 'blank';
        $data = $this->request->data;
        $model_id = $data['model_id'];
        //$model_id = 1005;

        $whereConditions = array();
        $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'conditions' => $whereConditions,
            'fields' => array('model_type_id')
        );
        $ModelRates = $this->ModelRate->find('first', $conditions);
        $model_type_id = $ModelRates['ModelRate']['model_type_id'];

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        if ($model_type_id == 2)
            $model_division_type = 'equipment';
        if (!empty($model_division_type))
            $whereConditions['model_division_type'] = $model_division_type;

        $conditions = array(
            'order' => array('order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'recursive' => 3
        );
        $ModelDivisionEquipments = $this->ModelDivisionEquipment->find('all', $conditions);

        $this->set('model_id', $model_id);
        $this->set('model_type_id', $model_type_id);
        $this->set('ModelDivisionEquipments', $ModelDivisionEquipments);
    }

    public function detailRateProperty($model_id = null) {

        $this->layout = 'blank';
        $data = $this->request->data;
        $model_id = empty($data['model_id']) ? $model_id : $data['model_id'];
        if (empty($model_id))
            $model_id = 0;
        //$model_id = 1005;

        $whereConditions = array();
        $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array('conditions' => $whereConditions);
        $ModelRates = $this->ModelRate->find('first', $conditions);
        $model_type_id = (!empty($ModelRates['ModelRate']['model_type_id']) ? $ModelRates['ModelRate']['model_type_id'] : "0");
        $this->set('ModelRates', $ModelRates);

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        $whereConditions['model_division_type'] = 'property';

        if ($model_type_id == 1) {
            $conditions = array(
                'order' => array('id' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 3
            );
            $ModelDivisions = $this->ModelDivision->find('all', $conditions);

            $this->set('ModelDivisions', $ModelDivisions);
        } else if ($model_type_id == 2) {
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 4
            );
            $ModelDivisionSpecialProperties = $this->ModelDivisionSpecialProperty->find('all', $conditions);

            $this->set('ModelDivisionSpecialProperties', $ModelDivisionSpecialProperties);
        }

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);
        $Corps = $this->Corp->find('list', $conditions);
        $Ranks = $this->Rank->find('list', $conditions);
        $this->set('ModelTypeShorts', $ModelTypeShorts);
        $this->set('Corps', $Corps);
        $this->set('Ranks', $Ranks);
    }

    public function enableRateProperty($model_id = null) {

        $this->layout = 'blank';
        $data = $this->request->data;
        $model_id = empty($data['model_id']) ? $model_id : $data['model_id'];
        if (empty($model_id))
            $model_id = 0;
        //$model_id = 1005;

        $whereConditions = array();
        $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array('conditions' => $whereConditions);
        $ModelRates = $this->ModelRate->find('first', $conditions);
        $model_type_id = (!empty($ModelRates['ModelRate']['model_type_id']) ? $ModelRates['ModelRate']['model_type_id'] : "0");
        $this->set('ModelRates', $ModelRates);

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        $whereConditions['model_division_type'] = 'property';

        if ($model_type_id == 1) {
            $conditions = array(
                'order' => array('id' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 3
            );
            $ModelDivisions = $this->ModelDivision->find('all', $conditions);

            $this->set('ModelDivisions', $ModelDivisions);
        } else if ($model_type_id == 2) {
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 4
            );
            $ModelDivisionSpecialProperties = $this->ModelDivisionSpecialProperty->find('all', $conditions);

            $this->set('ModelDivisionSpecialProperties', $ModelDivisionSpecialProperties);
        }

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);
        $Corps = $this->Corp->find('list', $conditions);
        $Ranks = $this->Rank->find('list', $conditions);

        $this->set('ModelTypeShorts', $ModelTypeShorts);
        $this->set('Corps', $Corps);
        $this->set('Ranks', $Ranks);
        $this->set('model_id', $model_id);
    }

    public function detailRateEquipment($model_id = null) {

        $this->layout = 'blank';
        $data = $this->request->data;
        $model_id = empty($data['model_id']) ? $model_id : $data['model_id'];
        //$model_id = 1005;

        $whereConditions = array();
        $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array('conditions' => $whereConditions);
        $ModelRates = $this->ModelRate->find('first', $conditions);
        $model_type_id = $ModelRates['ModelRate']['model_type_id'];
        $this->set('ModelRates', $ModelRates);

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';
        if ($model_type_id == 1) {

            $model_division_type = 'property';
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 3
            );
            $ModelDivisionEquipments = $this->ModelDivisionEquipment->find('all', $conditions);
            $this->set('ModelDivisions', $ModelDivisionEquipments);
            $this->set('KeyModelDivisionName', 'ModelDivisionEquipment');
        } else if ($model_type_id == 2) {

            $model_division_type = 'equipment';
            $whereConditions['model_division_type'] = 'equipment';
            $conditions = array(
                'order' => array('order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'recursive' => 4
            );
            $ModelDivisionSpecialEquipments = $this->ModelDivisionSpecialEquipment->find('all', $conditions);
            $this->set('ModelDivisionSpecialEquipments', $ModelDivisionSpecialEquipments);
        }

        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdShortNameList', 'cacheConfig' => 'long');
        $ModelTypeShorts = $this->ModelType->find('list', $conditions);
        $this->set('ModelTypeShorts', $ModelTypeShorts);
    }

    public function assignProperty() {
        $this->layout = 'blank';
    }

    public function assignEquipment() {
        $this->layout = 'blank';
    }

    public function lockModelRate($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;
        $this->disableCache();
        $data = $this->request->data;

        if (!empty($data)) {

            $model_id = $data['model_id'];
            $is_locked = $data['is_locked'];
$is_group = $data['is_group'];
            if ($is_locked == 'Y') {
                $is_locked = 'N';
            } else {
                $is_locked = 'Y';
            }

            $data = array();
            $data['ModelRate']['id'] = $model_id;
            $data['ModelRate']['is_locked'] = $is_locked;
$data['ModelRate']['is_group'] = $is_group;
            //$this->ModelRate->id = $model_id;
            //if($this->ModelRate->exists())
            $status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED';
            //else $status = 'FAILED';

            echo json_encode(array('status' => $status, 'id' => $model_id, 'message' => 'ล๊อคข้อมูลเรียบร้อย'));
        }
    }
    
    public function masscopy($model_id,$model_code){
     $this->layout = 'blank';
        $this->autoRender = false;
        $i = 59;
        for($i = 59;$i<=365;$i++)     
        {
        	echo "copy $model_code - " . $i . $this->copyModelRate($model_id,$model_code . "-" . $i) . "<br />";
        }
    }

    public function copyModelRate($model_id = null,$model_code = null) {

        //set_time_limit(0);
        //ini_set('memory_limit','3000M');
$AuthUser = $this->Session->Read('AuthUser');
$user_id = $AuthUser['User']['id'];
        $this->layout = 'blank';
        $this->autoRender = false;

        $data = $this->request->data;
        if(isset($data['model_id']))
        $model_id = $data['model_id'];
        //$model_id = '';
        //pr($model_id);
        //die;
		
        $ModelRates = $this->getModelRate($model_id);
        $model_type_id = $ModelRates['ModelRate']['model_type_id'];
        $ModelGroups = $this->getModelGroup($model_id);
        $ModelDivisions = $this->getModelDivision($model_id);
        $ModelSubDivisions = array();
        if ($model_type_id == 2)
            $ModelSubDivisions = $this->getModelSubDivision($model_id);
        $ModelPositions = $this->getModelPosition($model_id);
        $ModelProperties = $this->getModelProperty($model_id);
        $ModelEquipments = $this->getModelEquipment($model_id);

	

        //------------------------------------------------------------------------------------
        $model_id = $this->Generator->getID();

        $data = array();
        $data = $ModelRates;
        $data['ModelRate']['id'] = $model_id;
        $data['ModelRate']['created_by'] = $user_id;
        $data['ModelRate']['name'] = $ModelRates['ModelRate']['name'] . ' ( สำเนา)';
        if(isset($model_code))
     	   $data['ModelRate']['code'] = $model_code;
       $data['ModelRate']['short_name'] .= ' ( สำเนา)';
        $data['ModelRate']['model_status_id'] = 1;

        $this->ModelRate->create();
        $this->ModelRate->save($data);

        $order_sort = 1;
        $data = array();
        $NewModelGroup = array();
   //     echo "Model Group <br />";
		foreach ($ModelGroups as $ModelGroup) {

            $data = $ModelGroup;
            $new_id = $this->Generator->getID();
            $NewModelDivision[$data['ModelGroup']['id']] = $new_id;
            $data['ModelGroup']['id'] = $new_id;
            $data['ModelGroup']['model_parent_id'] = $model_id;
            $data['ModelGroup']['order_sort'] = $order_sort;
            $order_sort++;

            $this->ModelGroup->create();
            $this->ModelGroup->save($data);
//			print_r($data);
//			echo "<br />";
        }
		
		
        $order_sort = 1;
        $data = array();
        $NewModelDivision = array();
//		echo "<hr />ModelDivisions<br />";
        foreach ($ModelDivisions as $ModelDivision) {

            $data = $ModelDivision;
            $new_id = $this->Generator->getID();
            $NewModelDivision[$data['ModelDivision']['id']] = $new_id;
            $data['ModelDivision']['id'] = $new_id;
            $data['ModelDivision']['model_id'] = $model_id;
            $data['ModelDivision']['order_sort'] = $order_sort;
		
            $order_sort++;

            $this->ModelDivision->create();
            $this->ModelDivision->save($data);
			//print_r($data);
			//echo "<br />";
        }

        $order_sort = 1;
        $data = array();
        $NewModelSubDivision = array();
		//echo "<hr />ModelSubDivisions<br />";
        foreach ($ModelSubDivisions as $ModelSubDivision) {

            $data = $ModelSubDivision;
            $new_id = $this->Generator->getID();
            $NewModelSubDivision[$data['ModelSubDivision']['id']] = $new_id;
            $data['ModelSubDivision']['id'] = $new_id;
            $data['ModelSubDivision']['model_id'] = $model_id;
            $data['ModelSubDivision']['model_division_id'] = $NewModelDivision[$data['ModelSubDivision']['model_division_id']];
         //    $data['ModelSubDivision']['model_division_id'] = $ModelSubDivision[$data['ModelSubDivision']['model_division_id']];
            //$data['ModelSubDivision']['order_sort'] = $order_sort;
            $order_sort++;
            //unset($data['ModelSubDivision']['

            $this->ModelSubDivision->create();
            $this->ModelSubDivision->save($data);
			//print_r($data);
			//echo "<br />";
        }

        $data = array();
        $NewModelPosition = array();
		//echo "<hr />ModelPositions<br />";
        foreach ($ModelPositions as $ModelPosition) {

            $data = $ModelPosition;
            $new_id = $this->Generator->getID();
            $NewModelPosition[$data['ModelPosition']['id']] = $new_id;
            $data['ModelPosition']['id'] = $new_id;
            $data['ModelPosition']['model_id'] = $model_id;
            $data['ModelPosition']['model_division_id'] = $NewModelDivision[$data['ModelPosition']['model_division_id']];
            if (!empty($NewModelSubDivision))
                $data['ModelPosition']['model_subdivision_id'] = $NewModelSubDivision[$data['ModelPosition']['model_subdivision_id']];

            $this->ModelPosition->create();
            $this->ModelPosition->save($data);
			//print_r($data);
			//echo "<br />";
        }

        $data = array();
		//echo "<hr />ModelProperties<br />";
        foreach ($ModelProperties as $ModelProperty) {

            $data = $ModelProperty;
            $data['ModelProperty']['id'] = $this->Generator->getID();
            $data['ModelProperty']['model_id'] = $model_id;
            $data['ModelProperty']['model_division_id'] = $NewModelDivision[$data['ModelProperty']['model_division_id']];
            //if(!empty($NewModelSubDivision)) $data['ModelProperty']['model_subdivision_id'] = $NewModelDivision[$data['ModelProperty']['model_subdivision_id']];
            $data['ModelProperty']['model_position_id'] = $NewModelPosition[$data['ModelProperty']['model_position_id']];

            $this->ModelProperty->create();
            $this->ModelProperty->save($data);
			//print_r($data);
		//	echo "<br />";
        }

        $data = array();
		//echo "<hr />ModelEquipments<br />";
        foreach ($ModelEquipments as $ModelEquipment) {

            $data = $ModelEquipment;
            $data['ModelEquipment']['id'] = $this->Generator->getID();
            $data['ModelEquipment']['model_id'] = $model_id;
            $data['ModelEquipment']['model_division_id'] = $NewModelDivision[$data['ModelEquipment']['model_division_id']];

            $this->ModelEquipment->create();
            $this->ModelEquipment->save($data);
			//print_r($data);
			//echo "<br />";
        }

        $status = $this->ModelRate->save($data) ? 'SUCCESS' : 'FAILED'; 
        //$status = 'SUCCESS';
        echo json_encode(array('status' => $status, 'id' => $model_id));
    }

    public function printModelRate($page = null, $model_id = null, $mode = null, $subMode = null) {

        $this->layout = 'blank';
        $model_type_id = '';

        if (!empty($model_id)) {

            $whereConditions = array();
            $whereConditions['id'] = $model_id;
            $whereConditions['deleted'] = 'N';

            $conditions = array(
                'conditions' => $whereConditions,
                'order' => array('order_sort' => 'asc')
            );
            $ModelRates = $this->ModelRate->find('first', $conditions);
            $model_type_id = $ModelRates['ModelRate']['model_type_id'];

            //$model_type_id = 1;
            //$mode = 'Decrease3'; //Group , Decrease3;

            if ($model_type_id == 1) {

                if ($mode == 'Group') {

                    $conditions = array('conditions' => array('model_parent_id' => $model_id, 'deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'model_id', 'quantity', 'code', 'name','quantity_decrease1','quantity_decrease2','quantity_decrease3','quantity_struct'));
                    $b_ModelGroups = $this->ModelGroup->find('all', $conditions);
					foreach($b_ModelGroups as $b){
						$conditions = array('conditions' => array('id'=>$b['ModelGroup']['model_id'],'deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name','is_group'));
						$ModelRates = $this->ModelRate->find('first',$conditions);
						$b['ModelGroup']['is_group'] = $ModelRates['ModelRate']['is_group'];
						
						$ModelGroups[] = $b;
					}
                    if ($page == 'Property') { /* อจย ตอน 3 รวม */

                        $ModelDivisions = array();
                        $Model = array();
                        foreach ($ModelGroups as $ModelGroup) {

							if( $ModelGroup['ModelGroup']['is_group']=="Y"){
							
								 $conditions = array('conditions' => array('model_parent_id' => $ModelGroup['ModelGroup']['model_id'], 'deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'model_id', 'quantity', 'code', 'name','quantity_decrease1','quantity_decrease2','quantity_decrease3','quantity_struct'));
                    			$b2_ModelGroups = $this->ModelGroup->find('all', $conditions);
								$model_i = array('0');
								foreach($b2_ModelGroups as $b2){
									
									$model_i[]= $b2['ModelGroup']['model_id'];
									
								}
								
								$model_in = implode(",",$model_i);
								
							
							$ModelProperty = $this->ModelProperty->query('SELECT "ModelProperty"."rank_id" AS "ModelProperty__rank_id", (SUM("rate_full" * "ModelGroup"."quantity") ) as rate_full, SUM("rate_decrease_1" * "ModelGroup"."quantity_decrease1") as rate_decrease_1, SUM("rate_decrease_2" * "ModelGroup"."quantity_decrease2") as rate_decrease_2, SUM("rate_decrease_3" * "ModelGroup"."quantity_decrease3") as rate_decrease_3, SUM("rate_structure" * "ModelGroup"."quantity_struct") as rate_structure FROM "dopns"."model_properties" AS "ModelProperty" 
left join "dopns"."model_groups" as "ModelGroup" on "ModelGroup"."model_id"="ModelProperty"."model_id" and "ModelGroup"."model_parent_id"=' . "'" .$ModelGroup['ModelGroup']['model_id']. "'" . '

WHERE "ModelProperty"."deleted"=' . "'N'" .'  and "ModelProperty".model_id in (' . $model_in . ') GROUP BY "ModelProperty".rank_id ORDER BY "ModelProperty"."rank_id" asc');

                            array_push($ModelDivisions, $ModelProperty);
                           	 $Model[] = $ModelGroup['ModelGroup']['model_id'] ;
							}else{

                            $conditions = array('conditions' => array('model_id' => $ModelGroup['ModelGroup']['model_id'], 'deleted' => 'N'), 'group' => array('rank_id'), 'order' => array('rank_id' => 'asc'), 'fields' => array('rank_id', 'SUM(rate_full) as rate_full', 'SUM(rate_decrease_1) as rate_decrease_1', 'SUM(rate_decrease_2) as rate_decrease_2', 'SUM(rate_decrease_3) as rate_decrease_3', 'SUM(rate_structure) as rate_structure'));
                            $ModelProperty = $this->ModelProperty->find('all', $conditions);
							
                            array_push($ModelDivisions, $ModelProperty);
                            $Model[] = $ModelGroup['ModelGroup']['model_id'] ;
							}

                        }
						
						
//pr($ModelDivisions);die;
                        //$conditions = array('conditions' => array('id'=>$Model,'deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'));
                        //$ModelRates = $this->ModelRate->find('list',$conditions);
                        //pr($ModelRates);
                        //die;
                    } else if ($page == 'Equipment') { /* อจย ตอน 4 รวม */

                        $conditions = array('conditions' => array('model_parent_id' => $model_id, 'deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('model_id', 'quantity'));
                        $ModelGroups = $this->ModelGroup->find('all', $conditions);

                        $ModelGroup = array();
                        foreach ($ModelGroups as $a) {
                            $ModelGroup[] = $a['ModelGroup']['model_id'];
                        }

                        $ModelDivisions = array();

                        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'));
                        $Techs = $this->Tech->find('all', $conditions);
                        foreach ($Techs as $Tech) {

                            $ModelEquipments = array();
                            //foreach($ModelGroups as $ModelGroup){
                            $conditions = array('conditions' => array('ModelEquipment.model_id' => $ModelGroup, 'ModelGroup.model_parent_id' => $model_id,
                                    'ModelEquipment.tech_id' => $Tech['Tech']['id'], 'ModelEquipment.deleted' => 'N', 'ModelGroup.deleted' => 'N'),
                                'group' => array('ModelEquipment.equipment_code', 'ModelEquipment.equipment_name'),
                                'order' => array('ModelEquipment.equipment_code' => 'asc'),
                                'fields' => array('ModelEquipment.equipment_code', 'ModelEquipment.equipment_name', 'SUM(rate_full * CAST("ModelGroup"."quantity" AS integer)) as rate_full', 'SUM(rate_decrease_1 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_1', 'SUM(rate_decrease_2 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_2', 'SUM(rate_decrease_3 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_3', 'SUM(rate_structure * CAST("ModelGroup"."quantity" AS integer)) as rate_structure'),
                                'joins' => array(array('table' => 'model_equipments', 'alias' => 'ModelEquipment', 'type' => 'INNER', 'conditions' => array('ModelEquipment.model_id = ModelGroup.model_id'))));

                            $ModelEquipments = $this->ModelGroup->find('all', $conditions);

                            array_push($ModelDivisions, $ModelEquipments);
                        }
                        $this->set('Techs', $Techs);
                    }

                    if (!empty($subMode)) {
                        $mode = $mode . $subMode;
                    }
                    $this->set('ModelGroups', $ModelGroups);
                } else {

                    $ModelDivisions = array();
                    $conditions = array(
                        'order' => array('order_sort' => 'asc'),
                        'conditions' => $whereConditions,
                        'recursive' => 3
                    );

                    $ModelDivisions = $this->ModelRateProperty->find('all', $conditions);
                }
            } else if ($model_type_id == 2) {

                /*
                  $conditions = array(
                  'order' =>  array('order_sort' => 'asc'),
                  'conditions' => $whereConditions,
                  'recursive' => 4
                  );
                  $ModelDivisions = $this->ModelRateProperty->find('all',$conditions);
                 */

                $whereConditions = array();
                $whereConditions[] = "model_id = '" . $model_id . "'";
                $whereConditions['deleted'] = 'N';

                if ($page == 'Property') { // อฉก ตอน 3
                    $whereConditions['model_division_type'] = 'property';
                    $conditions = array(
                        'order' => array('order_sort' => 'asc'),
                        'conditions' => $whereConditions,
                        'recursive' => 4
                    );
                    $ModelDivisions = $this->ModelDivisionSpecialProperty->find('all', $conditions);
                } else if ($page == 'Equipment') { // อฉก ตอน 5
                    $whereConditions['model_division_type'] = 'equipment';
                    $conditions = array(
                        'order' => array('order_sort' => 'asc'),
                        'conditions' => $whereConditions,
                        'recursive' => 4
                    );
                    $ModelDivisions = $this->ModelDivisionSpecialEquipment->find('all', $conditions);
                }
            }

            $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'short_name'), 'cache' => 'longIdShortNameList', 'cacheConfig' => 'long');
            $ModelTypeShorts = $this->ModelType->find('list', $conditions);
            $Corps = $this->Corp->find('list', $conditions);
            $Ranks = $this->Rank->find('list', $conditions);

            $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'), 'cache' => 'longIdNameList', 'cacheConfig' => 'long');
            $Techs = $this->Tech->find('list', $conditions);
        }

        $this->set('page', $page);
        $this->set('model_type_id', $model_type_id);
        $this->set('mode', $mode);

        $this->set('ModelRates', $ModelRates);
        $this->set('ModelDivisions', $ModelDivisions);

        $this->set('ModelTypeShorts', $ModelTypeShorts);
        $this->set('Corps', $Corps);
        $this->set('Ranks', $Ranks);

        $this->set('Techs', $Techs);
    }

    public function printPdf() {

        $this->layout = 'blank';
    }

    public function getModelRate($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;

        $whereConditions = array();
        $whereConditions[] = "id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'conditions' => $whereConditions,
            'fields' => array('id', 'code', 'name', 'model_category_id', 'comment_user', 'comment_equipment', 'comment', 'model_type_id', 'model_class_id', 'is_group','short_name')
        );
        $ModelRates = $this->ModelRate->find('first', $conditions);

        return $ModelRates;
    }

    public function getModelGroup($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;

        $whereConditions = array();
        $whereConditions[] = "model_parent_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'order' => array('order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('model_id', 'order_sort', 'name', 'quantity', 'comment', 'model_parent_id')
        );
        $ModelGroups = $this->ModelGroup->find('all', $conditions);

        return $ModelGroups;
    }

    public function getModelDivision($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'order' => array('order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('id', 'order_sort', 'name', 'comment', 'division_id','model_division_type')
        );
        $ModelDivisions = $this->ModelDivision->find('all', $conditions);

        return $ModelDivisions;
    }

    public function getModelSubDivision($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'order' => array('model_division_id' => 'asc', 'order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('id', 'order_sort', 'name', 'comment', 'model_id', 'model_division_id', 'subdivision_id','report_piority')
        );
        $ModelSubDivisions = $this->ModelSubDivision->find('all', $conditions);

        return $ModelSubDivisions;
    }

    public function getModelPosition($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'order' => array('model_id', 'model_division_id' => 'asc', 'model_subdivision_id' => 'asc', 'order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('id', 'order_sort', 'name', 'comment', 'model_id', 'model_division_id', 'model_subdivision_id', 'position_id', 'short_name')
        );
        $ModelPositions = $this->ModelPosition->find('all', $conditions);

        return $ModelPositions;
    }

    public function getModelProperty($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'order' => array('model_division_id' => 'asc', 'model_position_id' => 'asc', 'corp_id' => 'asc', 'rank_id' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('id', 'order_sort', 'model_id', 'model_division_id', 'model_subdivision_id', 'model_position_id', 'rate_full', 'rate_decrease_1', 'rate_decrease_2', 'rate_decrease_3', 'rate_structure', 'comment', 'weapon_id', 'rank_id', 'corp_id', 'mos')
        );
        $ModelProperties = $this->ModelProperty->find('all', $conditions);

        return $ModelProperties;
    }

    public function getModelEquipment($model_id = null) {

        $this->layout = 'blank';
        $this->autoRender = false;

        $whereConditions = array();
        $whereConditions[] = "model_id = '" . $model_id . "'";
        $whereConditions['deleted'] = 'N';

        $conditions = array(
            'order' => array('model_division_id' => 'asc', 'order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('id', 'model_id', 'model_division_id', 'equipment_id', 'equipment_code', 'rate_full', 'rate_decrease_1', 'rate_decrease_2', 'rate_decrease_3', 'rate_structure', 'comment', 'equipment_name', 'tech_id')
        );
        $ModelEquipments = $this->ModelEquipment->find('all', $conditions);

        return $ModelEquipments;
    }

    function _deleteData($ModelName, $datas) {
        $savedata = array();
        foreach ($datas as $data) {
            $savedata[$ModelName]['id'] = $data[$ModelName]['id'];
            $savedata[$ModelName]['deleted'] = 'Y';
            $this->$ModelName->save($savedata);
        }
    }

    function setModelDivisionStatus() {
        $mdid = $_REQUEST['model_division_id'];
        $enable = $_REQUEST['type_id'];
        $savedata['id'] = $mdid;
        $savedata['enable'] = $enable;
        $this->ModelDivision->save($savedata);
        $whereConditions = array();
        $whereConditions['model_division_id'] = $mdid;
        $whereConditions['deleted'] = 'N';
        $conditions = array(
            'order' => array('model_division_id' => 'asc', 'order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('id')
        );
        $ModelPositions = $this->ModelPosition->find('all', $conditions);
        //print_r($ModelPositions);
        foreach ($ModelPositions as $m_Position) {
            $mpid = $m_Position['ModelPosition']['id'];
            $savedata['id'] = $mpid;
            $savedata['enable'] = $enable;
            $this->ModelPosition->save($savedata);
            $whereConditions = array();
            $whereConditions['model_position_id'] = $mpid;
            $whereConditions['deleted'] = 'N';
            $conditions = array(
                'order' => array('model_division_id' => 'asc', 'order_sort' => 'asc'),
                'conditions' => $whereConditions,
                'fields' => array('id')
            );
            $ModelProperties = $this->ModelProperty->find('all', $conditions);

            foreach ($ModelProperties as $m_Property) {

                $mppid = $m_Property['ModelProperty']['id'];
                $savedata['id'] = $mppid;
                $savedata['enable'] = $enable;
                $this->ModelProperty->save($savedata);
            }
        }
        die("ปรับปรุงเสร็จสิ้น");
    }

    function setModelPositionStatus() {
        $mpid = $_POST['model_position_id'];
        $enable = $_POST['type_id'];
        $savedata['id'] = $mpid;
        $savedata['enable'] = $enable;
        $this->ModelPosition->save($savedata);
        $whereConditions = array();
        $whereConditions['model_position_id'] = $mpid;
        $whereConditions['deleted'] = 'N';
        $conditions = array(
            'order' => array('model_division_id' => 'asc', 'order_sort' => 'asc'),
            'conditions' => $whereConditions,
            'fields' => array('id')
        );
        $ModelProperties = $this->ModelProperty->find('all', $conditions);

        foreach ($ModelProperties as $m_Property) {

            $mppid = $m_Property['ModelProperty']['id'];
            $savedata['id'] = $mppid;
            $savedata['enable'] = $enable;
            $this->ModelProperty->save($savedata);
        }
        die("ปรับปรุงเสร็จสิ้น");
    }

    function setModelPropertyStatus($id=null) {
        $savedata['id'] = $_POST['model_property_id'];
        $savedata['enable'] = $_POST['type_id'];
        $this->ModelProperty->save($savedata);
        die("ปรับปรุงเสร็จสิ้น");
    }
	function getWeaponName($id,$model_rate_property_id){
		$this->autoRender = false;
		$weapons = $this->Weapon->find('first', array(
			'conditions' => array('id' => $id)
		));
		$w_name = $weapons['Weapon']['name'];
		
		$this->ModelProperty->updateAll(
    array( 'weapon_name' => "'".  $w_name . "'" ),   //fields to update
    array( 'id' => $model_rate_property_id )  //condition
);

		return $w_name;
	//	echo " W - " . $id;
		
	}
	public function saveDocument($model_id,$type){
		print_r($_FILES);

		$name = $_FILES["upload_army_doc"]["name"];
		$ext = end((explode(".", $name))); 
		$id = $this->Generator->getID();
		$file_src = $id . "." . $ext;
	
		$data['model_id'] = $model_id;
		$data['type'] = $type;                        
		$data['id'] = $id;
		$data['file_src'] = $file_src;
		$data['status'] =1;
		$data['origin'] = $_FILES['upload_army_doc']['name'];
		$this->ModelFile->create();
		$status = $this->ModelFile->save($data) ? 'SUCCESS' : 'FAILED';
		
		
		$dir = $this->file_path . "/" . $data['model_id'];
						//echo $dir;
		if (!file_exists($dir) && !is_dir($dir)) {
			mkdir($dir);         
		} 
		
		echo $dir;
	
		$tmp_name =   $_FILES["upload_army_doc"]['tmp_name'];

		copy($tmp_name,$dir . "/" . $file_src ) ;
		
		$this->autoRender = false;
		
	}
	
	public function removeDocument(){
		$id = $_REQUEST['document_id'];
		$this->autoRender = false;  
		$status = '';		
			if(!empty($id)){

				$data = array();
				$data['deleted'] = "Y";
				$this->ModelFile->id = $id;
				if($this->ModelFile->exists())
					$status = $this->ModelFile->save($data) ? 'SUCCESS' : 'FAILED'; 
				else $status = 'FAILED';    

			}else $status =  'FAILED';                                      
				
		
					
		echo json_encode(array('status' => $status));
	}
	
	public function getChildGroup($model_id){
		$conditions = array('conditions' => array('model_parent_id' => $model_id, 'deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'model_id', 'quantity', 'code', 'name','quantity_decrease1','quantity_decrease2','quantity_decrease3','quantity_struct'));
                    $b_ModelGroups = $this->ModelGroup->find('all', $conditions);
					foreach($b_ModelGroups as $b){
						$conditions = array('conditions' => array('id'=>$b['ModelGroup']['model_id'],'deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name','is_group'));
						$ModelRates = $this->ModelRate->find('first',$conditions);
						$b['ModelGroup']['is_group'] = $ModelRates['ModelRate']['is_group'];
						
						$ModelGroups[] = $b;
					}
                    if ($page == 'Property') { /* อจย ตอน 3 รวม */

                        $ModelDivisions = array();
                        $Model = array();
                        foreach ($ModelGroups as $ModelGroup) {

							

                            $conditions = array('conditions' => array('model_id' => $ModelGroup['ModelGroup']['model_id'], 'deleted' => 'N'), 'group' => array('rank_id'), 'order' => array('rank_id' => 'asc'), 'fields' => array('rank_id', 'SUM(rate_full) as rate_full', 'SUM(rate_decrease_1) as rate_decrease_1', 'SUM(rate_decrease_2) as rate_decrease_2', 'SUM(rate_decrease_3) as rate_decrease_3', 'SUM(rate_structure) as rate_structure'));
                            $ModelProperty = $this->ModelProperty->find('all', $conditions);
                            array_push($ModelDivisions, $ModelProperty);
                            $Model[] = $ModelGroup['ModelGroup']['model_id'] ;

                        }
						
						
//pr($ModelDivisions);die;
                        //$conditions = array('conditions' => array('id'=>$Model,'deleted' => 'N'),'order'=>array('order_sort' => 'asc'),'fields' => array('id','name'));
                        //$ModelRates = $this->ModelRate->find('list',$conditions);
                        //pr($ModelRates);
                        //die;
                    } else if ($page == 'Equipment') { /* อจย ตอน 4 รวม */

                        $conditions = array('conditions' => array('model_parent_id' => $model_id, 'deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('model_id', 'quantity'));
                        $ModelGroups = $this->ModelGroup->find('all', $conditions);

                        $ModelGroup = array();
                        foreach ($ModelGroups as $a) {
                            $ModelGroup[] = $a['ModelGroup']['model_id'];
                        }

                        $ModelDivisions = array();

                        $conditions = array('conditions' => array('deleted' => 'N'), 'order' => array('order_sort' => 'asc'), 'fields' => array('id', 'name'));
                        $Techs = $this->Tech->find('all', $conditions);
                        foreach ($Techs as $Tech) {

                            $ModelEquipments = array();
                            //foreach($ModelGroups as $ModelGroup){
                            $conditions = array('conditions' => array('ModelEquipment.model_id' => $ModelGroup, 'ModelGroup.model_parent_id' => $model_id,
                                    'ModelEquipment.tech_id' => $Tech['Tech']['id'], 'ModelEquipment.deleted' => 'N', 'ModelGroup.deleted' => 'N'),
                                'group' => array('ModelEquipment.equipment_code', 'ModelEquipment.equipment_name'),
                                'order' => array('ModelEquipment.equipment_code' => 'asc'),
                                'fields' => array('ModelEquipment.equipment_code', 'ModelEquipment.equipment_name', 'SUM(rate_full * CAST("ModelGroup"."quantity" AS integer)) as rate_full', 'SUM(rate_decrease_1 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_1', 'SUM(rate_decrease_2 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_2', 'SUM(rate_decrease_3 * CAST("ModelGroup"."quantity" AS integer)) as rate_decrease_3', 'SUM(rate_structure * CAST("ModelGroup"."quantity" AS integer)) as rate_structure'),
                                'joins' => array(array('table' => 'model_equipments', 'alias' => 'ModelEquipment', 'type' => 'INNER', 'conditions' => array('ModelEquipment.model_id = ModelGroup.model_id'))));

                            $ModelEquipments = $this->ModelGroup->find('all', $conditions);

                            array_push($ModelDivisions, $ModelEquipments);
                        }
                        $this->set('Techs', $Techs);
                    }

                    if (!empty($subMode)) {
                        $mode = $mode . $subMode;
                    }
					return $ModelGroups;
                    //$this->set('ModelGroups', $ModelGroups);
					//$this->render('getchildgroup');
					
	}
	

}

?>