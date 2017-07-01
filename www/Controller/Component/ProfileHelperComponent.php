<?php
App::uses('Component', 'Controller');
App::uses('Utility', 'mfa');
class ProfileHelperComponent extends Component {

	public $components = array("AuthenticationBase");

	private $controller;
	
	function CheckLanguage($lang_arr , $language_id){
            //$lang['description'] = '';
            if(empty($language_id)){
                $language_id = 1;
            }
            $tmp = '';
            $lang = '';
            foreach($lang_arr as $datalang){
                
               if(!empty($datalang)) $tmp = $datalang;
                    if($datalang['language_id'] == $language_id){
                        $lang = $datalang;
                    }
                    if(empty($lang))$lang = $tmp;
                
            }
           
            return $lang;
            
        }
        
        function CheckOrgBelongLang($lang_arr , $language_id){
            if(empty($language_id)){
                $language_id = 1;
            }
            
            foreach($lang_arr as $i=> $datalang){
                $lang['belong_description'][$i] = $datalang['OrganizationDescription'];
            }   
            return $lang;
        }

}
?>