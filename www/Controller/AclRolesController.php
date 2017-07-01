<?php
App::uses('AppController', 'Controller');

class AclRolesController extends AppController {

	public $name = 'AclRoles';
	public $uses = array('AclRole','AclRoleAction','AclAction');
	public $components = array("FileStorageComponent","Generator");

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
                    $total = $this->AclRole->find('count',$conditions);
                    $AclRoles = $this->AclRole->find('all',$conditions); 
          
                                     
                }else{
                    
                    $default = array();
                    $default = $dataRequest;
                    $this->set('default',$default);
                    //intitial
                    $whereConditions = array();
                    $whereConditions['deleted'] = 'N';
                    
                    $offset = $dataRequest['offset'];
                    
                    $name = $dataRequest['name'];
                    

                    if(!empty($name))
                    $whereConditions[] = 'name ILIKE \'%'.$name.'%\'';
                    
                    $conditions = array('limit' =>  $this->Generator->setLimit(),'offset' => $offset,
                                        'order' =>  array('order_sort' => 'asc'),
                                        'conditions' => $whereConditions
                                       ); 
                    $total = $this->AclRole->find('count', array('conditions' => $whereConditions ));
                    $AclRoles = $this->AclRole->find('all',$conditions); 
    
                    
                    
                }              
                     
                    
                    
                $breadcrumb = array (   'controller' => array(   
                                        'name' => 'ข้อมูลทัพภาค' ,
                                        'url' => ''
                                        )
                );
                $this->set('breadcrumb',$breadcrumb);  
                $this->set('AclRoles',$AclRoles);  
                $pagination = array('offset' => $offset , 'total' => $total , 'limit' => $this->Generator->setLimit(), 'model' => 'AclRole','pages' => 5);
                $this->set('pagination',$pagination);                    
	}

	public function form($id = null) {
			
            $this->disableCache();
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
                    $AclRoles = $this->AclRole->find('all',$conditions); 
					//pr($AclRoles);
                    
                    foreach($AclRoles[0]['AclRole'] as $key => $value)
                        $default[$key] = $value;
                    
					//-----------------------------------------------------------------------------------------------
                    $whereConditions = array();
                    $whereConditions['deleted'] = 'N';
                    $conditions = array(
										'fields' => array('id','name'),
										'order' =>  array('id' => 'asc'),
                                        'conditions' => $whereConditions
                                       );
					$AclActions = $this->AclAction->find('list',$conditions);
					//pr($AclActions);
					
					//-----------------------------------------------------------------------------------------------
                    $whereConditions = array();
                    $whereConditions['deleted'] = 'N';
                    $whereConditions['role_id'] = $id;
                    $conditions = array(
										'order' =>  array('id' => 'asc'),
                                        'conditions' => $whereConditions,
                                       );
					$AclRoleActions = $this->AclRoleAction->find('all',$conditions);
					//pr($AclRoleActions);

					//-----------------------------------------------------------------------------------------------
					

                    $this->set('default',$default);
					$this->set('AclActions',$AclActions);
					$this->set('AclRoleActions',$AclRoleActions);
                
            }

	}       
        
	public function save($id=null) {
            $this->autoRender = false;
             
            $data = $this->request->data;
			//pr($data);
			//die;
			
			if(!empty($this->request->data)){    
				
				if(!empty($id)){
					
					$this->AclRole->id = $id;
					if($this->AclRole->exists()){

						$data['name'] = $this->request->data['AclRole']['name'];
						$status = $this->AclRole->save($data) ? 'SUCCESS' : 'FAILED'; 
					//	$status = 'FAILED';
						if(!empty($this->request->data['AclRoleAction'])){
							$AclRoleActions = $this->request->data['AclRoleAction'];
							$data = array();
							foreach($AclRoleActions as $key => $AclRoleAction){
								$conditions = array(   //'limit' =>  '1',
									   'conditions' => array(
										   'role_id' => $id,
										   'action_id' => $key,
									   ),
									   'recursive'=>2
									  );
								$aclaction = $this->AclRoleAction->find('first',$conditions);
								
								if($aclaction==null){
								   $data['id'] = $this->Generator->getID();
								   $this->AclRoleAction->create();
								}else{
									$data['id'] = $aclaction['AclRoleAction']['id'];
								}
								$data['role_id'] = $id;
								$data['action_id'] = $key;
								$data['access'] = empty($AclRoleAction['access'])? 0:$AclRoleAction['access'];
								$data['list'] = empty($AclRoleAction['list'])? 0:$AclRoleAction['list'];
								$data['detail'] = empty($AclRoleAction['detail'])? 0:$AclRoleAction['detail'];
								$data['add'] = empty($AclRoleAction['add'])? 0:$AclRoleAction['add'];
								$data['edit'] = empty($AclRoleAction['edit'])? 0:$AclRoleAction['edit'];
								$data['delete'] = empty($AclRoleAction['delete'])? 0:$AclRoleAction['delete'];
								$this->AclRoleAction->save($data);
							}
						}
							
					}else{
						$status = 'FAILED';    
					}
					
				}else{

						$data['id'] = $this->Generator->getID();
						$data['name'] = $this->request->data['AclRole']['name'];
						$this->AclRole->create();
						$status = $this->AclRole->save($data) ? 'SUCCESS' : 'FAILED';
						$role_id = $this->AclRole->getLastInsertId();

						//-----------------------------------------------------------------------------------------------
						$whereConditions = array();
						$whereCOnditions['deleted'] = 'N';
						$conditions = array(
											'fields' => array('id','description'),
											'order' =>  array('id' => 'asc'),
											'conditions' => $whereConditions
										   );
						$AclActions = $this->AclAction->find('list',$conditions);
						
						$data = array();
						foreach($AclActions as $key => $AclAction){
							$data['id'] = $this->Generator->getID();
							$data['role_id'] = $role_id;
							$data['action_id'] = $key;
							$data['access'] = 1;
							$data['list'] = 1;
							$data['detail'] = 1;
							$data['add'] = 1;
							$data['edit'] = 1;
							$data['delete'] = 1;
							$this->AclRoleAction->create();
							$this->AclRoleAction->save($data);
						}

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
                            $this->AclRole->id = $id;
                            if($this->AclRole->exists())
                            $status = $this->AclRole->save($data) ? 'SUCCESS' : 'FAILED'; 
                            else $status = 'FAILED';    

                        }else $status =  'FAILED';                                      
                       
                    }                    
                    
                    echo json_encode(array('status' => $status));
	} 
        
}
?>