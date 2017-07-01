<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	
	public $recursive = -1;
	
	public function getCurrentUser() {

	  // for CakePHP 2.x:
	  App::uses('CakeSession', 'Model/Datasource');
	  $session = new CakeSession();

	  $user = $session->read('AuthUser');
	  return $user;
	}
	
	
	
	public $defaultConditions = array('deleted'=>'N');
	public $defaultFields = array();        
	public function __construct($id = false, $table = null, $ds = null) {
		$user = $this->getCurrentUser();
		$this->user_id = $user["User"]["id"];
		parent::__construct($id, $table, $ds);
	}
		
	function find($conditions = null, $fields = array(), $order = null, $recursive = null) {
        $doQuery = true;
        // check if we want the cache
        if (!empty($fields['cache'])) {
            $cacheConfig = null;
            // check if we have specified a custom config
            if (!empty($fields['cacheConfig'])) {
                $cacheConfig = $fields['cacheConfig'];
            }
            $cacheName = $this->name . '-' . $fields['cache'];
            // if so, check if the cache exists
            $data = Cache::read($cacheName, $cacheConfig);
            if ($data == false) {
                $data = parent::find($conditions, $fields,$order, $recursive);
                Cache::write($cacheName, $data, $cacheConfig);
            }
            $doQuery = false;
        }
        if ($doQuery) {
            $data = parent::find($conditions, $fields, $order,$recursive);
        }
        return $data;
    }
    
	public function beforeFind($queryData) {
		if(isset($this->defaultFields) && !empty($this->defaultFields)) {
			$queryData['fields'] = array_merge((array)$this->defaultFields,(array)$queryData['fields']);
		}
		
		if(isset($this->defaultConditions) && !empty($this->defaultConditions)) {
			//$queryData['conditions'] = array_merge((array)$this->defaultConditions,(array)$queryData['conditions']);
			$queryData['conditions'] = array_merge(array($this->alias.".deleted='N'"),(array)$queryData['conditions']);
		}
		
		return $queryData;
	}
        
	function getLastQuery()
	{
		$dbo = $this->getDatasource();
		$logs = $dbo->getLog();
		$lastLog = end($logs['log']);
		return $lastLog['query'];
	}        
        

}
