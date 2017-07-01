<?php
App::uses('AppController', 'Controller');

class SystemBaseAPIController extends AppController {
	
	public $uses = array('SystemConfig');
	
	function systemConfig($category='') {
		
		$this->layout = 'blank';
		$this->autoRender = false;
		
		if(!empty($category)){
			$conditions = array(
                            "conditions" => array("SystemConfig.category"=>$category),
                            "order" => array('SystemConfig.name asc')
                        );
			$systemConfig = $this->SystemConfig->find("all",$conditions);
//			pr($systemConfig);
			echo $systemConfig['1']['SystemConfig']['value'];
			echo '<br>';
			echo $systemConfig['2']['SystemConfig']['value'];
		}

	}
        
        public function browserFiles($path = '.') {
            $this->autoRender = false;
            $conditions = array(
                "conditions" => array("SystemConfig.category"=>"Browser"),
                "order" => array('SystemConfig.name asc')
            );
            $systemConfig = $this->SystemConfig->find("all",$conditions);
            $url = $systemConfig['2']['SystemConfig']['value'];
            //$urlServer = Router::url($this->webroot, true);
	    $urlServer = Configure::read('Application.Domain');
            $path = str_replace($urlServer, '', $url);
            $this->__getDirectory($path);
        }
        
        private function __getDirectory($path = '.', $prefix = '', $level = 0) {
            $ignore = array( 'cgi-bin', '.', '..');
            // Directories to ignore when listing output. Many hosts
            // will deny PHP access to the cgi-bin.
            $dh = @opendir($path);
            // Open the directory to the handle $dh
            
            while (false !== ($file = readdir($dh))) {
            // Loop through the directory
                
                if (!in_array($file, $ignore)) {
                // Check that this file is not to be ignored
                    
                    if (is_dir("$path/$file")) {
                    // Its a directory, so we need to keep reading down...
                        $childPrefix = $prefix . $file . '/';
                        // Re-call this same function but on a new directory.
                        // this is what makes function recursive.
                        $this->__getDirectory("$path/$file", $childPrefix, ($level+1));

                    } else {
                        // Just print out the filename
                        echo "$prefix$file<br>";
                        
                    }

                }

            } // end while
            // Close the directory handle
            closedir( $dh );
            
        }

}
?>
