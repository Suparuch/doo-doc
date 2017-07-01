<?php
class PermissionHelper extends AppHelper {
   
	public $components = array("Session");
    
    function aclAction($AuthUser = null,$controller,$action,$permission = null) {

		if(!empty($AuthUser)){
			$acl_permission = empty($AuthUser['AclRoleAction'][$controller][$action][$permission])? 0:$AuthUser['AclRoleAction'][$controller][$action][$permission];
			if ($acl_permission == 1) {
			   return true;
			} else {
			   return false;
			}
		}else{
			return false;		
		}

    }
    
}
?>
